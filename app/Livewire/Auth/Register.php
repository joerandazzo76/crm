<?php

namespace App\Livewire\Auth;

use App\Models\Tenant;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;
use Livewire\Component;

class Register extends Component
{
    public string $company_name = '';
    public string $subdomain = '';
    public string $name = '';
    public string $email = '';
    public string $password = '';
    public string $password_confirmation = '';
    public string $plan = 'free';

    protected function rules(): array
    {
        return [
            'company_name' => 'required|string|max:255',
            'subdomain' => 'required|string|max:63|alpha_dash|unique:domains,domain',
            'name' => 'required|string|max:255',
            'email' => 'required|email|max:255',
            'password' => 'required|string|min:8|confirmed',
        ];
    }

    public function updatedCompanyName(): void
    {
        $this->subdomain = Str::slug($this->company_name);
    }

    public function register()
    {
        $this->validate();

        $tenant = Tenant::create([
            'id' => $this->subdomain,
            'name' => $this->company_name,
            'email' => $this->email,
            'plan' => $this->plan,
            'trial_ends_at' => now()->addDays(14),
        ]);

        $tenant->domains()->create([
            'domain' => $this->subdomain,
        ]);

        // Capture values before tenant->run() which rebinds $this to the Tenant model
        $userName = $this->name;
        $userEmail = $this->email;
        $userPassword = $this->password;

        $tenant->run(function () use ($userName, $userEmail, $userPassword) {
            \App\Models\User::create([
                'name' => $userName,
                'email' => $userEmail,
                'password' => $userPassword,
                'role' => 'admin',
            ]);

            // Create default pipeline
            $pipeline = \App\Models\Pipeline::create([
                'name' => 'Sales Pipeline',
                'is_default' => true,
            ]);

            $stages = [
                ['name' => 'Lead In', 'position' => 1, 'color' => '#6366f1', 'win_probability' => 10],
                ['name' => 'Qualified', 'position' => 2, 'color' => '#8b5cf6', 'win_probability' => 25],
                ['name' => 'Proposal', 'position' => 3, 'color' => '#a855f7', 'win_probability' => 50],
                ['name' => 'Negotiation', 'position' => 4, 'color' => '#f59e0b', 'win_probability' => 75],
                ['name' => 'Closed Won', 'position' => 5, 'color' => '#10b981', 'win_probability' => 100],
                ['name' => 'Closed Lost', 'position' => 6, 'color' => '#ef4444', 'win_probability' => 0],
            ];

            foreach ($stages as $stage) {
                $pipeline->stages()->create($stage);
            }
        });

        $host = $this->subdomain . '.' . request()->getHost();
        $port = request()->getPort();
        $protocol = request()->secure() ? 'https' : 'http';
        $portSuffix = in_array($port, [80, 443]) ? '' : ":{$port}";

        return redirect("{$protocol}://{$host}{$portSuffix}/login")
            ->with('success', 'Account created! Please log in.');
    }

    public function render()
    {
        return view('livewire.auth.register')
            ->layout('layouts.guest', [
                'heading' => 'Create your account',
                'subheading' => 'Start your 14-day free trial',
            ]);
    }
}
