<!DOCTYPE html>
<html lang="en" class="h-full bg-gray-50">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>Admin - {{ config('app.name') }}</title>
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=inter:400,500,600,700" rel="stylesheet" />
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="h-full" x-data="{ sidebarOpen: false }">
    <div class="min-h-full">
        {{-- Mobile sidebar backdrop --}}
        <div x-show="sidebarOpen" x-transition:enter="transition-opacity ease-linear duration-300"
             x-transition:enter-start="opacity-0" x-transition:enter-end="opacity-100"
             x-transition:leave="transition-opacity ease-linear duration-300"
             x-transition:leave-start="opacity-100" x-transition:leave-end="opacity-0"
             class="fixed inset-0 z-40 bg-gray-600/75 lg:hidden" @click="sidebarOpen = false"></div>

        {{-- Sidebar --}}
        <div class="fixed inset-y-0 left-0 z-50 w-64 bg-gray-900 transform transition-transform duration-300 lg:translate-x-0"
             :class="sidebarOpen ? 'translate-x-0' : '-translate-x-full lg:translate-x-0'">
            <div class="flex h-16 items-center gap-x-3 border-b border-gray-700 px-6">
                <div class="h-8 w-8 rounded-lg bg-red-600 flex items-center justify-center">
                    <svg class="h-5 w-5 text-white" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M9 12.75L11.25 15 15 9.75m-3-7.036A11.959 11.959 0 013.598 6 11.99 11.99 0 003 9.749c0 5.592 3.824 10.29 9 11.623 5.176-1.332 9-6.03 9-11.622 0-1.31-.21-2.571-.598-3.751h-.152c-3.196 0-6.1-1.248-8.25-3.285z" />
                    </svg>
                </div>
                <span class="text-lg font-bold text-white">Admin Panel</span>
            </div>

            <nav class="flex-1 space-y-1 px-3 py-4">
                <a href="{{ route('admin.dashboard') }}" class="flex items-center gap-x-3 rounded-lg px-3 py-2 text-sm font-medium {{ request()->routeIs('admin.dashboard') ? 'bg-gray-800 text-white' : 'text-gray-300 hover:bg-gray-800 hover:text-white' }}">
                    <svg class="h-5 w-5 shrink-0" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M2.25 12l8.954-8.955c.44-.439 1.152-.439 1.591 0L21.75 12M4.5 9.75v10.125c0 .621.504 1.125 1.125 1.125H9.75v-4.875c0-.621.504-1.125 1.125-1.125h2.25c.621 0 1.125.504 1.125 1.125V21h4.125c.621 0 1.125-.504 1.125-1.125V9.75M8.25 21h8.25" />
                    </svg>
                    Dashboard
                </a>

                <a href="{{ route('admin.dashboard') }}" class="flex items-center gap-x-3 rounded-lg px-3 py-2 text-sm font-medium {{ request()->routeIs('admin.tenants.*') ? 'bg-gray-800 text-white' : 'text-gray-300 hover:bg-gray-800 hover:text-white' }}">
                    <svg class="h-5 w-5 shrink-0" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M3.75 21h16.5M4.5 3h15M5.25 3v18m13.5-18v18M9 6.75h1.5m-1.5 3h1.5m-1.5 3h1.5m3-6H15m-1.5 3H15m-1.5 3H15M9 21v-3.375c0-.621.504-1.125 1.125-1.125h3.75c.621 0 1.125.504 1.125 1.125V21" />
                    </svg>
                    Tenants
                </a>

                <div class="pt-4 mt-4 border-t border-gray-700">
                    <p class="px-3 text-xs font-semibold text-gray-500 uppercase tracking-wider">Quick Links</p>
                </div>

                <a href="{{ route('home') }}" class="flex items-center gap-x-3 rounded-lg px-3 py-2 text-sm font-medium text-gray-300 hover:bg-gray-800 hover:text-white">
                    <svg class="h-5 w-5 shrink-0" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M12 21a9.004 9.004 0 008.716-6.747M12 21a9.004 9.004 0 01-8.716-6.747M12 21c2.485 0 4.5-4.03 4.5-9S14.485 3 12 3m0 18c-2.485 0-4.5-4.03-4.5-9S9.515 3 12 3m0 0a8.997 8.997 0 017.843 4.582M12 3a8.997 8.997 0 00-7.843 4.582m15.686 0A11.953 11.953 0 0112 10.5c-2.998 0-5.74-1.1-7.843-2.918m15.686 0A8.959 8.959 0 0121 12c0 .778-.099 1.533-.284 2.253m0 0A17.919 17.919 0 0112 16.5c-3.162 0-6.133-.815-8.716-2.247m0 0A9.015 9.015 0 013 12c0-1.605.42-3.113 1.157-4.418" />
                    </svg>
                    Landing Page
                </a>
            </nav>
        </div>

        {{-- Main content --}}
        <div class="lg:pl-64">
            {{-- Top bar --}}
            <div class="sticky top-0 z-30 flex h-16 items-center gap-x-4 border-b border-gray-200 bg-white px-4 sm:px-6">
                <button @click="sidebarOpen = !sidebarOpen" class="text-gray-700 lg:hidden">
                    <svg class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M3.75 6.75h16.5M3.75 12h16.5m-16.5 5.25h16.5" />
                    </svg>
                </button>

                <div class="flex flex-1 items-center justify-between">
                    <span class="inline-flex items-center rounded-full bg-red-100 px-3 py-0.5 text-xs font-medium text-red-700">GOD MODE</span>

                    {{-- User menu --}}
                    <div class="flex items-center gap-x-4" x-data="{ open: false }">
                        <button @click="open = !open" class="flex items-center gap-x-2 rounded-lg p-1.5 hover:bg-gray-50">
                            <div class="h-8 w-8 rounded-full bg-red-100 flex items-center justify-center">
                                <span class="text-sm font-medium text-red-700">{{ substr(auth()->guard('admin')->user()->name ?? 'A', 0, 1) }}</span>
                            </div>
                            <span class="hidden sm:block text-sm font-medium text-gray-700">{{ auth()->guard('admin')->user()->name ?? 'Admin' }}</span>
                        </button>

                        <div x-show="open" @click.away="open = false" x-transition
                             class="absolute right-4 top-14 w-48 rounded-lg bg-white py-1 shadow-lg ring-1 ring-gray-200">
                            <form method="POST" action="{{ route('admin.logout') }}">
                                @csrf
                                <button type="submit" class="block w-full text-left px-4 py-2 text-sm text-gray-700 hover:bg-gray-50">Sign out</button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>

            {{-- Page content --}}
            <main class="p-4 sm:p-6">
                @if (session('success'))
                    <div class="mb-4 rounded-lg bg-green-50 p-4 text-sm text-green-700" x-data="{ show: true }" x-show="show" x-init="setTimeout(() => show = false, 4000)">
                        {{ session('success') }}
                    </div>
                @endif

                {{ $slot }}
            </main>
        </div>
    </div>
</body>
</html>
