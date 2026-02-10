<?php

namespace App\Livewire\Companies;

use App\Exports\CompaniesExport;
use App\Models\Company;
use Livewire\Component;
use Livewire\WithPagination;
use Maatwebsite\Excel\Facades\Excel;

class CompanyIndex extends Component
{
    use WithPagination;

    public string $search = '';

    public function updatingSearch(): void { $this->resetPage(); }

    public function export()
    {
        return Excel::download(new CompaniesExport, 'companies.csv');
    }

    public function deleteCompany(int $id): void
    {
        Company::findOrFail($id)->delete();
        session()->flash('success', 'Company deleted.');
    }

    public function render()
    {
        $companies = Company::with('owner')
            ->withCount('contacts', 'deals')
            ->when($this->search, fn ($q) => $q->where('name', 'like', "%{$this->search}%"))
            ->latest()
            ->paginate(15);

        return view('livewire.companies.company-index', compact('companies'))
            ->layout('layouts.app', ['title' => 'Companies']);
    }
}
