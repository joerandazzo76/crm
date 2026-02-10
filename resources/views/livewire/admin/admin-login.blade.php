<form wire:submit="login" class="space-y-5">
    <div>
        <label for="email" class="block text-sm font-medium text-gray-700">Email</label>
        <input wire:model="email" type="email" id="email" class="mt-1 block w-full rounded-lg border-gray-300 shadow-sm focus:border-primary-500 focus:ring-primary-500 sm:text-sm" autofocus>
        @error('email') <p class="mt-1 text-sm text-red-600">{{ $message }}</p> @enderror
    </div>

    <div>
        <label for="password" class="block text-sm font-medium text-gray-700">Password</label>
        <input wire:model="password" type="password" id="password" class="mt-1 block w-full rounded-lg border-gray-300 shadow-sm focus:border-primary-500 focus:ring-primary-500 sm:text-sm">
        @error('password') <p class="mt-1 text-sm text-red-600">{{ $message }}</p> @enderror
    </div>

    <div class="flex items-center">
        <input wire:model="remember" type="checkbox" id="remember" class="h-4 w-4 rounded border-gray-300 text-primary-600 focus:ring-primary-500">
        <label for="remember" class="ml-2 text-sm text-gray-600">Remember me</label>
    </div>

    <button type="submit" class="w-full rounded-lg bg-red-600 px-4 py-2.5 text-sm font-semibold text-white hover:bg-red-700 focus:outline-none focus:ring-2 focus:ring-red-500 focus:ring-offset-2 transition" wire:loading.attr="disabled">
        <span wire:loading.remove>Sign in as Admin</span>
        <span wire:loading>Signing in...</span>
    </button>
</form>
