<?php

namespace App\Livewire\Settings;

use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Livewire\Component;

class TeamMembers extends Component
{
    public bool $showInviteModal = false;
    public string $inviteName = '';
    public string $inviteEmail = '';
    public string $inviteRole = 'member';
    public string $invitePassword = '';

    public function invite(): void
    {
        $this->validate([
            'inviteName' => 'required|string|max:255',
            'inviteEmail' => 'required|email|unique:users,email',
            'inviteRole' => 'required|in:admin,manager,member',
            'invitePassword' => 'required|string|min:8',
        ]);

        User::create([
            'name' => $this->inviteName,
            'email' => $this->inviteEmail,
            'role' => $this->inviteRole,
            'password' => Hash::make($this->invitePassword),
        ]);

        $this->reset(['inviteName', 'inviteEmail', 'inviteRole', 'invitePassword', 'showInviteModal']);
        session()->flash('success', 'Team member added.');
    }

    public function removeUser(int $id): void
    {
        if ($id === auth()->id()) return;
        User::findOrFail($id)->delete();
    }

    public function render()
    {
        return view('livewire.settings.team-members', [
            'members' => User::orderBy('name')->get(),
        ])->layout('layouts.app', ['title' => 'Team Members']);
    }
}
