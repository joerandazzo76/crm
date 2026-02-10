<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class PlanSeeder extends Seeder
{
    public function run(): void
    {
        DB::table('plans')->insert([
            [
                'name' => 'Free',
                'slug' => 'free',
                'monthly_price' => 0,
                'annual_price' => 0,
                'max_users' => 1,
                'max_contacts' => 100,
                'trial_days' => 0,
                'features' => json_encode(['contacts', 'companies', 'deals', 'tasks', 'basic_reports']),
                'is_active' => true,
                'sort_order' => 1,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => 'Pro',
                'slug' => 'pro',
                'monthly_price' => 29.00,
                'annual_price' => 290.00,
                'max_users' => 10,
                'max_contacts' => 0, // unlimited
                'trial_days' => 14,
                'features' => json_encode(['contacts', 'companies', 'deals', 'tasks', 'emails', 'reports', 'pipelines', 'import_export']),
                'is_active' => true,
                'sort_order' => 2,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => 'Enterprise',
                'slug' => 'enterprise',
                'monthly_price' => 79.00,
                'annual_price' => 790.00,
                'max_users' => 0, // unlimited
                'max_contacts' => 0,
                'trial_days' => 14,
                'features' => json_encode(['contacts', 'companies', 'deals', 'tasks', 'emails', 'reports', 'pipelines', 'import_export', 'custom_fields', 'api_access', 'priority_support']),
                'is_active' => true,
                'sort_order' => 3,
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ]);
    }
}
