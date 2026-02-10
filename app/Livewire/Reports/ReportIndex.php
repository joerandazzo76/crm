<?php

namespace App\Livewire\Reports;

use App\Models\Contact;
use App\Models\Deal;
use App\Models\Activity;
use Livewire\Component;

class ReportIndex extends Component
{
    public function render()
    {
        $wonDeals = Deal::where('status', 'won');
        $openDeals = Deal::where('status', 'open');

        return view('livewire.reports.report-index', [
            'totalRevenue' => $wonDeals->sum('value'),
            'avgDealSize' => $wonDeals->avg('value') ?? 0,
            'wonCount' => (clone $wonDeals)->count(),
            'lostCount' => Deal::where('status', 'lost')->count(),
            'openCount' => $openDeals->count(),
            'openValue' => $openDeals->sum('value'),
            'contactsThisMonth' => Contact::whereMonth('created_at', now()->month)->count(),
            'activitiesThisMonth' => Activity::whereMonth('created_at', now()->month)->count(),
            'dealsByStage' => Deal::where('status', 'open')
                ->selectRaw('stage_id, count(*) as count, sum(value) as total_value')
                ->groupBy('stage_id')
                ->with('stage')
                ->get(),
        ])->layout('layouts.app', ['title' => 'Reports']);
    }
}
