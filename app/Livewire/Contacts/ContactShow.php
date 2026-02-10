<?php

namespace App\Livewire\Contacts;

use App\Models\Activity;
use App\Models\Contact;
use App\Models\Note;
use Livewire\Component;

class ContactShow extends Component
{
    public Contact $contact;
    public string $newNote = '';

    public function mount(Contact $contact): void
    {
        $this->contact = $contact->load('company', 'owner', 'deals.stage', 'tags');
    }

    public function addNote(): void
    {
        $this->validate(['newNote' => 'required|string']);

        $this->contact->notes()->create([
            'body' => $this->newNote,
            'user_id' => auth()->id(),
        ]);

        $this->contact->activities()->create([
            'type' => 'note',
            'subject' => 'added a note',
            'user_id' => auth()->id(),
            'happened_at' => now(),
        ]);

        $this->newNote = '';
        $this->contact->load('notes.user', 'activities.user');
    }

    public function render()
    {
        return view('livewire.contacts.contact-show', [
            'notes' => $this->contact->notes()->with('user')->latest()->get(),
            'activities' => $this->contact->activities()->with('user')->latest()->take(20)->get(),
        ])->layout('layouts.app', ['title' => $this->contact->full_name]);
    }
}
