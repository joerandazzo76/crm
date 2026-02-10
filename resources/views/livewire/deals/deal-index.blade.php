<div>
    <div class="flex items-center justify-between">
        <div>
            <h1 class="text-2xl font-bold text-gray-900">Deals</h1>
            <p class="mt-1 text-sm text-gray-500">Track and manage your sales deals.</p>
        </div>
        <div class="flex items-center gap-x-3">
            <a href="{{ route('deals.kanban') }}" class="rounded-lg border border-gray-300 px-4 py-2 text-sm font-medium text-gray-700 hover:bg-gray-50">Kanban View</a>
            <a href="{{ route('deals.create') }}" class="rounded-lg bg-primary-600 px-4 py-2 text-sm font-medium text-white hover:bg-primary-700">+ Add Deal</a>
        </div>
    </div>

    <div class="mt-6 flex gap-4">
        <input wire:model.live.debounce.300ms="search" type="search" placeholder="Search deals..." class="flex-1 max-w-md rounded-lg border-gray-300 text-sm focus:border-primary-500 focus:ring-primary-500">
        <select wire:model.live="statusFilter" class="rounded-lg border-gray-300 text-sm">
            <option value="">All</option>
            <option value="open">Open</option>
            <option value="won">Won</option>
            <option value="lost">Lost</option>
        </select>
    </div>

    <div class="mt-4 overflow-hidden rounded-xl bg-white shadow-sm ring-1 ring-gray-200">
        <table class="min-w-full divide-y divide-gray-200">
            <thead class="bg-gray-50">
                <tr>
                    <th class="px-6 py-3 text-left text-xs font-medium uppercase tracking-wider text-gray-500">Deal</th>
                    <th class="px-6 py-3 text-left text-xs font-medium uppercase tracking-wider text-gray-500">Value</th>
                    <th class="px-6 py-3 text-left text-xs font-medium uppercase tracking-wider text-gray-500">Stage</th>
                    <th class="px-6 py-3 text-left text-xs font-medium uppercase tracking-wider text-gray-500">Contact</th>
                    <th class="px-6 py-3 text-left text-xs font-medium uppercase tracking-wider text-gray-500">Status</th>
                    <th class="px-6 py-3 text-left text-xs font-medium uppercase tracking-wider text-gray-500">Close Date</th>
                </tr>
            </thead>
            <tbody class="divide-y divide-gray-100">
                @forelse($deals as $deal)
                    <tr class="hover:bg-gray-50">
                        <td class="px-6 py-4"><a href="{{ route('deals.show', $deal) }}" class="text-sm font-medium text-gray-900 hover:text-primary-600">{{ $deal->title }}</a></td>
                        <td class="px-6 py-4 text-sm font-medium text-gray-900">${{ number_format($deal->value, 0) }}</td>
                        <td class="px-6 py-4"><span class="inline-flex items-center rounded-full px-2 py-0.5 text-xs font-medium" style="background-color: {{ $deal->stage?->color }}20; color: {{ $deal->stage?->color }}">{{ $deal->stage?->name }}</span></td>
                        <td class="px-6 py-4 text-sm text-gray-500">{{ $deal->contact?->full_name ?? '-' }}</td>
                        <td class="px-6 py-4">
                            <span class="inline-flex items-center rounded-full px-2 py-0.5 text-xs font-medium {{ $deal->status === 'open' ? 'bg-blue-100 text-blue-700' : ($deal->status === 'won' ? 'bg-green-100 text-green-700' : 'bg-red-100 text-red-700') }}">{{ ucfirst($deal->status) }}</span>
                        </td>
                        <td class="px-6 py-4 text-sm text-gray-500">{{ $deal->expected_close_date?->format('M d, Y') ?? '-' }}</td>
                    </tr>
                @empty
                    <tr><td colspan="6" class="px-6 py-12 text-center text-sm text-gray-500">No deals yet. <a href="{{ route('deals.create') }}" class="text-primary-600">Create one</a></td></tr>
                @endforelse
            </tbody>
        </table>
    </div>
    <div class="mt-4">{{ $deals->links() }}</div>
</div>
