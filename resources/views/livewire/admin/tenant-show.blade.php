<div>
    <div class="flex items-center justify-between">
        <div>
            <a href="{{ route('admin.dashboard') }}" class="text-sm text-gray-500 hover:text-gray-700">&larr; Back to Dashboard</a>
            <h1 class="mt-1 text-2xl font-bold text-gray-900">Tenant: {{ $tenant->name }}</h1>
            <p class="text-sm text-gray-500">ID: {{ $tenant->id }} | Database: tenant{{ $tenant->id }}</p>
        </div>
        <div class="flex items-center gap-3">
            @foreach($tenant->domains as $domain)
                <a href="http://{{ $domain->domain }}.localhost:8888" target="_blank"
                   class="inline-flex items-center gap-1.5 rounded-lg bg-primary-600 px-4 py-2 text-sm font-medium text-white hover:bg-primary-700">
                    <svg class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M13.5 6H5.25A2.25 2.25 0 003 8.25v10.5A2.25 2.25 0 005.25 21h10.5A2.25 2.25 0 0018 18.75V10.5m-10.5 6L21 3m0 0h-5.25M21 3v5.25" />
                    </svg>
                    Open Tenant
                </a>
            @endforeach
            <button wire:click="deleteTenant" wire:confirm="Are you sure you want to delete this tenant? This will destroy the database."
                    class="inline-flex items-center gap-1.5 rounded-lg bg-red-600 px-4 py-2 text-sm font-medium text-white hover:bg-red-700">
                Delete Tenant
            </button>
        </div>
    </div>

    {{-- Tenant Info --}}
    <div class="mt-6 grid grid-cols-1 gap-6 lg:grid-cols-2">
        <div class="rounded-xl bg-white p-6 shadow-sm ring-1 ring-gray-200">
            <h2 class="text-lg font-semibold text-gray-900">Details</h2>
            <dl class="mt-4 space-y-3">
                <div class="flex justify-between">
                    <dt class="text-sm text-gray-500">Name</dt>
                    <dd class="text-sm font-medium text-gray-900">{{ $tenant->name }}</dd>
                </div>
                <div class="flex justify-between">
                    <dt class="text-sm text-gray-500">Email</dt>
                    <dd class="text-sm font-medium text-gray-900">{{ $tenant->email }}</dd>
                </div>
                <div class="flex justify-between">
                    <dt class="text-sm text-gray-500">Plan</dt>
                    <dd>
                        <span class="inline-flex rounded-full px-2 py-0.5 text-xs font-medium
                            {{ $tenant->plan === 'free' ? 'bg-gray-100 text-gray-700' : ($tenant->plan === 'pro' ? 'bg-blue-100 text-blue-700' : 'bg-purple-100 text-purple-700') }}">
                            {{ ucfirst($tenant->plan ?? 'free') }}
                        </span>
                    </dd>
                </div>
                <div class="flex justify-between">
                    <dt class="text-sm text-gray-500">Trial Ends</dt>
                    <dd class="text-sm font-medium text-gray-900">{{ $tenant->trial_ends_at?->format('M d, Y') ?? 'N/A' }}</dd>
                </div>
                <div class="flex justify-between">
                    <dt class="text-sm text-gray-500">Created</dt>
                    <dd class="text-sm font-medium text-gray-900">{{ $tenant->created_at->format('M d, Y H:i') }}</dd>
                </div>
                <div class="flex justify-between">
                    <dt class="text-sm text-gray-500">Domains</dt>
                    <dd class="text-sm font-medium text-gray-900">
                        @foreach($tenant->domains as $domain)
                            {{ $domain->domain }}.localhost{{ !$loop->last ? ', ' : '' }}
                        @endforeach
                    </dd>
                </div>
            </dl>
        </div>

        {{-- Stats --}}
        <div class="rounded-xl bg-white p-6 shadow-sm ring-1 ring-gray-200">
            <h2 class="text-lg font-semibold text-gray-900">Tenant Stats</h2>
            <div class="mt-4 grid grid-cols-2 gap-4">
                @foreach($tenantStats as $label => $count)
                    <div class="rounded-lg bg-gray-50 p-4">
                        <p class="text-sm text-gray-500">{{ ucfirst($label) }}</p>
                        <p class="text-xl font-bold text-gray-900">{{ $count }}</p>
                    </div>
                @endforeach
            </div>
        </div>
    </div>

    {{-- Tenant Users --}}
    <div class="mt-6 rounded-xl bg-white shadow-sm ring-1 ring-gray-200">
        <div class="px-6 py-4 border-b border-gray-200">
            <h2 class="text-lg font-semibold text-gray-900">Users ({{ count($tenantUsers) }})</h2>
        </div>
        <div class="overflow-x-auto">
            <table class="min-w-full divide-y divide-gray-200">
                <thead class="bg-gray-50">
                    <tr>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">ID</th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Name</th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Email</th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Role</th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Created</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-gray-200">
                    @forelse($tenantUsers as $user)
                        <tr class="hover:bg-gray-50">
                            <td class="px-6 py-4 text-sm text-gray-900">{{ $user['id'] }}</td>
                            <td class="px-6 py-4 text-sm font-medium text-gray-900">{{ $user['name'] }}</td>
                            <td class="px-6 py-4 text-sm text-gray-500">{{ $user['email'] }}</td>
                            <td class="px-6 py-4">
                                <span class="inline-flex rounded-full px-2 py-0.5 text-xs font-medium {{ ($user['role'] ?? '') === 'admin' ? 'bg-red-100 text-red-700' : 'bg-gray-100 text-gray-700' }}">
                                    {{ ucfirst($user['role'] ?? 'member') }}
                                </span>
                            </td>
                            <td class="px-6 py-4 text-sm text-gray-500">{{ \Carbon\Carbon::parse($user['created_at'])->format('M d, Y') }}</td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="5" class="px-6 py-8 text-center text-sm text-gray-500">No users.</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
</div>
