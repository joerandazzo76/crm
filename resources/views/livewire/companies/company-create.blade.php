<div>
    <div class="flex items-center gap-x-4">
        <a href="{{ route('companies.index') }}" class="text-gray-400 hover:text-gray-600"><svg class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" d="M10.5 19.5L3 12m0 0l7.5-7.5M3 12h18" /></svg></a>
        <h1 class="text-2xl font-bold text-gray-900">{{ $isEdit ? 'Edit Company' : 'New Company' }}</h1>
    </div>

    <form wire:submit="save" class="mt-6 max-w-2xl">
        <div class="rounded-xl bg-white shadow-sm ring-1 ring-gray-200 p-6 space-y-6">
            <div class="grid grid-cols-1 gap-4 sm:grid-cols-2">
                <div><label class="block text-sm font-medium text-gray-700">Company Name *</label><input wire:model="name" type="text" class="mt-1 block w-full rounded-lg border-gray-300 text-sm focus:border-primary-500 focus:ring-primary-500">@error('name')<p class="mt-1 text-sm text-red-600">{{ $message }}</p>@enderror</div>
                <div><label class="block text-sm font-medium text-gray-700">Industry</label><input wire:model="industry" type="text" class="mt-1 block w-full rounded-lg border-gray-300 text-sm focus:border-primary-500 focus:ring-primary-500"></div>
            </div>
            <div class="grid grid-cols-1 gap-4 sm:grid-cols-2">
                <div><label class="block text-sm font-medium text-gray-700">Email</label><input wire:model="email" type="email" class="mt-1 block w-full rounded-lg border-gray-300 text-sm focus:border-primary-500 focus:ring-primary-500"></div>
                <div><label class="block text-sm font-medium text-gray-700">Phone</label><input wire:model="phone" type="text" class="mt-1 block w-full rounded-lg border-gray-300 text-sm focus:border-primary-500 focus:ring-primary-500"></div>
            </div>
            <div class="grid grid-cols-1 gap-4 sm:grid-cols-2">
                <div><label class="block text-sm font-medium text-gray-700">Website</label><input wire:model="website" type="text" class="mt-1 block w-full rounded-lg border-gray-300 text-sm focus:border-primary-500 focus:ring-primary-500"></div>
                <div><label class="block text-sm font-medium text-gray-700">Domain</label><input wire:model="domain" type="text" class="mt-1 block w-full rounded-lg border-gray-300 text-sm focus:border-primary-500 focus:ring-primary-500"></div>
            </div>
            <div><label class="block text-sm font-medium text-gray-700">Address</label><input wire:model="address" type="text" class="mt-1 block w-full rounded-lg border-gray-300 text-sm focus:border-primary-500 focus:ring-primary-500"></div>
            <div class="grid grid-cols-2 gap-4 sm:grid-cols-4">
                <div><label class="block text-sm font-medium text-gray-700">City</label><input wire:model="city" type="text" class="mt-1 block w-full rounded-lg border-gray-300 text-sm focus:border-primary-500 focus:ring-primary-500"></div>
                <div><label class="block text-sm font-medium text-gray-700">State</label><input wire:model="state" type="text" class="mt-1 block w-full rounded-lg border-gray-300 text-sm focus:border-primary-500 focus:ring-primary-500"></div>
                <div><label class="block text-sm font-medium text-gray-700">Country</label><input wire:model="country" type="text" class="mt-1 block w-full rounded-lg border-gray-300 text-sm focus:border-primary-500 focus:ring-primary-500"></div>
                <div><label class="block text-sm font-medium text-gray-700">ZIP</label><input wire:model="zip" type="text" class="mt-1 block w-full rounded-lg border-gray-300 text-sm focus:border-primary-500 focus:ring-primary-500"></div>
            </div>
        </div>
        <div class="mt-6 flex items-center gap-x-3">
            <button type="submit" class="rounded-lg bg-primary-600 px-4 py-2 text-sm font-medium text-white hover:bg-primary-700">{{ $isEdit ? 'Update' : 'Create' }} Company</button>
            <a href="{{ route('companies.index') }}" class="rounded-lg border border-gray-300 px-4 py-2 text-sm font-medium text-gray-700 hover:bg-gray-50">Cancel</a>
        </div>
    </form>
</div>
