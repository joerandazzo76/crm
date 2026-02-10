<form wire:submit="register" class="space-y-5">
    <div>
        <label for="company_name" class="block text-sm font-medium text-gray-700">Company Name</label>
        <input wire:model.live.debounce.300ms="company_name" type="text" id="company_name" class="mt-1 block w-full rounded-lg border-gray-300 shadow-sm focus:border-primary-500 focus:ring-primary-500 sm:text-sm" placeholder="Acme Inc">
        @error('company_name') <p class="mt-1 text-sm text-red-600">{{ $message }}</p> @enderror
    </div>

    <div>
        <label for="subdomain" class="block text-sm font-medium text-gray-700">Subdomain</label>
        <div class="mt-1 flex rounded-lg shadow-sm">
            <input wire:model="subdomain" type="text" id="subdomain" class="block w-full rounded-l-lg border-gray-300 focus:border-primary-500 focus:ring-primary-500 sm:text-sm" placeholder="acme">
            <span class="inline-flex items-center rounded-r-lg border border-l-0 border-gray-300 bg-gray-50 px-3 text-sm text-gray-500">.{{ config('app.domain', 'crm.localhost') }}</span>
        </div>
        @error('subdomain') <p class="mt-1 text-sm text-red-600">{{ $message }}</p> @enderror
    </div>

    <div>
        <label for="name" class="block text-sm font-medium text-gray-700">Your Name</label>
        <input wire:model="name" type="text" id="name" class="mt-1 block w-full rounded-lg border-gray-300 shadow-sm focus:border-primary-500 focus:ring-primary-500 sm:text-sm">
        @error('name') <p class="mt-1 text-sm text-red-600">{{ $message }}</p> @enderror
    </div>

    <div>
        <label for="email" class="block text-sm font-medium text-gray-700">Email</label>
        <input wire:model="email" type="email" id="email" class="mt-1 block w-full rounded-lg border-gray-300 shadow-sm focus:border-primary-500 focus:ring-primary-500 sm:text-sm">
        @error('email') <p class="mt-1 text-sm text-red-600">{{ $message }}</p> @enderror
    </div>

    <div>
        <label for="password" class="block text-sm font-medium text-gray-700">Password</label>
        <input wire:model="password" type="password" id="password" class="mt-1 block w-full rounded-lg border-gray-300 shadow-sm focus:border-primary-500 focus:ring-primary-500 sm:text-sm">
        @error('password') <p class="mt-1 text-sm text-red-600">{{ $message }}</p> @enderror
    </div>

    <div>
        <label for="password_confirmation" class="block text-sm font-medium text-gray-700">Confirm Password</label>
        <input wire:model="password_confirmation" type="password" id="password_confirmation" class="mt-1 block w-full rounded-lg border-gray-300 shadow-sm focus:border-primary-500 focus:ring-primary-500 sm:text-sm">
    </div>

    <input type="hidden" wire:model="plan" value="{{ request('plan', 'free') }}">

    <button type="submit" class="w-full rounded-lg bg-primary-600 px-4 py-2.5 text-sm font-semibold text-white hover:bg-primary-700 focus:outline-none focus:ring-2 focus:ring-primary-500 focus:ring-offset-2 transition" wire:loading.attr="disabled">
        <span wire:loading.remove>Create Account</span>
        <span wire:loading>Creating...</span>
    </button>
</form>
