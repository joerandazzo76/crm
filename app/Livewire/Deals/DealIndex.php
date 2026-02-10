<?php

namespace App\Livewire\Deals;

use App\Models\Deal;
use Livewire\Component;
use Livewire\WithPagination;

class DealIndex extends Component
{
    use WithPagination;

    public string $search = '';
    public string $statusFilter = '';

    public function updatingSearch(): void { $this->resetPage(); }

    public function render()
    {
        $deals = Deal::with('contact', 'company', 'stage', 'owner', 'pipeline')
            ->when($this->search, fn ($q) => $q->where('title', 'like', "%{$this->search}%"))
            ->when($this->statusFilter, fn ($q) => $q->where('status', $this->statusFilter))
            ->latest()
            ->paginate(15);

        return view('livewire.deals.deal-index', compact('deals'))
            ->layout('layouts.app', ['title' => 'Deals']);
    }
}
