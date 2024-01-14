<?php

namespace App\Enums;

enum AlertType: string
{
    case Info = 'info';
    case Success = 'success';
    case Danger = 'danger';
    case Warning = 'warning';

    public function getClass(): string
    {
        return match($this) {
            self::Info => 'bg-blue-100 border-blue-200 text-blue-700',
            self::Success => 'bg-green-100 border-green-200 text-green-700',
            self::Danger => 'bg-red-100 border-red-200 text-red-700',
            self::Warning => 'bg-yellow-100 border-yellow-200 text-yellow-700',
        };
    }
}