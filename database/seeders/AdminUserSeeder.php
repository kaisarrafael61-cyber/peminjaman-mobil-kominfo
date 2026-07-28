<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class AdminUserSeeder extends Seeder
{
    public function run(): void
    {
        // 1. Akun Admin
        User::updateOrCreate(
            ['email' => 'admin@diskominfo.go.id'],
            [
                'name' => 'Admin Diskominfo',
                'password' => Hash::make('admin123'),
                'role' => 'admin',
            ]
        );

        // 2. Akun User / Pegawai (Darman)
        User::updateOrCreate(
            ['email' => 'darman@diskominfo.go.id'],
            [
                'name' => 'Darman',
                'password' => Hash::make('user123'),
                'role' => 'user',
            ]
        );
    }
}