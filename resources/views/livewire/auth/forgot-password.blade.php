<form wire:submit="sendResetLink" class="space-y-5">
    @if ($sent)
        <div class="rounded-lg bg-green-50 p-3 text-sm text-green-700">
            If an account exists with that email, we've sent a password reset link.
        </div>
    @endif

    <div>
        <label for="email" class="block text-sm font-medium text-gray-700">Email</label>
        <input wire:model="email" type="email" id="email" class="mt-1 block w-full rounded-lg border-gray-300 shadow-sm focus:border-primary-500 focus:ring-primary-500 sm:text-sm">
        @error('email') <p class="mt-1 text-sm text-red-600">{{ $message }}</p> @enderror
    </div>

    <button type="submit" class="w-full rounded-lg bg-primary-600 px-4 py-2.5 text-sm font-semibold text-white hover:bg-primary-700 transition">
        Send Reset Link
    </button>

    <p class="text-center text-sm text-gray-600">
        <a href="{{ route('login') }}" class="text-primary-600 hover:text-primary-500">Back to login</a>
    </p>
</form>
