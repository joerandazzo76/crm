<?php

namespace App\Livewire\Deals;

use App\Models\Deal;
use Livewire\Component;

class DealShow extends Component
{
    public Deal $deal;
    public string $newNote = '';

    public function mount(Deal $deal): void
    {
        $this->deal = $deal->load('contact', 'company', 'stage', 'pipeline', 'owner');
    }

    public function addNote(): void
    {
        $this->validate(['newNote' => 'required|string']);
        $this->deal->notes()->create(['body' => $this->newNote, 'user_id' => auth()->id()]);
        $this->deal->activities()->create(['type' => 'note', 'subject' => 'added a note', 'user_id' => auth()->id(), 'happened_at' => now()]);
        $this->newNote = '';
    }

    public function markWon(): void
    {
        $this->deal->update(['status' => 'won', 'won_at' => now()]);
        $this->deal->refresh();
    }

    public function markLost(): void
    {
        $this->deal->update(['status' => 'lost', 'lost_at' => now()]);
        $this->deal->refresh();
    }

    public function render()
    {
        return view('livewire.deals.deal-show', [
            'notes' => $this->deal->notes()->with('user')->latest()->get(),
            'activities' => $this->deal->activities()->with('user')->latest()->take(20)->get(),
        ])->layout('layouts.app', ['title' => $this->deal->title]);
    }
}
