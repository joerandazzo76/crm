<?php

namespace App\Livewire\Emails;

use App\Models\Contact;
use App\Models\Email;
use Livewire\Component;

class EmailCompose extends Component
{
    public string $to_email = '';
    public string $subject = '';
    public string $body = '';
    public ?int $contact_id = null;

    public function updatedContactId(): void
    {
        if ($this->contact_id) {
            $contact = Contact::find($this->contact_id);
            $this->to_email = $contact?->email ?? '';
        }
    }

    public function send()
    {
        $this->validate([
            'to_email' => 'required|email',
            'subject' => 'required|string|max:255',
            'body' => 'required|string',
        ]);

        Email::create([
            'to_email' => $this->to_email,
            'from_email' => auth()->user()->email,
            'subject' => $this->subject,
            'body' => $this->body,
            'contact_id' => $this->contact_id,
            'user_id' => auth()->id(),
            'direction' => 'outbound',
            'status' => 'sent',
            'sent_at' => now(),
        ]);

        return redirect()->route('emails.index')->with('success', 'Email logged.');
    }

    public function render()
    {
        return view('livewire.emails.email-compose', [
            'contacts' => Contact::whereNotNull('email')->orderBy('first_name')->get(),
        ])->layout('layouts.app', ['title' => 'Compose Email']);
    }
}
