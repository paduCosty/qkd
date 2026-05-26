<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class SuperAdminSeeder extends Seeder
{
    public function run(): void
    {
        $email    = env('SUPER_ADMIN_EMAIL');
        $password = env('SUPER_ADMIN_PASSWORD');
        $name     = env('SUPER_ADMIN_NAME', 'Admin');

        if (! $email || ! $password) {
            $this->command->warn('SuperAdminSeeder: SUPER_ADMIN_EMAIL sau SUPER_ADMIN_PASSWORD lipsesc din .env');
            return;
        }

        User::updateOrCreate(
            ['email' => $email],
            [
                'name'     => $name,
                'password' => Hash::make($password),
                'role'     => 'admin',
                'status'   => 'active',
                'is_owner' => true,
            ]
        );

        $this->command->info("Admin creat: {$email}");
    }
}
