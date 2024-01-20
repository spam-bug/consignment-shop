<?php

namespace App\Http\Controllers\Consignor;

use App\Http\Controllers\Controller;
use Illuminate\Contracts\View\View;
use Illuminate\Http\Request;

class OrderController extends Controller
{
    public function index(): View
    {
        return view('consignor.order.index');
    }
}
