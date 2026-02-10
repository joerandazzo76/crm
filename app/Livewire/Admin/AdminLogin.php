<?php

namespace App\Livewire\Admin;

use Illuminate\Support\Facades\Auth;
use Livewire\Component;

class AdminLogin extends Component
{
    public string $email = '';
    public string $password = '';
    public bool $remember = false;

    protected array $rules = [
        'email' => 'required|email',
        'password' => 'required',
    ];

    public function login()
    {
        $this->validate();

        if (!Auth::guard('admin')->attempt(
            ['email' => $this->email, 'password' => $this->password],
            $this->remember
        )) {
            $this->addError('email', 'These credentials do not match our records.');
            return;
        }

        session()->regenerate();

        return redirect()->route('admin.dashboard');
    }

    public function render()
    {
        return view('livewire.admin.admin-login')
            ->layout('layouts.guest', [
                'heading' => 'Admin Login',
                'subheading' => 'Central administration panel',
            ]);
    }
}
