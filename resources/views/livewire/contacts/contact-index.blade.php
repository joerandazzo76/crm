<div>
    <div class="flex items-center justify-between">
        <div>
            <h1 class="text-2xl font-bold text-gray-900">Contacts</h1>
            <p class="mt-1 text-sm text-gray-500">Manage your contacts and leads.</p>
        </div>
        <div class="flex items-center gap-2">
            <button wire:click="$set('showImportModal', true)" class="rounded-lg border border-gray-300 bg-white px-3 py-2 text-sm font-medium text-gray-700 hover:bg-gray-50 transition">
                Import
            </button>
            <button wire:click="export" class="rounded-lg border border-gray-300 bg-white px-3 py-2 text-sm font-medium text-gray-700 hover:bg-gray-50 transition">
                Export CSV
            </button>
            <a href="{{ route('contacts.create') }}" class="rounded-lg bg-primary-600 px-4 py-2 text-sm font-medium text-white hover:bg-primary-700 transition">
                + Add Contact
            </a>
        </div>
    </div>

    {{-- Filters --}}
    <div class="mt-6 flex flex-col sm:flex-row gap-4">
        <div class="relative flex-1">
            <svg class="absolute left-3 top-1/2 -translate-y-1/2 h-4 w-4 text-gray-400" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor">
                <path stroke-linecap="round" stroke-linejoin="round" d="M21 21l-5.197-5.197m0 0A7.5 7.5 0 105.196 5.196a7.5 7.5 0 0010.607 10.607z" />
            </svg>
            <input wire:model.live.debounce.300ms="search" type="search" placeholder="Search contacts..." class="w-full rounded-lg border-gray-300 pl-10 text-sm focus:border-primary-500 focus:ring-primary-500">
        </div>
        <select wire:model.live="statusFilter" class="rounded-lg border-gray-300 text-sm focus:border-primary-500 focus:ring-primary-500">
            <option value="">All Statuses</option>
            <option value="lead">Lead</option>
            <option value="customer">Customer</option>
            <option value="inactive">Inactive</option>
        </select>
    </div>

    {{-- Table --}}
    <div class="mt-4 overflow-hidden rounded-xl bg-white shadow-sm ring-1 ring-gray-200">
        <table class="min-w-full divide-y divide-gray-200">
            <thead class="bg-gray-50">
                <tr>
                    <th wire:click="sortBy('first_name')" class="cursor-pointer px-6 py-3 text-left text-xs font-medium uppercase tracking-wider text-gray-500 hover:text-gray-700">Name</th>
                    <th class="px-6 py-3 text-left text-xs font-medium uppercase tracking-wider text-gray-500">Email</th>
                    <th class="px-6 py-3 text-left text-xs font-medium uppercase tracking-wider text-gray-500">Company</th>
                    <th class="px-6 py-3 text-left text-xs font-medium uppercase tracking-wider text-gray-500">Status</th>
                    <th class="px-6 py-3 text-left text-xs font-medium uppercase tracking-wider text-gray-500">Owner</th>
                    <th class="px-6 py-3"></th>
                </tr>
            </thead>
            <tbody class="divide-y divide-gray-100 bg-white">
                @forelse($contacts as $contact)
                    <tr class="hover:bg-gray-50">
                        <td class="whitespace-nowrap px-6 py-4">
                            <a href="{{ route('contacts.show', $contact) }}" class="text-sm font-medium text-gray-900 hover:text-primary-600">
                                {{ $contact->full_name }}
                            </a>
                        </td>
                        <td class="whitespace-nowrap px-6 py-4 text-sm text-gray-500">{{ $contact->email }}</td>
                        <td class="whitespace-nowrap px-6 py-4 text-sm text-gray-500">{{ $contact->company?->name ?? '-' }}</td>
                        <td class="whitespace-nowrap px-6 py-4">
                            <span class="inline-flex items-center rounded-full px-2 py-0.5 text-xs font-medium
                                {{ $contact->status === 'lead' ? 'bg-blue-100 text-blue-700' : '' }}
                                {{ $contact->status === 'customer' ? 'bg-green-100 text-green-700' : '' }}
                                {{ $contact->status === 'inactive' ? 'bg-gray-100 text-gray-700' : '' }}
                            ">{{ ucfirst($contact->status) }}</span>
                        </td>
                        <td class="whitespace-nowrap px-6 py-4 text-sm text-gray-500">{{ $contact->owner?->name ?? '-' }}</td>
                        <td class="whitespace-nowrap px-6 py-4 text-right">
                            <div class="flex items-center gap-x-2 justify-end">
                                <a href="{{ route('contacts.edit', $contact) }}" class="text-gray-400 hover:text-gray-600">
                                    <svg class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" d="M16.862 4.487l1.687-1.688a1.875 1.875 0 112.652 2.652L10.582 16.07a4.5 4.5 0 01-1.897 1.13L6 18l.8-2.685a4.5 4.5 0 011.13-1.897l8.932-8.931zm0 0L19.5 7.125M18 14v4.75A2.25 2.25 0 0115.75 21H5.25A2.25 2.25 0 013 18.75V8.25A2.25 2.25 0 015.25 6H10" /></svg>
                                </a>
                                <button wire:click="deleteContact({{ $contact->id }})" wire:confirm="Delete this contact?" class="text-gray-400 hover:text-red-600">
                                    <svg class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" d="M14.74 9l-.346 9m-4.788 0L9.26 9m9.968-3.21c.342.052.682.107 1.022.166m-1.022-.165L18.16 19.673a2.25 2.25 0 01-2.244 2.077H8.084a2.25 2.25 0 01-2.244-2.077L4.772 5.79m14.456 0a48.108 48.108 0 00-3.478-.397m-12 .562c.34-.059.68-.114 1.022-.165m0 0a48.11 48.11 0 013.478-.397m7.5 0v-.916c0-1.18-.91-2.164-2.09-2.201a51.964 51.964 0 00-3.32 0c-1.18.037-2.09 1.022-2.09 2.201v.916m7.5 0a48.667 48.667 0 00-7.5 0" /></svg>
                                </button>
                            </div>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="6" class="px-6 py-12 text-center text-sm text-gray-500">
                            No contacts found. <a href="{{ route('contacts.create') }}" class="text-primary-600 hover:text-primary-500">Add your first contact</a>
                        </td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>

    <div class="mt-4">
        {{ $contacts->links() }}
    </div>

    {{-- Import Modal --}}
    @if($showImportModal)
    <div class="fixed inset-0 z-50 overflow-y-auto" x-data x-init="$el.querySelector('input[type=file]')?.focus()">
        <div class="flex min-h-full items-center justify-center p-4">
            <div class="fixed inset-0 bg-gray-500/75" wire:click="$set('showImportModal', false)"></div>
            <div class="relative w-full max-w-md rounded-xl bg-white p-6 shadow-xl">
                <h3 class="text-lg font-semibold text-gray-900">Import Contacts</h3>
                <p class="mt-1 text-sm text-gray-500">Upload a CSV file with columns: first_name, last_name, email, phone, status</p>
                <form wire:submit="import" class="mt-4 space-y-4">
                    <div>
                        <input wire:model="importFile" type="file" accept=".csv,.xlsx" class="block w-full text-sm text-gray-500 file:mr-4 file:rounded-lg file:border-0 file:bg-primary-50 file:px-4 file:py-2 file:text-sm file:font-medium file:text-primary-700 hover:file:bg-primary-100">
                        @error('importFile') <p class="mt-1 text-sm text-red-600">{{ $message }}</p> @enderror
                    </div>
                    <div class="flex justify-end gap-3">
                        <button type="button" wire:click="$set('showImportModal', false)" class="rounded-lg border border-gray-300 px-4 py-2 text-sm font-medium text-gray-700 hover:bg-gray-50">Cancel</button>
                        <button type="submit" class="rounded-lg bg-primary-600 px-4 py-2 text-sm font-medium text-white hover:bg-primary-700" wire:loading.attr="disabled">
                            <span wire:loading.remove wire:target="import">Import</span>
                            <span wire:loading wire:target="import">Importing...</span>
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
    @endif
</div>
