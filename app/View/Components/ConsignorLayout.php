<?php

namespace App\View\Components;

use Illuminate\Contracts\View\View;
use Illuminate\Support\Str;
use Illuminate\View\Component;

class ConsignorLayout extends Component
{
    public function title(): string
    {
        $fragments = explode('/', request()->getPathInfo());

        return Str::title($fragments[2]);
    }

    public function render(): View
    {
        $this->title();

        return view('layouts.consignor');
    }
}
