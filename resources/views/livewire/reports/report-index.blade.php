<div>
    <h1 class="text-2xl font-bold text-gray-900">Reports</h1>
    <p class="mt-1 text-sm text-gray-500">Sales and activity analytics.</p>

    {{-- Revenue Stats --}}
    <div class="mt-6 grid grid-cols-1 gap-4 sm:grid-cols-2 lg:grid-cols-4">
        <div class="rounded-xl bg-white p-6 shadow-sm ring-1 ring-gray-200">
            <p class="text-sm text-gray-500">Total Revenue (Won)</p>
            <p class="mt-1 text-2xl font-bold text-green-600">${{ number_format($totalRevenue, 0) }}</p>
        </div>
        <div class="rounded-xl bg-white p-6 shadow-sm ring-1 ring-gray-200">
            <p class="text-sm text-gray-500">Average Deal Size</p>
            <p class="mt-1 text-2xl font-bold text-gray-900">${{ number_format($avgDealSize, 0) }}</p>
        </div>
        <div class="rounded-xl bg-white p-6 shadow-sm ring-1 ring-gray-200">
            <p class="text-sm text-gray-500">Win / Loss</p>
            <p class="mt-1 text-2xl font-bold text-gray-900">{{ $wonCount }} <span class="text-green-500">W</span> / {{ $lostCount }} <span class="text-red-500">L</span></p>
        </div>
        <div class="rounded-xl bg-white p-6 shadow-sm ring-1 ring-gray-200">
            <p class="text-sm text-gray-500">Open Pipeline Value</p>
            <p class="mt-1 text-2xl font-bold text-primary-600">${{ number_format($openValue, 0) }}</p>
            <p class="text-xs text-gray-400">{{ $openCount }} deals</p>
        </div>
    </div>

    {{-- Activity Stats --}}
    <div class="mt-6 grid grid-cols-1 gap-4 sm:grid-cols-2">
        <div class="rounded-xl bg-white p-6 shadow-sm ring-1 ring-gray-200">
            <p class="text-sm text-gray-500">New Contacts (This Month)</p>
            <p class="mt-1 text-2xl font-bold text-gray-900">{{ $contactsThisMonth }}</p>
        </div>
        <div class="rounded-xl bg-white p-6 shadow-sm ring-1 ring-gray-200">
            <p class="text-sm text-gray-500">Activities (This Month)</p>
            <p class="mt-1 text-2xl font-bold text-gray-900">{{ $activitiesThisMonth }}</p>
        </div>
    </div>

    {{-- Pipeline Breakdown --}}
    <div class="mt-6 rounded-xl bg-white shadow-sm ring-1 ring-gray-200">
        <div class="border-b border-gray-100 px-6 py-4">
            <h2 class="text-sm font-semibold text-gray-900">Pipeline Breakdown</h2>
        </div>
        <table class="min-w-full divide-y divide-gray-100">
            <thead class="bg-gray-50">
                <tr>
                    <th class="px-6 py-3 text-left text-xs font-medium uppercase text-gray-500">Stage</th>
                    <th class="px-6 py-3 text-left text-xs font-medium uppercase text-gray-500">Deals</th>
                    <th class="px-6 py-3 text-left text-xs font-medium uppercase text-gray-500">Value</th>
                </tr>
            </thead>
            <tbody class="divide-y divide-gray-100">
                @forelse($dealsByStage as $row)
                    <tr>
                        <td class="px-6 py-3">
                            <span class="inline-flex items-center gap-x-2">
                                <span class="h-2.5 w-2.5 rounded-full" style="background-color: {{ $row->stage?->color }}"></span>
                                <span class="text-sm text-gray-900">{{ $row->stage?->name ?? 'Unknown' }}</span>
                            </span>
                        </td>
                        <td class="px-6 py-3 text-sm text-gray-500">{{ $row->count }}</td>
                        <td class="px-6 py-3 text-sm font-medium text-gray-900">${{ number_format($row->total_value, 0) }}</td>
                    </tr>
                @empty
                    <tr><td colspan="3" class="px-6 py-8 text-center text-sm text-gray-500">No pipeline data yet.</td></tr>
                @endforelse
            </tbody>
        </table>
    </div>
</div>
