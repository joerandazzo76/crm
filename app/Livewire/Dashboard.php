<?php

namespace App\Livewire;

use App\Models\Contact;
use App\Models\Deal;
use App\Models\Task;
use App\Models\Activity;
use Livewire\Component;

class Dashboard extends Component
{
    public function render()
    {
        return view('livewire.dashboard', [
            'totalContacts' => Contact::count(),
            'totalDeals' => Deal::where('status', 'open')->count(),
            'totalRevenue' => Deal::where('status', 'won')->sum('value'),
            'tasksDue' => Task::where('status', '!=', 'completed')
                ->where('due_date', '<=', now()->addDays(7))
                ->count(),
            'recentActivities' => Activity::with('user')
                ->latest()
                ->take(10)
                ->get(),
            'upcomingTasks' => Task::with('assignee')
                ->where('status', '!=', 'completed')
                ->orderBy('due_date')
                ->take(5)
                ->get(),
            'openDeals' => Deal::with('stage', 'contact')
                ->where('status', 'open')
                ->latest()
                ->take(5)
                ->get(),
        ])->layout('layouts.app', ['title' => 'Dashboard']);
    }
}
