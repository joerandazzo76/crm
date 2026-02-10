<?php

namespace Database\Seeders;

use App\Models\Tenant;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class DemoTenantSeeder extends Seeder
{
    public function run(): void
    {
        $tenant = Tenant::create([
            'id' => 'demo',
            'name' => 'Demo Company',
            'email' => 'admin@demo.com',
            'plan' => 'free',
            'trial_ends_at' => now()->addDays(14),
        ]);

        $tenant->domains()->create([
            'domain' => 'demo',
        ]);

        $tenant->run(function () {
            \App\Models\User::create([
                'name' => 'Admin User',
                'email' => 'admin@demo.com',
                'password' => 'password',
                'role' => 'admin',
            ]);

            $pipeline = \App\Models\Pipeline::create([
                'name' => 'Sales Pipeline',
                'is_default' => true,
            ]);

            $stages = [
                ['name' => 'Lead In', 'position' => 1, 'color' => '#6366f1', 'win_probability' => 10],
                ['name' => 'Qualified', 'position' => 2, 'color' => '#8b5cf6', 'win_probability' => 25],
                ['name' => 'Proposal', 'position' => 3, 'color' => '#a855f7', 'win_probability' => 50],
                ['name' => 'Negotiation', 'position' => 4, 'color' => '#f59e0b', 'win_probability' => 75],
                ['name' => 'Closed Won', 'position' => 5, 'color' => '#10b981', 'win_probability' => 100],
                ['name' => 'Closed Lost', 'position' => 6, 'color' => '#ef4444', 'win_probability' => 0],
            ];

            foreach ($stages as $stage) {
                $pipeline->stages()->create($stage);
            }
        });

        $this->command->info('Demo tenant created: demo.localhost');
        $this->command->info('Login: admin@demo.com / password');
    }
}
