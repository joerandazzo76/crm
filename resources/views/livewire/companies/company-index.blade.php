<div>
    <div class="flex items-center justify-between">
        <div>
            <h1 class="text-2xl font-bold text-gray-900">Companies</h1>
            <p class="mt-1 text-sm text-gray-500">Manage your company accounts.</p>
        </div>
        <div class="flex items-center gap-2">
            <button wire:click="export" class="rounded-lg border border-gray-300 bg-white px-3 py-2 text-sm font-medium text-gray-700 hover:bg-gray-50 transition">Export CSV</button>
            <a href="{{ route('companies.create') }}" class="rounded-lg bg-primary-600 px-4 py-2 text-sm font-medium text-white hover:bg-primary-700 transition">+ Add Company</a>
        </div>
    </div>

    <div class="mt-6">
        <input wire:model.live.debounce.300ms="search" type="search" placeholder="Search companies..." class="w-full max-w-md rounded-lg border-gray-300 text-sm focus:border-primary-500 focus:ring-primary-500">
    </div>

    <div class="mt-4 overflow-hidden rounded-xl bg-white shadow-sm ring-1 ring-gray-200">
        <table class="min-w-full divide-y divide-gray-200">
            <thead class="bg-gray-50">
                <tr>
                    <th class="px-6 py-3 text-left text-xs font-medium uppercase tracking-wider text-gray-500">Name</th>
                    <th class="px-6 py-3 text-left text-xs font-medium uppercase tracking-wider text-gray-500">Industry</th>
                    <th class="px-6 py-3 text-left text-xs font-medium uppercase tracking-wider text-gray-500">Contacts</th>
                    <th class="px-6 py-3 text-left text-xs font-medium uppercase tracking-wider text-gray-500">Deals</th>
                    <th class="px-6 py-3 text-left text-xs font-medium uppercase tracking-wider text-gray-500">Owner</th>
                    <th class="px-6 py-3"></th>
                </tr>
            </thead>
            <tbody class="divide-y divide-gray-100">
                @forelse($companies as $company)
                    <tr class="hover:bg-gray-50">
                        <td class="px-6 py-4"><a href="{{ route('companies.show', $company) }}" class="text-sm font-medium text-gray-900 hover:text-primary-600">{{ $company->name }}</a></td>
                        <td class="px-6 py-4 text-sm text-gray-500">{{ $company->industry ?? '-' }}</td>
                        <td class="px-6 py-4 text-sm text-gray-500">{{ $company->contacts_count }}</td>
                        <td class="px-6 py-4 text-sm text-gray-500">{{ $company->deals_count }}</td>
                        <td class="px-6 py-4 text-sm text-gray-500">{{ $company->owner?->name ?? '-' }}</td>
                        <td class="px-6 py-4 text-right">
                            <a href="{{ route('companies.edit', $company) }}" class="text-gray-400 hover:text-gray-600">
                                <svg class="h-4 w-4 inline" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" d="M16.862 4.487l1.687-1.688a1.875 1.875 0 112.652 2.652L10.582 16.07a4.5 4.5 0 01-1.897 1.13L6 18l.8-2.685a4.5 4.5 0 011.13-1.897l8.932-8.931zm0 0L19.5 7.125M18 14v4.75A2.25 2.25 0 0115.75 21H5.25A2.25 2.25 0 013 18.75V8.25A2.25 2.25 0 015.25 6H10" /></svg>
                            </a>
                        </td>
                    </tr>
                @empty
                    <tr><td colspan="6" class="px-6 py-12 text-center text-sm text-gray-500">No companies yet. <a href="{{ route('companies.create') }}" class="text-primary-600">Add one</a></td></tr>
                @endforelse
            </tbody>
        </table>
    </div>
    <div class="mt-4">{{ $companies->links() }}</div>
</div>
