<?php

namespace App\Http\Controllers\Consignee;

use App\Http\Controllers\Controller;
use Illuminate\Contracts\View\View;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function __invoke(): View
    {
        return view('consignee.dashboard');
    }
}
