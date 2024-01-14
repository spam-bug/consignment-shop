<?php

namespace App\Http\Controllers\Consignor;

use App\Http\Controllers\Controller;
use Illuminate\Contracts\View\View;

class DashboardController extends Controller
{
    public function __invoke(): View
    {
        return view('consignor.dashboard');
    }
}
