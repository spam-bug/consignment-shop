<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Contracts\View\View;
use Illuminate\Http\Request;

class ActivationController extends Controller
{
    public function __invoke(): View
    {
        return view('auth.activation');
    }
}
