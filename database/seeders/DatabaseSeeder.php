<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;

use App\Enums\UserStatus;
use App\Enums\UserType;
use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        $seederClasses = [
            CategorySeeder::class
        ];

        User::create([
            'type' => UserType::Admin,
            'name' => 'admin',
            'email' => 'admin@example.com',
            'password' => Hash::make('qweqweqwe'),
            'status' => UserStatus::Active
        ]);

        if (app()->isLocal()) {
            $consignorUser = User::create([
                'type' => UserType::Consignor,
                'name' => 'consignor',
                'email' => 'consignor@example.com',
                'password' => Hash::make('qweqweqwe'),
                'status' => UserStatus::Active
            ]);

            $consignor = $consignorUser->consignor()->create([]);
            $consignor->business()->create([
                'name' => 'COnsignor MOnkey',
                'permit' => 'photos/9TdHeyv9esf8o1CzwD5TZSXML79wS6VOddEmlUJC.png'
            ]);

            $consigneeUser = User::create([
                'type' => UserType::Consignee,
                'name' => 'consignee',
                'email' => 'consignee@example.com',
                'password' => Hash::make('qweqweqwe'),
                'status' => UserStatus::Active
            ]);
            $consignee = $consigneeUser->consignee()->create([]);
            $consignee->business()->create([
                'name' => 'Consignee MOnkey',
                'permit' => 'photos/9TdHeyv9esf8o1CzwD5TZSXML79wS6VOddEmlUJC.png'
            ]);

            $seederClasses[] = ProductSeeder::class;
        }

        $this->call($seederClasses);
    }
}
