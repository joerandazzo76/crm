<div>
    <div class="flex items-center gap-x-4">
        <a href="{{ route('emails.index') }}" class="text-gray-400 hover:text-gray-600"><svg class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" d="M10.5 19.5L3 12m0 0l7.5-7.5M3 12h18" /></svg></a>
        <h1 class="text-2xl font-bold text-gray-900">Compose Email</h1>
    </div>

    <form wire:submit="send" class="mt-6 max-w-2xl">
        <div class="rounded-xl bg-white shadow-sm ring-1 ring-gray-200 p-6 space-y-4">
            <div>
                <label class="block text-sm font-medium text-gray-700">Link to Contact</label>
                <select wire:model.live="contact_id" class="mt-1 block w-full rounded-lg border-gray-300 text-sm focus:border-primary-500 focus:ring-primary-500">
                    <option value="">None</option>
                    @foreach($contacts as $contact)
                        <option value="{{ $contact->id }}">{{ $contact->full_name }} ({{ $contact->email }})</option>
                    @endforeach
                </select>
            </div>
            <div>
                <label class="block text-sm font-medium text-gray-700">To *</label>
                <input wire:model="to_email" type="email" class="mt-1 block w-full rounded-lg border-gray-300 text-sm focus:border-primary-500 focus:ring-primary-500">
                @error('to_email')<p class="mt-1 text-sm text-red-600">{{ $message }}</p>@enderror
            </div>
            <div>
                <label class="block text-sm font-medium text-gray-700">Subject *</label>
                <input wire:model="subject" type="text" class="mt-1 block w-full rounded-lg border-gray-300 text-sm focus:border-primary-500 focus:ring-primary-500">
                @error('subject')<p class="mt-1 text-sm text-red-600">{{ $message }}</p>@enderror
            </div>
            <div>
                <label class="block text-sm font-medium text-gray-700">Message *</label>
                <textarea wire:model="body" rows="8" class="mt-1 block w-full rounded-lg border-gray-300 text-sm focus:border-primary-500 focus:ring-primary-500"></textarea>
                @error('body')<p class="mt-1 text-sm text-red-600">{{ $message }}</p>@enderror
            </div>
        </div>
        <div class="mt-6 flex items-center gap-x-3">
            <button type="submit" class="rounded-lg bg-primary-600 px-4 py-2 text-sm font-medium text-white hover:bg-primary-700">Log Email</button>
            <a href="{{ route('emails.index') }}" class="rounded-lg border border-gray-300 px-4 py-2 text-sm font-medium text-gray-700 hover:bg-gray-50">Cancel</a>
        </div>
    </form>
</div>
