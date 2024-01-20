<?php

namespace App\Http\Controllers\Consignee;

use App\Http\Controllers\Controller;
use Illuminate\Contracts\View\View;
use Illuminate\Http\Request;

class OrderController extends Controller
{
    public function index(): View
    {
        return view('consignee.order.index');
    }
}
