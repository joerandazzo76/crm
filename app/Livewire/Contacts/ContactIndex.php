<?php

namespace App\Livewire\Contacts;

use App\Exports\ContactsExport;
use App\Imports\ContactsImport;
use App\Models\Contact;
use Livewire\Component;
use Livewire\WithFileUploads;
use Livewire\WithPagination;
use Maatwebsite\Excel\Facades\Excel;

class ContactIndex extends Component
{
    use WithPagination, WithFileUploads;

    public string $search = '';
    public string $statusFilter = '';
    public string $sortField = 'created_at';
    public string $sortDirection = 'desc';
    public $importFile;
    public bool $showImportModal = false;

    public function updatingSearch(): void
    {
        $this->resetPage();
    }

    public function sortBy(string $field): void
    {
        $this->sortDirection = $this->sortField === $field && $this->sortDirection === 'asc' ? 'desc' : 'asc';
        $this->sortField = $field;
    }

    public function export()
    {
        return Excel::download(new ContactsExport, 'contacts.csv');
    }

    public function import(): void
    {
        $this->validate(['importFile' => 'required|mimes:csv,txt,xlsx']);
        Excel::import(new ContactsImport, $this->importFile->getRealPath());
        $this->showImportModal = false;
        $this->importFile = null;
        session()->flash('success', 'Contacts imported successfully.');
    }

    public function deleteContact(int $id): void
    {
        Contact::findOrFail($id)->delete();
        session()->flash('success', 'Contact deleted.');
    }

    public function render()
    {
        $contacts = Contact::with('company', 'owner')
            ->when($this->search, fn ($q) => $q->where(fn ($q2) =>
                $q2->where('first_name', 'like', "%{$this->search}%")
                   ->orWhere('last_name', 'like', "%{$this->search}%")
                   ->orWhere('email', 'like', "%{$this->search}%")
            ))
            ->when($this->statusFilter, fn ($q) => $q->where('status', $this->statusFilter))
            ->orderBy($this->sortField, $this->sortDirection)
            ->paginate(15);

        return view('livewire.contacts.contact-index', compact('contacts'))
            ->layout('layouts.app', ['title' => 'Contacts']);
    }
}
