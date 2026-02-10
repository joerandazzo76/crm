@props(['active' => 'general'])

<div class="mt-4 border-b border-gray-200">
    <nav class="-mb-px flex gap-x-6">
        @if(in_array(auth()->user()->role, ['admin', 'manager']))
            <a href="{{ route('settings.general') }}" class="border-b-2 {{ $active === 'general' ? 'border-primary-500 text-primary-600' : 'border-transparent text-gray-500 hover:border-gray-300 hover:text-gray-700' }} px-1 pb-3 text-sm font-medium">General</a>
            <a href="{{ route('settings.pipeline') }}" class="border-b-2 {{ $active === 'pipeline' ? 'border-primary-500 text-primary-600' : 'border-transparent text-gray-500 hover:border-gray-300 hover:text-gray-700' }} px-1 pb-3 text-sm font-medium">Pipelines</a>
            <a href="{{ route('settings.custom-fields') }}" class="border-b-2 {{ $active === 'custom-fields' ? 'border-primary-500 text-primary-600' : 'border-transparent text-gray-500 hover:border-gray-300 hover:text-gray-700' }} px-1 pb-3 text-sm font-medium">Custom Fields</a>
            <a href="{{ route('settings.team') }}" class="border-b-2 {{ $active === 'team' ? 'border-primary-500 text-primary-600' : 'border-transparent text-gray-500 hover:border-gray-300 hover:text-gray-700' }} px-1 pb-3 text-sm font-medium">Team</a>
        @endif
        <a href="{{ route('settings.profile') }}" class="border-b-2 {{ $active === 'profile' ? 'border-primary-500 text-primary-600' : 'border-transparent text-gray-500 hover:border-gray-300 hover:text-gray-700' }} px-1 pb-3 text-sm font-medium">Profile</a>
    </nav>
</div>
