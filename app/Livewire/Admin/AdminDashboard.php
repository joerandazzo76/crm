<?php

namespace App\Livewire\Admin;

use App\Models\Tenant;
use Illuminate\Support\Facades\DB;
use Livewire\Component;

class AdminDashboard extends Component
{
    public function render()
    {
        $totalTenants = Tenant::count();
        $totalDomains = DB::table('domains')->count();
        $totalPlans = DB::table('plans')->count();

        $recentTenants = Tenant::with('domains')
            ->latest()
            ->take(10)
            ->get();

        $planBreakdown = Tenant::select('plan', DB::raw('count(*) as count'))
            ->groupBy('plan')
            ->pluck('count', 'plan')
            ->toArray();

        return view('livewire.admin.admin-dashboard', [
            'totalTenants' => $totalTenants,
            'totalDomains' => $totalDomains,
            'totalPlans' => $totalPlans,
            'recentTenants' => $recentTenants,
            'planBreakdown' => $planBreakdown,
        ])->layout('layouts.admin');
    }
}
