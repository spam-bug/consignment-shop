<?php

namespace App\Models\Concerns;

use App\Enums\UserType;
use App\Models\Consignee;
use App\Models\Consignor;
use Illuminate\Database\Eloquent\Relations\HasOne;
use Illuminate\Http\RedirectResponse;

trait HasRole
{
    public function initializeHasRole()
    {
        $this->fillable[] = 'type';
        $this->casts['type'] = UserType::class;
    }

    public function consignor(): HasOne
    {
        return $this->hasOne(Consignor::class);
    }

    public function consignee(): HasOne
    {
        return $this->hasOne(Consignee::class);
    }

    public function isAdmin(): bool
    {
        return $this->type === UserType::Admin;
    }

    public function isNotAdmin(): bool
    {
        return ! $this->isAdmin();
    }

    public function isConsignor(): bool
    {
        return $this->type === UserType::Consignor;
    }

    public function isNotConsignor(): bool
    {
        return ! $this->isConsignor();
    }

    public function isConsignee(): bool
    {
        return $this->type === UserType::Consignee;
    }

    public function isNotConsignee(): bool
    {
        return ! $this->isConsignee();
    }

    public function redirectHome(): RedirectResponse
    {
        return redirect()->route($this->homeRoute());
    }

    public function homeRoute(): string
    {
        if ($this->isAdmin()) {
            return $this->adminHomeRoute();
        }

        return $this->isConsignor() ? $this->consignorHomeRoute() : $this->consigneeHomeRoute();
    }

    public function adminHomeRoute(): string
    {
        return 'admin.dashboard';
    }

    public function consignorHomeRoute(): string
    {
        return 'consignor.dashboard';
    }

    public function consigneeHomeRoute(): string
    {
        return 'consignee.dashboard';
    }
}