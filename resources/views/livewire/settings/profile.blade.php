<div>
    <h1 class="text-2xl font-bold text-gray-900">Settings</h1>

    <x-settings-tabs active="profile" />

    <div class="mt-6 max-w-2xl space-y-6">
        {{-- Profile --}}
        <form wire:submit="updateProfile">
            <div class="rounded-xl bg-white p-6 shadow-sm ring-1 ring-gray-200 space-y-4">
                <h2 class="text-sm font-semibold text-gray-900">Profile Information</h2>
                <div class="grid grid-cols-1 gap-4 sm:grid-cols-2">
                    <div><label class="block text-sm font-medium text-gray-700">Name</label><input wire:model="name" type="text" class="mt-1 block w-full rounded-lg border-gray-300 text-sm focus:border-primary-500 focus:ring-primary-500">@error('name')<p class="mt-1 text-sm text-red-600">{{ $message }}</p>@enderror</div>
                    <div><label class="block text-sm font-medium text-gray-700">Email</label><input wire:model="email" type="email" class="mt-1 block w-full rounded-lg border-gray-300 text-sm focus:border-primary-500 focus:ring-primary-500">@error('email')<p class="mt-1 text-sm text-red-600">{{ $message }}</p>@enderror</div>
                </div>
                <div class="grid grid-cols-1 gap-4 sm:grid-cols-2">
                    <div><label class="block text-sm font-medium text-gray-700">Phone</label><input wire:model="phone" type="text" class="mt-1 block w-full rounded-lg border-gray-300 text-sm focus:border-primary-500 focus:ring-primary-500"></div>
                    <div><label class="block text-sm font-medium text-gray-700">Timezone</label><input wire:model="timezone" type="text" class="mt-1 block w-full rounded-lg border-gray-300 text-sm focus:border-primary-500 focus:ring-primary-500"></div>
                </div>
                <div class="flex justify-end"><button type="submit" class="rounded-lg bg-primary-600 px-4 py-2 text-sm font-medium text-white hover:bg-primary-700">Save Changes</button></div>
            </div>
        </form>

        {{-- Password --}}
        <form wire:submit="updatePassword">
            <div class="rounded-xl bg-white p-6 shadow-sm ring-1 ring-gray-200 space-y-4">
                <h2 class="text-sm font-semibold text-gray-900">Change Password</h2>
                <div><label class="block text-sm font-medium text-gray-700">Current Password</label><input wire:model="current_password" type="password" class="mt-1 block w-full rounded-lg border-gray-300 text-sm focus:border-primary-500 focus:ring-primary-500">@error('current_password')<p class="mt-1 text-sm text-red-600">{{ $message }}</p>@enderror</div>
                <div class="grid grid-cols-1 gap-4 sm:grid-cols-2">
                    <div><label class="block text-sm font-medium text-gray-700">New Password</label><input wire:model="new_password" type="password" class="mt-1 block w-full rounded-lg border-gray-300 text-sm focus:border-primary-500 focus:ring-primary-500">@error('new_password')<p class="mt-1 text-sm text-red-600">{{ $message }}</p>@enderror</div>
                    <div><label class="block text-sm font-medium text-gray-700">Confirm New Password</label><input wire:model="new_password_confirmation" type="password" class="mt-1 block w-full rounded-lg border-gray-300 text-sm focus:border-primary-500 focus:ring-primary-500"></div>
                </div>
                <div class="flex justify-end"><button type="submit" class="rounded-lg bg-primary-600 px-4 py-2 text-sm font-medium text-white hover:bg-primary-700">Update Password</button></div>
            </div>
        </form>
    </div>
</div>
