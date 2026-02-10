<form wire:submit="login" class="space-y-5">
    @if (session('success'))
        <div class="rounded-lg bg-green-50 p-3 text-sm text-green-700">{{ session('success') }}</div>
    @endif

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

    <div class="flex items-center justify-between">
        <label class="flex items-center gap-x-2">
            <input wire:model="remember" type="checkbox" class="rounded border-gray-300 text-primary-600 focus:ring-primary-500">
            <span class="text-sm text-gray-600">Remember me</span>
        </label>
        <a href="{{ route('password.request') }}" class="text-sm text-primary-600 hover:text-primary-500">Forgot password?</a>
    </div>

    <button type="submit" class="w-full rounded-lg bg-primary-600 px-4 py-2.5 text-sm font-semibold text-white hover:bg-primary-700 focus:outline-none focus:ring-2 focus:ring-primary-500 focus:ring-offset-2 transition" wire:loading.attr="disabled">
        <span wire:loading.remove>Sign in</span>
        <span wire:loading>Signing in...</span>
    </button>
</form>
