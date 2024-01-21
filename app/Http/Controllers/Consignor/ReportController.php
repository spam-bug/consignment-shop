<?php

namespace App\Http\Controllers\Consignor;

use App\Enums\TransactionStatus;
use App\Http\Controllers\Controller;
use App\Models\Product;
use App\Models\Transaction;
use Barryvdh\DomPDF\Facade\Pdf;
use Carbon\Carbon;
use Illuminate\Http\Request;

class ReportController extends Controller
{
    public function transactions(Request $request)
    {
        $range = $request->input('range');

        // Set default dates for the custom range
        $from = $request->input('from', Carbon::now()->subDays(7)->format('Y-m-d'));
        $to = $request->input('to', Carbon::now()->format('Y-m-d'));

        // Validate custom range if applicable
        if ($range == 'custom' && (!$from || !$to)) {
            return redirect()->back()->with('error', 'Invalid date range.');
        }

        // Adjust the query based on the selected range
        $query = Transaction::query();

        switch ($range) {
            case 'weekly':
                $query->whereBetween('created_at', [Carbon::now()->subDays(6), Carbon::now()]);
                break;

            case 'monthly':
                $query->whereMonth('created_at', Carbon::now()->month);
                break;

            case 'yearly':
                $query->whereYear('created_at', Carbon::now()->year);
                break;

            case 'custom':
                $query->whereBetween('created_at', [$from, $to]);
                break;

            default:
                // Handle invalid range
                return response()->json(['error' => 'Invalid range provided.'], 422);
        }

        $transactions = $query->where('status', TransactionStatus::Paid)->get();

        $data = [
            'range' => [$range],
            'transactions' => $transactions,
            'total' => $transactions->sum('total')
        ];

        if ($range === 'custom') {
            $data['range'][] = [
                'from' => Carbon::parse($from)->format('M d, Y'),
                'to' => Carbon::parse($to)->format('M d, Y')
            ];
        }

        $pdf = Pdf::loadView('consignor.report.transactions', $data)->setPaper('legal', 'landscape');

        return $pdf->download();
    }

    public function products(Request $request)
    {
        $range = $request->input('range');

        // Set default dates for the custom range
        $from = $request->input('from', Carbon::now()->subDays(7)->format('Y-m-d'));
        $to = $request->input('to', Carbon::now()->format('Y-m-d'));

        // Validate custom range if applicable
        if ($range == 'custom' && (!$from || !$to)) {
            return redirect()->back()->with('error', 'Invalid date range.');
        }

        // Adjust the query based on the selected range
        $query = Product::query();

        switch ($range) {
            case 'weekly':
                $query->whereHas('orders', function ($query) {
                    $query->whereBetween('created_at', [Carbon::now()->subDays(6), Carbon::now()]);
                });
                break;

            case 'monthly':
                $query->whereHas('orders', function ($query) {
                    $query->whereMonth('created_at', Carbon::now()->month);
                });
                break;

            case 'yearly':
                $query->whereHas('orders', function ($query) {
                    $query->whereYear('created_at', Carbon::now()->year);
                });
                break;
            case 'custom':
                $query->whereHas('orders', function ($query) {
                    $query->whereBetween('created_at', [$from, $to]);
                });
                break;

            default:
                // Handle invalid range
                return response()->json(['error' => 'Invalid range provided.'], 422);
        }

        $products = $query->get();

        $data = [
            'range' => [$range],
            'products' => $products,
        ];

        if ($range === 'custom') {
            $data['range'][] = [
                'from' => Carbon::parse($from)->format('M d, Y'),
                'to' => Carbon::parse($to)->format('M d, Y')
            ];
        }

        $pdf = Pdf::loadView('consignor.report.products', $data)->setPaper('legal', 'landscape');

        return $pdf->stream();
    }
}
