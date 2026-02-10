<?php

namespace App\Livewire\Companies;

use App\Models\Company;
use Livewire\Component;

class CompanyCreate extends Component
{
    public ?Company $company = null;
    public string $name = '';
    public string $domain = '';
    public string $industry = '';
    public string $employee_count = '';
    public ?string $annual_revenue = null;
    public string $phone = '';
    public string $email = '';
    public string $website = '';
    public string $address = '';
    public string $city = '';
    public string $state = '';
    public string $country = '';
    public string $zip = '';

    public function mount(?Company $company = null): void
    {
        if ($company?->exists) {
            $this->company = $company;
            $this->fill($company->only([
                'name', 'domain', 'industry', 'employee_count', 'annual_revenue',
                'phone', 'email', 'website', 'address', 'city', 'state', 'country', 'zip',
            ]));
        }
    }

    public function save()
    {
        $data = $this->validate([
            'name' => 'required|string|max:255',
            'domain' => 'nullable|string|max:255',
            'industry' => 'nullable|string|max:255',
            'employee_count' => 'nullable|string|max:50',
            'annual_revenue' => 'nullable|numeric',
            'phone' => 'nullable|string|max:50',
            'email' => 'nullable|email|max:255',
            'website' => 'nullable|string|max:255',
            'address' => 'nullable|string|max:255',
            'city' => 'nullable|string|max:255',
            'state' => 'nullable|string|max:255',
            'country' => 'nullable|string|max:255',
            'zip' => 'nullable|string|max:20',
        ]);

        $data['owner_id'] = auth()->id();

        if ($this->company) {
            $this->company->update($data);
            return redirect()->route('companies.show', $this->company)->with('success', 'Company updated.');
        }

        $company = Company::create($data);
        return redirect()->route('companies.show', $company)->with('success', 'Company created.');
    }

    public function render()
    {
        return view('livewire.companies.company-create', ['isEdit' => (bool) $this->company])
            ->layout('layouts.app', ['title' => $this->company ? 'Edit Company' : 'New Company']);
    }
}
