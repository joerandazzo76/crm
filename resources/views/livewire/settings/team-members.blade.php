<div>
    <h1 class="text-2xl font-bold text-gray-900">Settings</h1>

    <x-settings-tabs active="team" />

    <div class="mt-6 max-w-2xl">
        <div class="flex items-center justify-between">
            <h2 class="text-lg font-semibold text-gray-900">Team Members</h2>
            <button wire:click="$set('showInviteModal', true)" class="rounded-lg bg-primary-600 px-4 py-2 text-sm font-medium text-white hover:bg-primary-700">+ Add Member</button>
        </div>

        <div class="mt-4 rounded-xl bg-white shadow-sm ring-1 ring-gray-200 divide-y divide-gray-100">
            @foreach($members as $member)
                <div class="flex items-center justify-between px-6 py-4">
                    <div class="flex items-center gap-x-3">
                        <div class="h-8 w-8 rounded-full bg-primary-100 flex items-center justify-center text-sm font-medium text-primary-700">{{ substr($member->name, 0, 1) }}</div>
                        <div>
                            <p class="text-sm font-medium text-gray-900">{{ $member->name }}</p>
                            <p class="text-xs text-gray-500">{{ $member->email }}</p>
                        </div>
                    </div>
                    <div class="flex items-center gap-x-3">
                        <span class="inline-flex items-center rounded-full px-2 py-0.5 text-xs font-medium bg-gray-100 text-gray-700">{{ ucfirst($member->role) }}</span>
                        @if($member->id !== auth()->id())
                            <button wire:click="removeUser({{ $member->id }})" wire:confirm="Remove this team member?" class="text-gray-400 hover:text-red-500">
                                <svg class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" d="M6 18L18 6M6 6l12 12" /></svg>
                            </button>
                        @endif
                    </div>
                </div>
            @endforeach
        </div>
    </div>

    @if($showInviteModal)
        <div class="fixed inset-0 z-50 overflow-y-auto">
            <div class="fixed inset-0 bg-gray-500/75" wire:click="$set('showInviteModal', false)"></div>
            <div class="relative mx-auto mt-20 max-w-lg rounded-xl bg-white p-6 shadow-xl">
                <h2 class="text-lg font-semibold text-gray-900">Add Team Member</h2>
                <form wire:submit="invite" class="mt-4 space-y-4">
                    <div><label class="block text-sm font-medium text-gray-700">Name *</label><input wire:model="inviteName" type="text" class="mt-1 block w-full rounded-lg border-gray-300 text-sm focus:border-primary-500 focus:ring-primary-500">@error('inviteName')<p class="mt-1 text-sm text-red-600">{{ $message }}</p>@enderror</div>
                    <div><label class="block text-sm font-medium text-gray-700">Email *</label><input wire:model="inviteEmail" type="email" class="mt-1 block w-full rounded-lg border-gray-300 text-sm focus:border-primary-500 focus:ring-primary-500">@error('inviteEmail')<p class="mt-1 text-sm text-red-600">{{ $message }}</p>@enderror</div>
                    <div><label class="block text-sm font-medium text-gray-700">Password *</label><input wire:model="invitePassword" type="password" class="mt-1 block w-full rounded-lg border-gray-300 text-sm focus:border-primary-500 focus:ring-primary-500">@error('invitePassword')<p class="mt-1 text-sm text-red-600">{{ $message }}</p>@enderror</div>
                    <div><label class="block text-sm font-medium text-gray-700">Role</label><select wire:model="inviteRole" class="mt-1 block w-full rounded-lg border-gray-300 text-sm focus:border-primary-500 focus:ring-primary-500"><option value="member">Member</option><option value="manager">Manager</option><option value="admin">Admin</option></select></div>
                    <div class="flex justify-end gap-x-3">
                        <button type="button" wire:click="$set('showInviteModal', false)" class="rounded-lg border border-gray-300 px-4 py-2 text-sm font-medium text-gray-700 hover:bg-gray-50">Cancel</button>
                        <button type="submit" class="rounded-lg bg-primary-600 px-4 py-2 text-sm font-medium text-white hover:bg-primary-700">Add Member</button>
                    </div>
                </form>
            </div>
        </div>
    @endif
</div>
