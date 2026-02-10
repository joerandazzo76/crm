<?php

namespace Database\Seeders;

use App\Models\AdminUser;
use Illuminate\Database\Seeder;

class AdminUserSeeder extends Seeder
{
    public function run(): void
    {
        AdminUser::firstOrCreate(
            ['email' => 'admin@crm.com'],
            [
                'name' => 'God Admin',
                'password' => 'admin123',
            ]
        );

        $this->command->info('Admin user created: admin@crm.com / admin123');
    }
}
