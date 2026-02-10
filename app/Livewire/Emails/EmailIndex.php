<?php

namespace App\Livewire\Emails;

use App\Models\Email;
use Livewire\Component;
use Livewire\WithPagination;

class EmailIndex extends Component
{
    use WithPagination;

    public string $search = '';

    public function render()
    {
        $emails = Email::with('contact', 'user')
            ->when($this->search, fn ($q) => $q->where('subject', 'like', "%{$this->search}%"))
            ->latest()
            ->paginate(20);

        return view('livewire.emails.email-index', compact('emails'))
            ->layout('layouts.app', ['title' => 'Emails']);
    }
}
