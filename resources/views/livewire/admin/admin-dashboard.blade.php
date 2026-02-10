<div>
    <h1 class="text-2xl font-bold text-gray-900">Admin Dashboard</h1>
    <p class="mt-1 text-sm text-gray-500">Overview of all tenants and system status</p>

    {{-- Stats --}}
    <div class="mt-6 grid grid-cols-1 gap-5 sm:grid-cols-3">
        <div class="rounded-xl bg-white p-6 shadow-sm ring-1 ring-gray-200">
            <div class="flex items-center gap-x-3">
                <div class="rounded-lg bg-blue-50 p-2">
                    <svg class="h-6 w-6 text-blue-600" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M3.75 21h16.5M4.5 3h15M5.25 3v18m13.5-18v18M9 6.75h1.5m-1.5 3h1.5m-1.5 3h1.5m3-6H15m-1.5 3H15m-1.5 3H15M9 21v-3.375c0-.621.504-1.125 1.125-1.125h3.75c.621 0 1.125.504 1.125 1.125V21" />
                    </svg>
                </div>
                <div>
                    <p class="text-sm text-gray-500">Total Tenants</p>
                    <p class="text-2xl font-bold text-gray-900">{{ $totalTenants }}</p>
                </div>
            </div>
        </div>

        <div class="rounded-xl bg-white p-6 shadow-sm ring-1 ring-gray-200">
            <div class="flex items-center gap-x-3">
                <div class="rounded-lg bg-green-50 p-2">
                    <svg class="h-6 w-6 text-green-600" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M12 21a9.004 9.004 0 008.716-6.747M12 21a9.004 9.004 0 01-8.716-6.747M12 21c2.485 0 4.5-4.03 4.5-9S14.485 3 12 3m0 18c-2.485 0-4.5-4.03-4.5-9S9.515 3 12 3m0 0a8.997 8.997 0 017.843 4.582M12 3a8.997 8.997 0 00-7.843 4.582m15.686 0A11.953 11.953 0 0112 10.5c-2.998 0-5.74-1.1-7.843-2.918m15.686 0A8.959 8.959 0 0121 12c0 .778-.099 1.533-.284 2.253m0 0A17.919 17.919 0 0112 16.5c-3.162 0-6.133-.815-8.716-2.247m0 0A9.015 9.015 0 013 12c0-1.605.42-3.113 1.157-4.418" />
                    </svg>
                </div>
                <div>
                    <p class="text-sm text-gray-500">Domains</p>
                    <p class="text-2xl font-bold text-gray-900">{{ $totalDomains }}</p>
                </div>
            </div>
        </div>

        <div class="rounded-xl bg-white p-6 shadow-sm ring-1 ring-gray-200">
            <div class="flex items-center gap-x-3">
                <div class="rounded-lg bg-purple-50 p-2">
                    <svg class="h-6 w-6 text-purple-600" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M9.568 3H5.25A2.25 2.25 0 003 5.25v4.318c0 .597.237 1.17.659 1.591l9.581 9.581c.699.699 1.78.872 2.607.33a18.095 18.095 0 005.223-5.223c.542-.827.369-1.908-.33-2.607L11.16 3.66A2.25 2.25 0 009.568 3z" />
                        <path stroke-linecap="round" stroke-linejoin="round" d="M6 6h.008v.008H6V6z" />
                    </svg>
                </div>
                <div>
                    <p class="text-sm text-gray-500">Plans</p>
                    <p class="text-2xl font-bold text-gray-900">{{ $totalPlans }}</p>
                </div>
            </div>
        </div>
    </div>

    {{-- Plan Breakdown --}}
    @if(count($planBreakdown) > 0)
    <div class="mt-6 rounded-xl bg-white p-6 shadow-sm ring-1 ring-gray-200">
        <h2 class="text-lg font-semibold text-gray-900">Tenants by Plan</h2>
        <div class="mt-3 flex gap-4">
            @foreach($planBreakdown as $plan => $count)
                <span class="inline-flex items-center gap-x-1.5 rounded-full px-3 py-1 text-sm font-medium
                    {{ $plan === 'free' ? 'bg-gray-100 text-gray-700' : ($plan === 'pro' ? 'bg-blue-100 text-blue-700' : 'bg-purple-100 text-purple-700') }}">
                    {{ ucfirst($plan) }}: {{ $count }}
                </span>
            @endforeach
        </div>
    </div>
    @endif

    {{-- Recent Tenants --}}
    <div class="mt-6 rounded-xl bg-white shadow-sm ring-1 ring-gray-200">
        <div class="px-6 py-4 border-b border-gray-200">
            <h2 class="text-lg font-semibold text-gray-900">All Tenants</h2>
        </div>
        <div class="overflow-x-auto">
            <table class="min-w-full divide-y divide-gray-200">
                <thead class="bg-gray-50">
                    <tr>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">ID</th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Name</th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Email</th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Plan</th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Domain</th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Created</th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Actions</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-gray-200">
                    @forelse($recentTenants as $tenant)
                        <tr class="hover:bg-gray-50">
                            <td class="px-6 py-4 text-sm font-mono text-gray-900">{{ $tenant->id }}</td>
                            <td class="px-6 py-4 text-sm text-gray-900">{{ $tenant->name }}</td>
                            <td class="px-6 py-4 text-sm text-gray-500">{{ $tenant->email }}</td>
                            <td class="px-6 py-4">
                                <span class="inline-flex rounded-full px-2 py-0.5 text-xs font-medium
                                    {{ $tenant->plan === 'free' ? 'bg-gray-100 text-gray-700' : ($tenant->plan === 'pro' ? 'bg-blue-100 text-blue-700' : 'bg-purple-100 text-purple-700') }}">
                                    {{ ucfirst($tenant->plan ?? 'free') }}
                                </span>
                            </td>
                            <td class="px-6 py-4 text-sm text-gray-500">
                                @foreach($tenant->domains as $domain)
                                    <a href="http://{{ $domain->domain }}.localhost:8888" target="_blank" class="text-primary-600 hover:underline">
                                        {{ $domain->domain }}.localhost
                                    </a>
                                @endforeach
                            </td>
                            <td class="px-6 py-4 text-sm text-gray-500">{{ $tenant->created_at->diffForHumans() }}</td>
                            <td class="px-6 py-4 text-sm">
                                <a href="{{ route('admin.tenants.show', $tenant->id) }}" class="text-primary-600 hover:text-primary-800 font-medium">View</a>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="7" class="px-6 py-8 text-center text-sm text-gray-500">No tenants yet.</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
</div>
