<?php

namespace App\Livewire\Admin;

use App\Models\Tenant;
use Livewire\Component;

class TenantShow extends Component
{
    public Tenant $tenant;
    public array $tenantUsers = [];
    public array $tenantStats = [];

    public function mount(string $tenant)
    {
        $this->tenant = Tenant::with('domains')->findOrFail($tenant);
        $this->loadTenantData();
    }

    public function loadTenantData(): void
    {
        $this->tenant->run(function () {
            $this->tenantUsers = \App\Models\User::select('id', 'name', 'email', 'role', 'created_at')
                ->orderBy('id')
                ->get()
                ->toArray();

            $this->tenantStats = [
                'users' => \App\Models\User::count(),
                'contacts' => \App\Models\Contact::count(),
                'companies' => \App\Models\Company::count(),
                'deals' => \App\Models\Deal::count(),
                'tasks' => \App\Models\Task::count(),
            ];
        });
    }

    public function deleteTenant(): void
    {
        $this->tenant->delete();
        session()->flash('success', "Tenant '{$this->tenant->id}' deleted.");
        $this->redirect(route('admin.dashboard'));
    }

    public function render()
    {
        return view('livewire.admin.tenant-show')
            ->layout('layouts.admin');
    }
}
