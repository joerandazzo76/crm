<?php

namespace App\Livewire\Contacts;

use App\Models\Company;
use App\Models\Contact;
use Livewire\Component;

class ContactCreate extends Component
{
    public ?Contact $contact = null;

    public string $first_name = '';
    public string $last_name = '';
    public string $email = '';
    public string $phone = '';
    public string $mobile = '';
    public ?int $company_id = null;
    public string $status = 'lead';
    public string $source = '';
    public string $position = '';
    public string $address = '';
    public string $city = '';
    public string $state = '';
    public string $country = '';
    public string $zip = '';

    public function mount(?Contact $contact = null): void
    {
        if ($contact?->exists) {
            $this->contact = $contact;
            $this->fill($contact->only([
                'first_name', 'last_name', 'email', 'phone', 'mobile',
                'company_id', 'status', 'source', 'position',
                'address', 'city', 'state', 'country', 'zip',
            ]));
        }
    }

    protected function rules(): array
    {
        return [
            'first_name' => 'required|string|max:255',
            'last_name' => 'required|string|max:255',
            'email' => 'nullable|email|max:255',
            'phone' => 'nullable|string|max:50',
            'mobile' => 'nullable|string|max:50',
            'company_id' => 'nullable|exists:companies,id',
            'status' => 'required|in:lead,customer,inactive',
            'source' => 'nullable|string|max:255',
            'position' => 'nullable|string|max:255',
            'address' => 'nullable|string|max:255',
            'city' => 'nullable|string|max:255',
            'state' => 'nullable|string|max:255',
            'country' => 'nullable|string|max:255',
            'zip' => 'nullable|string|max:20',
        ];
    }

    public function save()
    {
        $data = $this->validate();
        $data['owner_id'] = auth()->id();

        if ($this->contact) {
            $this->contact->update($data);
            session()->flash('success', 'Contact updated.');
            return redirect()->route('contacts.show', $this->contact);
        }

        $contact = Contact::create($data);
        session()->flash('success', 'Contact created.');
        return redirect()->route('contacts.show', $contact);
    }

    public function render()
    {
        return view('livewire.contacts.contact-create', [
            'companies' => Company::orderBy('name')->get(),
            'isEdit' => (bool) $this->contact,
        ])->layout('layouts.app', ['title' => $this->contact ? 'Edit Contact' : 'Create Contact']);
    }
}
