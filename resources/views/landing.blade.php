<!DOCTYPE html>
<html lang="en" class="h-full">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>{{ config('app.name') }} - Modern CRM for Growing Teams</title>
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=inter:400,500,600,700,800" rel="stylesheet" />
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="bg-white">
    {{-- Navbar --}}
    <nav class="border-b border-gray-100">
        <div class="mx-auto max-w-7xl px-4 sm:px-6 lg:px-8">
            <div class="flex h-16 items-center justify-between">
                <div class="flex items-center gap-x-3">
                    <div class="h-8 w-8 rounded-lg bg-primary-600 flex items-center justify-center">
                        <svg class="h-5 w-5 text-white" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M3.75 3v11.25A2.25 2.25 0 006 16.5h2.25M3.75 3h-1.5m1.5 0h16.5m0 0h1.5m-1.5 0v11.25A2.25 2.25 0 0118 16.5h-2.25m-7.5 0h7.5m-7.5 0l-1 3m8.5-3l1 3m0 0l.5 1.5m-.5-1.5h-9.5m0 0l-.5 1.5" />
                        </svg>
                    </div>
                    <span class="text-xl font-bold text-gray-900">CRM SaaS</span>
                </div>
                <div class="flex items-center gap-x-4">
                    <a href="{{ route('pricing') }}" class="text-sm font-medium text-gray-600 hover:text-gray-900">Pricing</a>
                    <a href="{{ route('central.login') }}" class="text-sm font-medium text-gray-600 hover:text-gray-900">Login</a>
                    <a href="{{ route('register') }}" class="rounded-lg bg-primary-600 px-4 py-2 text-sm font-medium text-white hover:bg-primary-700 transition">Get Started Free</a>
                </div>
            </div>
        </div>
    </nav>

    {{-- Hero --}}
    <div class="mx-auto max-w-7xl px-4 sm:px-6 lg:px-8 pt-20 pb-16 text-center">
        <h1 class="text-5xl font-extrabold tracking-tight text-gray-900 sm:text-6xl">
            The CRM your team<br>
            <span class="text-primary-600">actually wants to use</span>
        </h1>
        <p class="mx-auto mt-6 max-w-2xl text-lg text-gray-600">
            Manage contacts, track deals, and grow revenue with a modern CRM built for speed.
            Get your team up and running in minutes, not months.
        </p>
        <div class="mt-10 flex items-center justify-center gap-x-4">
            <a href="{{ route('register') }}" class="rounded-lg bg-primary-600 px-6 py-3 text-sm font-semibold text-white shadow-sm hover:bg-primary-700 transition">
                Start 14-day free trial
            </a>
            <a href="{{ route('pricing') }}" class="text-sm font-semibold text-gray-900">
                View pricing <span aria-hidden="true">&rarr;</span>
            </a>
        </div>
    </div>

    {{-- Features --}}
    <div class="mx-auto max-w-7xl px-4 sm:px-6 lg:px-8 py-24">
        <div class="text-center">
            <h2 class="text-3xl font-bold text-gray-900">Everything you need to close more deals</h2>
            <p class="mt-4 text-lg text-gray-600">Powerful features, simple interface.</p>
        </div>

        <div class="mt-16 grid grid-cols-1 gap-8 sm:grid-cols-2 lg:grid-cols-3">
            @php
            $features = [
                ['title' => 'Contact Management', 'desc' => 'Organize all your contacts and companies with custom fields, tags, and activity tracking.', 'icon' => 'M15 19.128a9.38 9.38 0 002.625.372 9.337 9.337 0 004.121-.952 4.125 4.125 0 00-7.533-2.493M15 19.128v-.003c0-1.113-.285-2.16-.786-3.07M15 19.128v.106A12.318 12.318 0 018.624 21c-2.331 0-4.512-.645-6.374-1.766l-.001-.109a6.375 6.375 0 0111.964-3.07M12 6.375a3.375 3.375 0 11-6.75 0 3.375 3.375 0 016.75 0zm8.25 2.25a2.625 2.625 0 11-5.25 0 2.625 2.625 0 015.25 0z'],
                ['title' => 'Visual Pipeline', 'desc' => 'Drag-and-drop Kanban board to manage your deals through every stage of the sales process.', 'icon' => 'M3.75 6A2.25 2.25 0 016 3.75h2.25A2.25 2.25 0 0110.5 6v2.25a2.25 2.25 0 01-2.25 2.25H6a2.25 2.25 0 01-2.25-2.25V6zM3.75 15.75A2.25 2.25 0 016 13.5h2.25a2.25 2.25 0 012.25 2.25V18a2.25 2.25 0 01-2.25 2.25H6A2.25 2.25 0 013.75 18v-2.25zM13.5 6a2.25 2.25 0 012.25-2.25H18A2.25 2.25 0 0120.25 6v2.25A2.25 2.25 0 0118 10.5h-2.25a2.25 2.25 0 01-2.25-2.25V6zM13.5 15.75a2.25 2.25 0 012.25-2.25H18a2.25 2.25 0 012.25 2.25V18A2.25 2.25 0 0118 20.25h-2.25A2.25 2.25 0 0113.5 18v-2.25z'],
                ['title' => 'Task Management', 'desc' => 'Never miss a follow-up. Create tasks linked to contacts, deals, and companies with due dates and priorities.', 'icon' => 'M9 12.75L11.25 15 15 9.75M21 12a9 9 0 11-18 0 9 9 0 0118 0z'],
                ['title' => 'Email Integration', 'desc' => 'Log emails, use templates, and track communication history alongside every deal and contact.', 'icon' => 'M21.75 6.75v10.5a2.25 2.25 0 01-2.25 2.25h-15a2.25 2.25 0 01-2.25-2.25V6.75m19.5 0A2.25 2.25 0 0019.5 4.5h-15a2.25 2.25 0 00-2.25 2.25m19.5 0v.243a2.25 2.25 0 01-1.07 1.916l-7.5 4.615a2.25 2.25 0 01-2.36 0L3.32 8.91a2.25 2.25 0 01-1.07-1.916V6.75'],
                ['title' => 'Reports & Analytics', 'desc' => 'Revenue forecasts, pipeline reports, and activity tracking to make data-driven decisions.', 'icon' => 'M3 13.125C3 12.504 3.504 12 4.125 12h2.25c.621 0 1.125.504 1.125 1.125v6.75C7.5 20.496 6.996 21 6.375 21h-2.25A1.125 1.125 0 013 19.875v-6.75zM9.75 8.625c0-.621.504-1.125 1.125-1.125h2.25c.621 0 1.125.504 1.125 1.125v11.25c0 .621-.504 1.125-1.125 1.125h-2.25a1.125 1.125 0 01-1.125-1.125V8.625zM16.5 4.125c0-.621.504-1.125 1.125-1.125h2.25C20.496 3 21 3.504 21 4.125v15.75c0 .621-.504 1.125-1.125 1.125h-2.25a1.125 1.125 0 01-1.125-1.125V4.125z'],
                ['title' => 'Team Collaboration', 'desc' => 'Invite your team, assign owners, and collaborate on deals with notes and activity feeds.', 'icon' => 'M18 18.72a9.094 9.094 0 003.741-.479 3 3 0 00-4.682-2.72m.94 3.198l.001.031c0 .225-.012.447-.037.666A11.944 11.944 0 0112 21c-2.17 0-4.207-.576-5.963-1.584A6.062 6.062 0 016 18.719m12 0a5.971 5.971 0 00-.941-3.197m0 0A5.995 5.995 0 0012 12.75a5.995 5.995 0 00-5.058 2.772m0 0a3 3 0 00-4.681 2.72 8.986 8.986 0 003.74.477m.94-3.197a5.971 5.971 0 00-.94 3.197M15 6.75a3 3 0 11-6 0 3 3 0 016 0zm6 3a2.25 2.25 0 11-4.5 0 2.25 2.25 0 014.5 0zm-13.5 0a2.25 2.25 0 11-4.5 0 2.25 2.25 0 014.5 0z'],
            ];
            @endphp

            @foreach($features as $feature)
                <div class="rounded-xl border border-gray-200 p-6 hover:border-primary-200 hover:shadow-sm transition">
                    <div class="h-10 w-10 rounded-lg bg-primary-50 flex items-center justify-center">
                        <svg class="h-5 w-5 text-primary-600" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" d="{{ $feature['icon'] }}" />
                        </svg>
                    </div>
                    <h3 class="mt-4 text-lg font-semibold text-gray-900">{{ $feature['title'] }}</h3>
                    <p class="mt-2 text-sm text-gray-600">{{ $feature['desc'] }}</p>
                </div>
            @endforeach
        </div>
    </div>

    {{-- CTA --}}
    <div class="bg-primary-600">
        <div class="mx-auto max-w-7xl px-4 sm:px-6 lg:px-8 py-16 text-center">
            <h2 class="text-3xl font-bold text-white">Ready to grow your business?</h2>
            <p class="mt-4 text-lg text-primary-100">Start your free 14-day trial. No credit card required.</p>
            <a href="{{ route('register') }}" class="mt-8 inline-block rounded-lg bg-white px-6 py-3 text-sm font-semibold text-primary-600 hover:bg-primary-50 transition">
                Get Started Free
            </a>
        </div>
    </div>

    {{-- Footer --}}
    <footer class="border-t border-gray-100 py-8">
        <div class="mx-auto max-w-7xl px-4 sm:px-6 lg:px-8">
            <p class="text-center text-sm text-gray-500">&copy; {{ date('Y') }} {{ config('app.name') }}. All rights reserved.</p>
        </div>
    </footer>
</body>
</html>
