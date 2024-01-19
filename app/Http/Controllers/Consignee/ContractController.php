<?php

namespace App\Http\Controllers\Consignee;

use App\Enums\ContractStatus;
use App\Http\Controllers\Controller;
use App\Models\User;
use Auth;
use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Contracts\View\View;
use Illuminate\Http\Request;

class ContractController extends Controller
{
    public function index(): View
    {
        return view('consignee.contracts.index');
    }
}
