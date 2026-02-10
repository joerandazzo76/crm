<div class="relative flex-1 max-w-lg" x-data @keydown.escape.window="$wire.close()">
    <svg class="pointer-events-none absolute left-3 top-1/2 -translate-y-1/2 h-4 w-4 text-gray-400" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor">
        <path stroke-linecap="round" stroke-linejoin="round" d="M21 21l-5.197-5.197m0 0A7.5 7.5 0 105.196 5.196a7.5 7.5 0 0010.607 10.607z" />
    </svg>
    <input wire:model.live.debounce.300ms="query" type="search" placeholder="Search contacts, deals, companies..."
           class="w-full rounded-lg border-0 bg-gray-50 py-2 pl-10 pr-4 text-sm text-gray-900 ring-1 ring-gray-200 placeholder:text-gray-400 focus:ring-2 focus:ring-primary-500"
           @focus="if($wire.query.length >= 2) $wire.showResults = true"
           @click.away="$wire.showResults = false">

    @if($showResults && count($results) > 0)
    <div class="absolute top-full left-0 right-0 mt-1 rounded-xl bg-white shadow-xl ring-1 ring-gray-200 z-50 max-h-96 overflow-y-auto">
        {{-- Contacts --}}
        @if(isset($results['contacts']) && $results['contacts']->count())
        <div class="px-3 py-2 border-b border-gray-100">
            <p class="text-xs font-semibold text-gray-400 uppercase">Contacts</p>
        </div>
        @foreach($results['contacts'] as $contact)
            <a href="{{ route('contacts.show', $contact) }}" class="flex items-center gap-3 px-3 py-2 hover:bg-gray-50" wire:click="close">
                <div class="h-8 w-8 rounded-full bg-blue-100 flex items-center justify-center shrink-0">
                    <span class="text-xs font-medium text-blue-700">{{ substr($contact->first_name, 0, 1) }}{{ substr($contact->last_name, 0, 1) }}</span>
                </div>
                <div class="min-w-0">
                    <p class="text-sm font-medium text-gray-900 truncate">{{ $contact->first_name }} {{ $contact->last_name }}</p>
                    <p class="text-xs text-gray-500 truncate">{{ $contact->email }}</p>
                </div>
            </a>
        @endforeach
        @endif

        {{-- Companies --}}
        @if(isset($results['companies']) && $results['companies']->count())
        <div class="px-3 py-2 border-b border-gray-100 {{ isset($results['contacts']) && $results['contacts']->count() ? 'border-t' : '' }}">
            <p class="text-xs font-semibold text-gray-400 uppercase">Companies</p>
        </div>
        @foreach($results['companies'] as $company)
            <a href="{{ route('companies.show', $company) }}" class="flex items-center gap-3 px-3 py-2 hover:bg-gray-50" wire:click="close">
                <div class="h-8 w-8 rounded-full bg-green-100 flex items-center justify-center shrink-0">
                    <span class="text-xs font-medium text-green-700">{{ substr($company->name, 0, 2) }}</span>
                </div>
                <div class="min-w-0">
                    <p class="text-sm font-medium text-gray-900 truncate">{{ $company->name }}</p>
                    <p class="text-xs text-gray-500 truncate">{{ $company->industry }}</p>
                </div>
            </a>
        @endforeach
        @endif

        {{-- Deals --}}
        @if(isset($results['deals']) && $results['deals']->count())
        <div class="px-3 py-2 border-b border-gray-100 border-t">
            <p class="text-xs font-semibold text-gray-400 uppercase">Deals</p>
        </div>
        @foreach($results['deals'] as $deal)
            <a href="{{ route('deals.show', $deal) }}" class="flex items-center gap-3 px-3 py-2 hover:bg-gray-50" wire:click="close">
                <div class="h-8 w-8 rounded-full bg-amber-100 flex items-center justify-center shrink-0">
                    <span class="text-xs font-medium text-amber-700">$</span>
                </div>
                <div class="min-w-0">
                    <p class="text-sm font-medium text-gray-900 truncate">{{ $deal->title }}</p>
                    <p class="text-xs text-gray-500">${{ number_format($deal->value, 0) }}</p>
                </div>
            </a>
        @endforeach
        @endif

        @if(
            (!isset($results['contacts']) || !$results['contacts']->count()) &&
            (!isset($results['companies']) || !$results['companies']->count()) &&
            (!isset($results['deals']) || !$results['deals']->count())
        )
        <div class="px-4 py-6 text-center text-sm text-gray-500">No results found for "{{ $query }}"</div>
        @endif
    </div>
    @endif
</div>
