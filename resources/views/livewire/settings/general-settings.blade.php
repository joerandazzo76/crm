<div>
    <h1 class="text-2xl font-bold text-gray-900">Settings</h1>

    <x-settings-tabs active="general" />

    <div class="mt-6 grid grid-cols-1 gap-6 lg:grid-cols-2">
        {{-- Organization Info --}}
        <div class="rounded-xl bg-white p-6 shadow-sm ring-1 ring-gray-200">
            <h2 class="text-lg font-semibold text-gray-900">Organization</h2>
            <dl class="mt-4 space-y-3">
                <div class="flex justify-between">
                    <dt class="text-sm text-gray-500">Tenant ID</dt>
                    <dd class="text-sm font-mono font-medium text-gray-900">{{ $tenant?->id ?? 'N/A' }}</dd>
                </div>
                <div class="flex justify-between">
                    <dt class="text-sm text-gray-500">Organization Name</dt>
                    <dd class="text-sm font-medium text-gray-900">{{ $tenant?->name ?? 'N/A' }}</dd>
                </div>
                <div class="flex justify-between">
                    <dt class="text-sm text-gray-500">Plan</dt>
                    <dd>
                        <span class="inline-flex rounded-full px-2 py-0.5 text-xs font-medium bg-primary-100 text-primary-700">{{ ucfirst($tenant?->plan ?? 'free') }}</span>
                    </dd>
                </div>
                <div class="flex justify-between">
                    <dt class="text-sm text-gray-500">Trial Ends</dt>
                    <dd class="text-sm font-medium text-gray-900">{{ $tenant?->trial_ends_at?->format('M d, Y') ?? 'N/A' }}</dd>
                </div>
            </dl>
        </div>

        {{-- Usage Stats --}}
        <div class="rounded-xl bg-white p-6 shadow-sm ring-1 ring-gray-200">
            <h2 class="text-lg font-semibold text-gray-900">Usage</h2>
            <div class="mt-4 grid grid-cols-2 gap-4">
                @foreach($stats as $label => $count)
                    <div class="rounded-lg bg-gray-50 p-4">
                        <p class="text-sm text-gray-500">{{ ucfirst($label) }}</p>
                        <p class="text-xl font-bold text-gray-900">{{ number_format($count) }}</p>
                    </div>
                @endforeach
            </div>
        </div>

        {{-- Preferences --}}
        <div class="rounded-xl bg-white p-6 shadow-sm ring-1 ring-gray-200 lg:col-span-2">
            <h2 class="text-lg font-semibold text-gray-900">Preferences</h2>
            <form wire:submit="saveSettings" class="mt-4 grid grid-cols-1 gap-4 sm:grid-cols-3">
                <div>
                    <label class="block text-sm font-medium text-gray-700">Timezone</label>
                    <select wire:model="timezone" class="mt-1 block w-full rounded-lg border-gray-300 text-sm focus:border-primary-500 focus:ring-primary-500">
                        <option value="UTC">UTC</option>
                        <option value="America/New_York">Eastern Time</option>
                        <option value="America/Chicago">Central Time</option>
                        <option value="America/Denver">Mountain Time</option>
                        <option value="America/Los_Angeles">Pacific Time</option>
                        <option value="Europe/London">London</option>
                        <option value="Europe/Paris">Paris</option>
                        <option value="Asia/Tokyo">Tokyo</option>
                        <option value="Asia/Shanghai">Shanghai</option>
                        <option value="Australia/Sydney">Sydney</option>
                    </select>
                </div>
                <div>
                    <label class="block text-sm font-medium text-gray-700">Currency</label>
                    <select wire:model="currency" class="mt-1 block w-full rounded-lg border-gray-300 text-sm focus:border-primary-500 focus:ring-primary-500">
                        <option value="USD">USD ($)</option>
                        <option value="EUR">EUR (&euro;)</option>
                        <option value="GBP">GBP (&pound;)</option>
                        <option value="CAD">CAD ($)</option>
                        <option value="AUD">AUD ($)</option>
                    </select>
                </div>
                <div>
                    <label class="block text-sm font-medium text-gray-700">Date Format</label>
                    <select wire:model="dateFormat" class="mt-1 block w-full rounded-lg border-gray-300 text-sm focus:border-primary-500 focus:ring-primary-500">
                        <option value="M d, Y">Jan 15, 2026</option>
                        <option value="d/m/Y">15/01/2026</option>
                        <option value="Y-m-d">2026-01-15</option>
                        <option value="m/d/Y">01/15/2026</option>
                    </select>
                </div>
                <div class="sm:col-span-3">
                    <button type="submit" class="rounded-lg bg-primary-600 px-4 py-2 text-sm font-medium text-white hover:bg-primary-700 transition">Save Settings</button>
                </div>
            </form>
        </div>
    </div>
</div>
