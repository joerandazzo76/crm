<div>
    <h1 class="text-2xl font-bold text-gray-900">Settings</h1>

    <x-settings-tabs active="custom-fields" />

    <div class="mt-6">
        {{-- Module selector --}}
        <div class="flex items-center justify-between">
            <div class="flex items-center gap-3">
                <select wire:model.live="module" class="rounded-lg border-gray-300 text-sm focus:border-primary-500 focus:ring-primary-500">
                    <option value="contacts">Contacts</option>
                    <option value="companies">Companies</option>
                    <option value="deals">Deals</option>
                </select>
                <span class="text-sm text-gray-500">{{ $fields->count() }} custom field(s)</span>
            </div>
            <button wire:click="$set('showAddModal', true)" class="rounded-lg bg-primary-600 px-4 py-2 text-sm font-medium text-white hover:bg-primary-700 transition">
                + Add Field
            </button>
        </div>

        {{-- Fields list --}}
        <div class="mt-4 rounded-xl bg-white shadow-sm ring-1 ring-gray-200">
            @forelse($fields as $field)
                <div class="flex items-center justify-between px-6 py-4 {{ !$loop->last ? 'border-b border-gray-100' : '' }}">
                    <div>
                        <p class="text-sm font-medium text-gray-900">{{ $field->label }}</p>
                        <p class="text-xs text-gray-500">
                            Type: {{ ucfirst($field->type) }}
                            @if($field->required) &middot; Required @endif
                            @if($field->options) &middot; Options: {{ implode(', ', $field->options) }} @endif
                        </p>
                    </div>
                    <button wire:click="deleteField({{ $field->id }})" wire:confirm="Delete this custom field?" class="text-sm text-red-600 hover:text-red-800">Delete</button>
                </div>
            @empty
                <div class="px-6 py-8 text-center text-sm text-gray-500">No custom fields for {{ $module }}. Add one to get started.</div>
            @endforelse
        </div>
    </div>

    {{-- Add Field Modal --}}
    @if($showAddModal)
    <div class="fixed inset-0 z-50 overflow-y-auto">
        <div class="flex min-h-full items-center justify-center p-4">
            <div class="fixed inset-0 bg-gray-500/75" wire:click="$set('showAddModal', false)"></div>
            <div class="relative w-full max-w-md rounded-xl bg-white p-6 shadow-xl">
                <h3 class="text-lg font-semibold text-gray-900">Add Custom Field</h3>
                <form wire:submit="addField" class="mt-4 space-y-4">
                    <div>
                        <label class="block text-sm font-medium text-gray-700">Label</label>
                        <input wire:model="fieldLabel" type="text" class="mt-1 block w-full rounded-lg border-gray-300 text-sm focus:border-primary-500 focus:ring-primary-500" placeholder="e.g. LinkedIn URL">
                        @error('fieldLabel') <p class="mt-1 text-sm text-red-600">{{ $message }}</p> @enderror
                    </div>
                    <div>
                        <label class="block text-sm font-medium text-gray-700">Type</label>
                        <select wire:model.live="fieldType" class="mt-1 block w-full rounded-lg border-gray-300 text-sm focus:border-primary-500 focus:ring-primary-500">
                            <option value="text">Text</option>
                            <option value="number">Number</option>
                            <option value="date">Date</option>
                            <option value="select">Dropdown</option>
                            <option value="textarea">Text Area</option>
                            <option value="checkbox">Checkbox</option>
                        </select>
                    </div>
                    @if($fieldType === 'select')
                    <div>
                        <label class="block text-sm font-medium text-gray-700">Options (comma separated)</label>
                        <input wire:model="fieldOptions" type="text" class="mt-1 block w-full rounded-lg border-gray-300 text-sm focus:border-primary-500 focus:ring-primary-500" placeholder="Option A, Option B, Option C">
                    </div>
                    @endif
                    <div class="flex items-center">
                        <input wire:model="fieldRequired" type="checkbox" class="h-4 w-4 rounded border-gray-300 text-primary-600 focus:ring-primary-500">
                        <label class="ml-2 text-sm text-gray-600">Required field</label>
                    </div>
                    <div class="flex justify-end gap-3">
                        <button type="button" wire:click="$set('showAddModal', false)" class="rounded-lg border border-gray-300 px-4 py-2 text-sm font-medium text-gray-700 hover:bg-gray-50">Cancel</button>
                        <button type="submit" class="rounded-lg bg-primary-600 px-4 py-2 text-sm font-medium text-white hover:bg-primary-700">Add Field</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
    @endif
</div>
