<div>
    <div class="flex items-center gap-x-4">
        <a href="{{ route('deals.kanban') }}" class="text-gray-400 hover:text-gray-600"><svg class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" d="M10.5 19.5L3 12m0 0l7.5-7.5M3 12h18" /></svg></a>
        <h1 class="text-2xl font-bold text-gray-900">{{ $isEdit ? 'Edit Deal' : 'New Deal' }}</h1>
    </div>

    <form wire:submit="save" class="mt-6 max-w-2xl">
        <div class="rounded-xl bg-white shadow-sm ring-1 ring-gray-200 p-6 space-y-6">
            <div>
                <label class="block text-sm font-medium text-gray-700">Deal Title *</label>
                <input wire:model="title" type="text" class="mt-1 block w-full rounded-lg border-gray-300 text-sm focus:border-primary-500 focus:ring-primary-500" placeholder="e.g. Enterprise License for Acme">
                @error('title')<p class="mt-1 text-sm text-red-600">{{ $message }}</p>@enderror
            </div>

            <div class="grid grid-cols-1 gap-4 sm:grid-cols-2">
                <div>
                    <label class="block text-sm font-medium text-gray-700">Value ($)</label>
                    <input wire:model="value" type="number" step="0.01" class="mt-1 block w-full rounded-lg border-gray-300 text-sm focus:border-primary-500 focus:ring-primary-500">
                </div>
                <div>
                    <label class="block text-sm font-medium text-gray-700">Expected Close Date</label>
                    <input wire:model="expected_close_date" type="date" class="mt-1 block w-full rounded-lg border-gray-300 text-sm focus:border-primary-500 focus:ring-primary-500">
                </div>
            </div>

            <div class="grid grid-cols-1 gap-4 sm:grid-cols-2">
                <div>
                    <label class="block text-sm font-medium text-gray-700">Pipeline</label>
                    <select wire:model.live="pipeline_id" class="mt-1 block w-full rounded-lg border-gray-300 text-sm focus:border-primary-500 focus:ring-primary-500">
                        @foreach($pipelines as $pipeline)
                            <option value="{{ $pipeline->id }}">{{ $pipeline->name }}</option>
                        @endforeach
                    </select>
                </div>
                <div>
                    <label class="block text-sm font-medium text-gray-700">Stage</label>
                    <select wire:model="stage_id" class="mt-1 block w-full rounded-lg border-gray-300 text-sm focus:border-primary-500 focus:ring-primary-500">
                        @foreach($stages as $stage)
                            <option value="{{ $stage->id }}">{{ $stage->name }}</option>
                        @endforeach
                    </select>
                </div>
            </div>

            <div class="grid grid-cols-1 gap-4 sm:grid-cols-2">
                <div>
                    <label class="block text-sm font-medium text-gray-700">Contact</label>
                    <select wire:model="contact_id" class="mt-1 block w-full rounded-lg border-gray-300 text-sm focus:border-primary-500 focus:ring-primary-500">
                        <option value="">None</option>
                        @foreach($contacts as $contact)
                            <option value="{{ $contact->id }}">{{ $contact->full_name }}</option>
                        @endforeach
                    </select>
                </div>
                <div>
                    <label class="block text-sm font-medium text-gray-700">Company</label>
                    <select wire:model="company_id" class="mt-1 block w-full rounded-lg border-gray-300 text-sm focus:border-primary-500 focus:ring-primary-500">
                        <option value="">None</option>
                        @foreach($companies as $company)
                            <option value="{{ $company->id }}">{{ $company->name }}</option>
                        @endforeach
                    </select>
                </div>
            </div>

            <div>
                <label class="block text-sm font-medium text-gray-700">Win Probability (%)</label>
                <input wire:model="probability" type="number" min="0" max="100" class="mt-1 block w-32 rounded-lg border-gray-300 text-sm focus:border-primary-500 focus:ring-primary-500">
            </div>
        </div>

        <div class="mt-6 flex items-center gap-x-3">
            <button type="submit" class="rounded-lg bg-primary-600 px-4 py-2 text-sm font-medium text-white hover:bg-primary-700">{{ $isEdit ? 'Update' : 'Create' }} Deal</button>
            <a href="{{ route('deals.kanban') }}" class="rounded-lg border border-gray-300 px-4 py-2 text-sm font-medium text-gray-700 hover:bg-gray-50">Cancel</a>
        </div>
    </form>
</div>
