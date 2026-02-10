<div>
    <div class="flex items-center justify-between">
        <div>
            <h1 class="text-2xl font-bold text-gray-900">Emails</h1>
            <p class="mt-1 text-sm text-gray-500">Track email communication with contacts.</p>
        </div>
        <a href="{{ route('emails.compose') }}" class="rounded-lg bg-primary-600 px-4 py-2 text-sm font-medium text-white hover:bg-primary-700">Compose</a>
    </div>

    <div class="mt-6">
        <input wire:model.live.debounce.300ms="search" type="search" placeholder="Search emails..." class="w-full max-w-md rounded-lg border-gray-300 text-sm focus:border-primary-500 focus:ring-primary-500">
    </div>

    <div class="mt-4 rounded-xl bg-white shadow-sm ring-1 ring-gray-200 divide-y divide-gray-100">
        @forelse($emails as $email)
            <div class="flex items-center gap-x-4 px-6 py-3 hover:bg-gray-50">
                <div class="shrink-0">
                    <span class="inline-flex items-center rounded-full px-2 py-0.5 text-xs font-medium {{ $email->direction === 'outbound' ? 'bg-blue-100 text-blue-700' : 'bg-green-100 text-green-700' }}">
                        {{ $email->direction === 'outbound' ? 'Sent' : 'Received' }}
                    </span>
                </div>
                <div class="flex-1 min-w-0">
                    <p class="text-sm font-medium text-gray-900 truncate">{{ $email->subject }}</p>
                    <p class="text-xs text-gray-500">{{ $email->to_email }} &middot; {{ $email->contact?->full_name }}</p>
                </div>
                <span class="text-xs text-gray-400">{{ $email->created_at->diffForHumans() }}</span>
            </div>
        @empty
            <div class="px-6 py-12 text-center text-sm text-gray-500">No emails yet. <a href="{{ route('emails.compose') }}" class="text-primary-600">Send one</a></div>
        @endforelse
    </div>
    <div class="mt-4">{{ $emails->links() }}</div>
</div>
