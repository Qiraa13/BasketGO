<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class AdminSeeder extends Seeder
{
    public function run()
    {
        User::updateOrCreate(
            ['email' => 'admin@basketgo.test'],
            [
                'name' => 'Admin BasketGO',
                'password' => Hash::make('12345'), // ubah kalau perlu
                'role' => 'admin',
                'email_verified_at' => now(),
            ]
        );
    }
}
