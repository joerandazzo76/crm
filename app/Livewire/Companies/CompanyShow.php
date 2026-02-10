<?php

namespace App\Livewire\Companies;

use App\Models\Company;
use Livewire\Component;

class CompanyShow extends Component
{
    public Company $company;
    public string $newNote = '';

    public function mount(Company $company): void
    {
        $this->company = $company->load('owner', 'contacts', 'deals.stage');
    }

    public function addNote(): void
    {
        $this->validate(['newNote' => 'required|string']);
        $this->company->notes()->create(['body' => $this->newNote, 'user_id' => auth()->id()]);
        $this->newNote = '';
    }

    public function render()
    {
        return view('livewire.companies.company-show', [
            'notes' => $this->company->notes()->with('user')->latest()->get(),
        ])->layout('layouts.app', ['title' => $this->company->name]);
    }
}
