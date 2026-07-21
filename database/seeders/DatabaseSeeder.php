<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    public function run(): void
    {
        // Create/update admin user
        User::updateOrCreate(
            ['email' => 'asdmassociates@gmail.com'],
            [
                'name'     => 'asdm',
                'email'    => 'asdmassociates@gmail.com',
                'password' => Hash::make('adamdi21'),
            ]
        );
    }
}
