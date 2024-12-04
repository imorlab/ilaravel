<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class AdminUserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        User::create([
            'name' => 'Admin System',
            'email' => 'iml@admin.com',
            'password' => Hash::make('iml13Secret_$'),
            'email_verified_at' => now(),
            'role' => 'admin',
        ]);
    }
}
