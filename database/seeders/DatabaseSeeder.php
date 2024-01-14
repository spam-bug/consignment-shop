<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;

use App\Enums\UserStatus;
use App\Enums\UserType;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        \App\Models\User::create([
            'type' => UserType::Admin,
            'name' => 'admin',
            'email' => 'admin@example.com',
            'password' => Hash::make('qweqweqwe'),
            'status' => UserStatus::Active
        ]);

        $consignorUser = \App\Models\User::create([
            'type' => UserType::Consignor,
            'name' => 'Consignor Demo',
            'email' => 'consignor@example.com',
            'password' => Hash::make('qweqweqwe'),
            'status' => UserStatus::Active
        ]);

        $consignorUser->consignor()->create([]);

        $this->call([
            CategorySeeder::class,
            ProductSeeder::class,
        ]);
    }
}
