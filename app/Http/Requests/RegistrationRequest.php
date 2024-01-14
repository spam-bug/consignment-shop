<?php

namespace App\Http\Requests;

use App\Enums\UserStatus;
use App\Enums\UserType;
use App\Models\User;
use Illuminate\Auth\Events\Registered;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class RegistrationRequest extends FormRequest
{
    public function authorize(): bool
    {
        return ! Auth::check();
    }

    public function rules(): array
    {
        return [
            'type' => ['required'],
            'name' => ['required', 'alpha_spaces'],
            'email' => ['required', 'email', 'unique:users,email'],
            'password' => ['required', 'min:8'],
            'business_name' => ['required', 'alpha_spaces'],
            'business_permit' => ['required', 'mimes:jpg,png'],
        ];
    }

    public function register(): User
    {
        $user = User::create([
            'type' => $this->type,
            'name' => $this->name,
            'email' => $this->email,
            'password' => Hash::make($this->password),
            'status' => UserStatus::Inactive,
        ]);

        $path = $this->business_permit->store('photos');

        $business = [
            'name' => $this->business_name,
            'permit' => $path,
        ];

        $model = $user->type === UserType::Consignor ? $user->consignor()->create([]) : $user->consignee()->create([]);
        $model->business()->create($business);

        event(new Registered($user));

        Auth::login($user);

        return $user;
    }
}
