<?php

namespace App\Http\Controllers\Consignee;

use App\Http\Controllers\Controller;
use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ReportController extends Controller
{
    public function products()
    {
        $products = Auth::user()->consignee->products;

        $pdf = Pdf::loadView('consignee.reports.products', [
            'products' => $products
        ])->setPaper('legal', 'landscape');

        return $pdf->download('product-report.pdf');
    }
}
