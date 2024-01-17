<?php

namespace App\View\Components;

use Illuminate\Contracts\View\View;
use Illuminate\Support\Str;
use Illuminate\View\Component;

class ConsigneeLayout extends Component
{
    public function title(): string
    {
        $fragments = explode('/', request()->getPathInfo());

        return Str::title($fragments[2] ?? 'dashboard');
    }

    public function render(): View
    {
        return view('layouts.consignee');
    }
}
