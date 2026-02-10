<?php

namespace App\Livewire\Settings;

use App\Models\Contact;
use App\Models\Company;
use App\Models\Deal;
use App\Models\User;
use Livewire\Component;

class GeneralSettings extends Component
{
    public string $timezone = 'UTC';
    public string $currency = 'USD';
    public string $dateFormat = 'M d, Y';

    public function mount(): void
    {
        $this->timezone = auth()->user()->timezone ?? 'UTC';
    }

    public function saveSettings(): void
    {
        auth()->user()->update(['timezone' => $this->timezone]);
        session()->flash('success', 'Settings saved.');
    }

    public function render()
    {
        $tenant = tenant();

        return view('livewire.settings.general-settings', [
            'tenant' => $tenant,
            'stats' => [
                'users' => User::count(),
                'contacts' => Contact::count(),
                'companies' => Company::count(),
                'deals' => Deal::count(),
            ],
        ])->layout('layouts.app', ['title' => 'Settings']);
    }
}
