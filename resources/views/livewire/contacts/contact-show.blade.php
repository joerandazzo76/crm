<div>
    <div class="flex items-center justify-between">
        <div class="flex items-center gap-x-4">
            <a href="{{ route('contacts.index') }}" class="text-gray-400 hover:text-gray-600">
                <svg class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" d="M10.5 19.5L3 12m0 0l7.5-7.5M3 12h18" /></svg>
            </a>
            <div>
                <h1 class="text-2xl font-bold text-gray-900">{{ $contact->full_name }}</h1>
                <p class="text-sm text-gray-500">{{ $contact->position }} {{ $contact->company ? '@ ' . $contact->company->name : '' }}</p>
            </div>
        </div>
        <a href="{{ route('contacts.edit', $contact) }}" class="rounded-lg border border-gray-300 px-4 py-2 text-sm font-medium text-gray-700 hover:bg-gray-50">Edit</a>
    </div>

    <div class="mt-6 grid grid-cols-1 gap-6 lg:grid-cols-3">
        {{-- Details --}}
        <div class="lg:col-span-1 space-y-6">
            <div class="rounded-xl bg-white p-6 shadow-sm ring-1 ring-gray-200">
                <h2 class="text-sm font-semibold text-gray-900">Details</h2>
                <dl class="mt-4 space-y-3 text-sm">
                    <div><dt class="text-gray-500">Email</dt><dd class="mt-0.5 text-gray-900">{{ $contact->email ?? '-' }}</dd></div>
                    <div><dt class="text-gray-500">Phone</dt><dd class="mt-0.5 text-gray-900">{{ $contact->phone ?? '-' }}</dd></div>
                    <div><dt class="text-gray-500">Mobile</dt><dd class="mt-0.5 text-gray-900">{{ $contact->mobile ?? '-' }}</dd></div>
                    <div><dt class="text-gray-500">Status</dt>
                        <dd class="mt-0.5">
                            <span class="inline-flex items-center rounded-full px-2 py-0.5 text-xs font-medium
                                {{ $contact->status === 'lead' ? 'bg-blue-100 text-blue-700' : '' }}
                                {{ $contact->status === 'customer' ? 'bg-green-100 text-green-700' : '' }}
                                {{ $contact->status === 'inactive' ? 'bg-gray-100 text-gray-700' : '' }}
                            ">{{ ucfirst($contact->status) }}</span>
                        </dd>
                    </div>
                    <div><dt class="text-gray-500">Source</dt><dd class="mt-0.5 text-gray-900">{{ $contact->source ?? '-' }}</dd></div>
                    <div><dt class="text-gray-500">Owner</dt><dd class="mt-0.5 text-gray-900">{{ $contact->owner?->name ?? '-' }}</dd></div>
                    @if($contact->address)
                        <div><dt class="text-gray-500">Address</dt><dd class="mt-0.5 text-gray-900">{{ $contact->address }}, {{ $contact->city }} {{ $contact->state }} {{ $contact->zip }}</dd></div>
                    @endif
                </dl>
            </div>

            {{-- Deals --}}
            <div class="rounded-xl bg-white p-6 shadow-sm ring-1 ring-gray-200">
                <h2 class="text-sm font-semibold text-gray-900">Deals</h2>
                <div class="mt-3 space-y-2">
                    @forelse($contact->deals as $deal)
                        <a href="{{ route('deals.show', $deal) }}" class="flex items-center justify-between rounded-lg p-2 hover:bg-gray-50">
                            <span class="text-sm text-gray-900">{{ $deal->title }}</span>
                            <span class="text-sm font-medium text-gray-500">${{ number_format($deal->value, 0) }}</span>
                        </a>
                    @empty
                        <p class="text-sm text-gray-500">No deals linked.</p>
                    @endforelse
                </div>
            </div>
        </div>

        {{-- Notes & Activity --}}
        <div class="lg:col-span-2 space-y-6">
            {{-- Add Note --}}
            <div class="rounded-xl bg-white p-6 shadow-sm ring-1 ring-gray-200">
                <h2 class="text-sm font-semibold text-gray-900">Add Note</h2>
                <form wire:submit="addNote" class="mt-3">
                    <textarea wire:model="newNote" rows="3" class="block w-full rounded-lg border-gray-300 text-sm focus:border-primary-500 focus:ring-primary-500" placeholder="Write a note..."></textarea>
                    @error('newNote') <p class="mt-1 text-sm text-red-600">{{ $message }}</p> @enderror
                    <div class="mt-2 flex justify-end">
                        <button type="submit" class="rounded-lg bg-primary-600 px-3 py-1.5 text-sm font-medium text-white hover:bg-primary-700">Add Note</button>
                    </div>
                </form>
            </div>

            {{-- Notes --}}
            <div class="rounded-xl bg-white shadow-sm ring-1 ring-gray-200">
                <div class="border-b border-gray-100 px-6 py-4">
                    <h2 class="text-sm font-semibold text-gray-900">Notes</h2>
                </div>
                <div class="divide-y divide-gray-100">
                    @forelse($notes as $note)
                        <div class="px-6 py-4">
                            <div class="flex items-center gap-x-2">
                                <span class="text-sm font-medium text-gray-900">{{ $note->user?->name }}</span>
                                <span class="text-xs text-gray-400">{{ $note->created_at->diffForHumans() }}</span>
                            </div>
                            <p class="mt-1 text-sm text-gray-600 whitespace-pre-wrap">{{ $note->body }}</p>
                        </div>
                    @empty
                        <div class="px-6 py-8 text-center text-sm text-gray-500">No notes yet.</div>
                    @endforelse
                </div>
            </div>

            {{-- Activity Timeline --}}
            <div class="rounded-xl bg-white shadow-sm ring-1 ring-gray-200">
                <div class="border-b border-gray-100 px-6 py-4">
                    <h2 class="text-sm font-semibold text-gray-900">Activity</h2>
                </div>
                <div class="divide-y divide-gray-100">
                    @forelse($activities as $activity)
                        <div class="flex items-start gap-x-3 px-6 py-3">
                            <div class="mt-0.5 h-6 w-6 rounded-full bg-gray-100 flex items-center justify-center text-xs text-gray-500">
                                {{ substr($activity->user?->name ?? '?', 0, 1) }}
                            </div>
                            <div>
                                <p class="text-sm text-gray-700"><span class="font-medium">{{ $activity->user?->name }}</span> {{ $activity->subject }}</p>
                                <p class="text-xs text-gray-400">{{ $activity->created_at->diffForHumans() }}</p>
                            </div>
                        </div>
                    @empty
                        <div class="px-6 py-6 text-center text-sm text-gray-500">No activity yet.</div>
                    @endforelse
                </div>
            </div>
        </div>
    </div>
</div>
