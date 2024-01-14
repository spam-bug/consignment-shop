<?php

namespace App\Http\Controllers\Admin;

use App\Enums\UserStatus;
use App\Enums\UserType;
use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;

class UserController extends Controller
{
    public function index(): View
    {
        return view('admin.users.index', [
            'users' => User::where('type', '!=', UserType::Admin)->paginate(10)
        ]);
    }

    public function approve(User $user): RedirectResponse
    {
        $user->status = UserStatus::Active;
        $user->save();

        return redirect()->route('admin.users');
    }
}
