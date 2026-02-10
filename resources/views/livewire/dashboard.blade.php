<div>
    <h1 class="text-2xl font-bold text-gray-900">Dashboard</h1>
    <p class="mt-1 text-sm text-gray-500">Welcome back, {{ auth()->user()->name }}.</p>

    {{-- Stats --}}
    <div class="mt-6 grid grid-cols-1 gap-4 sm:grid-cols-2 lg:grid-cols-4">
        <div class="rounded-xl bg-white p-6 shadow-sm ring-1 ring-gray-200">
            <div class="flex items-center gap-x-3">
                <div class="rounded-lg bg-blue-50 p-2">
                    <svg class="h-5 w-5 text-blue-600" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M15 19.128a9.38 9.38 0 002.625.372 9.337 9.337 0 004.121-.952 4.125 4.125 0 00-7.533-2.493M15 19.128v-.003c0-1.113-.285-2.16-.786-3.07M15 19.128v.106A12.318 12.318 0 018.624 21c-2.331 0-4.512-.645-6.374-1.766l-.001-.109a6.375 6.375 0 0111.964-3.07M12 6.375a3.375 3.375 0 11-6.75 0 3.375 3.375 0 016.75 0zm8.25 2.25a2.625 2.625 0 11-5.25 0 2.625 2.625 0 015.25 0z" />
                    </svg>
                </div>
                <div>
                    <p class="text-sm text-gray-500">Total Contacts</p>
                    <p class="text-2xl font-bold text-gray-900">{{ number_format($totalContacts) }}</p>
                </div>
            </div>
        </div>

        <div class="rounded-xl bg-white p-6 shadow-sm ring-1 ring-gray-200">
            <div class="flex items-center gap-x-3">
                <div class="rounded-lg bg-purple-50 p-2">
                    <svg class="h-5 w-5 text-purple-600" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M12 6v12m-3-2.818l.879.659c1.171.879 3.07.879 4.242 0 1.172-.879 1.172-2.303 0-3.182C13.536 12.219 12.768 12 12 12c-.725 0-1.45-.22-2.003-.659-1.106-.879-1.106-2.303 0-3.182s2.9-.879 4.006 0l.415.33M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                    </svg>
                </div>
                <div>
                    <p class="text-sm text-gray-500">Open Deals</p>
                    <p class="text-2xl font-bold text-gray-900">{{ number_format($totalDeals) }}</p>
                </div>
            </div>
        </div>

        <div class="rounded-xl bg-white p-6 shadow-sm ring-1 ring-gray-200">
            <div class="flex items-center gap-x-3">
                <div class="rounded-lg bg-green-50 p-2">
                    <svg class="h-5 w-5 text-green-600" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M2.25 18.75a60.07 60.07 0 0115.797 2.101c.727.198 1.453-.342 1.453-1.096V18.75M3.75 4.5v.75A.75.75 0 013 6h-.75m0 0v-.375c0-.621.504-1.125 1.125-1.125H20.25M2.25 6v9m18-10.5v.75c0 .414.336.75.75.75h.75m-1.5-1.5h.375c.621 0 1.125.504 1.125 1.125v9.75c0 .621-.504 1.125-1.125 1.125h-.375m1.5-1.5H21a.75.75 0 00-.75.75v.75m0 0H3.75m0 0h-.375a1.125 1.125 0 01-1.125-1.125V15m1.5 1.5v-.75A.75.75 0 003 15h-.75M15 10.5a3 3 0 11-6 0 3 3 0 016 0zm3 0h.008v.008H18V10.5zm-12 0h.008v.008H6V10.5z" />
                    </svg>
                </div>
                <div>
                    <p class="text-sm text-gray-500">Won Revenue</p>
                    <p class="text-2xl font-bold text-gray-900">${{ number_format($totalRevenue, 0) }}</p>
                </div>
            </div>
        </div>

        <div class="rounded-xl bg-white p-6 shadow-sm ring-1 ring-gray-200">
            <div class="flex items-center gap-x-3">
                <div class="rounded-lg bg-amber-50 p-2">
                    <svg class="h-5 w-5 text-amber-600" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M9 12.75L11.25 15 15 9.75M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                    </svg>
                </div>
                <div>
                    <p class="text-sm text-gray-500">Tasks Due (7d)</p>
                    <p class="text-2xl font-bold text-gray-900">{{ $tasksDue }}</p>
                </div>
            </div>
        </div>
    </div>

    {{-- Content grid --}}
    <div class="mt-8 grid grid-cols-1 gap-6 lg:grid-cols-2">
        {{-- Recent Deals --}}
        <div class="rounded-xl bg-white shadow-sm ring-1 ring-gray-200">
            <div class="flex items-center justify-between border-b border-gray-100 px-6 py-4">
                <h2 class="text-sm font-semibold text-gray-900">Open Deals</h2>
                <a href="{{ route('deals.kanban') }}" class="text-sm text-primary-600 hover:text-primary-500">View all</a>
            </div>
            <div class="divide-y divide-gray-100">
                @forelse($openDeals as $deal)
                    <a href="{{ route('deals.show', $deal) }}" class="flex items-center justify-between px-6 py-3 hover:bg-gray-50">
                        <div>
                            <p class="text-sm font-medium text-gray-900">{{ $deal->title }}</p>
                            <p class="text-xs text-gray-500">{{ $deal->contact?->full_name ?? 'No contact' }} &middot; {{ $deal->stage?->name }}</p>
                        </div>
                        <span class="text-sm font-semibold text-gray-900">${{ number_format($deal->value, 0) }}</span>
                    </a>
                @empty
                    <div class="px-6 py-8 text-center text-sm text-gray-500">
                        No open deals yet. <a href="{{ route('deals.create') }}" class="text-primary-600 hover:text-primary-500">Create one</a>
                    </div>
                @endforelse
            </div>
        </div>

        {{-- Upcoming Tasks --}}
        <div class="rounded-xl bg-white shadow-sm ring-1 ring-gray-200">
            <div class="flex items-center justify-between border-b border-gray-100 px-6 py-4">
                <h2 class="text-sm font-semibold text-gray-900">Upcoming Tasks</h2>
                <a href="{{ route('tasks.index') }}" class="text-sm text-primary-600 hover:text-primary-500">View all</a>
            </div>
            <div class="divide-y divide-gray-100">
                @forelse($upcomingTasks as $task)
                    <div class="flex items-center justify-between px-6 py-3">
                        <div>
                            <p class="text-sm font-medium text-gray-900">{{ $task->title }}</p>
                            <p class="text-xs text-gray-500">
                                {{ $task->due_date?->format('M d') ?? 'No due date' }}
                                @if($task->assignee) &middot; {{ $task->assignee->name }} @endif
                            </p>
                        </div>
                        <span class="inline-flex items-center rounded-full px-2 py-0.5 text-xs font-medium
                            {{ $task->priority === 'urgent' ? 'bg-red-100 text-red-700' : '' }}
                            {{ $task->priority === 'high' ? 'bg-orange-100 text-orange-700' : '' }}
                            {{ $task->priority === 'medium' ? 'bg-yellow-100 text-yellow-700' : '' }}
                            {{ $task->priority === 'low' ? 'bg-gray-100 text-gray-700' : '' }}
                        ">{{ ucfirst($task->priority) }}</span>
                    </div>
                @empty
                    <div class="px-6 py-8 text-center text-sm text-gray-500">
                        No upcoming tasks.
                    </div>
                @endforelse
            </div>
        </div>

        {{-- Recent Activity --}}
        <div class="rounded-xl bg-white shadow-sm ring-1 ring-gray-200 lg:col-span-2">
            <div class="border-b border-gray-100 px-6 py-4">
                <h2 class="text-sm font-semibold text-gray-900">Recent Activity</h2>
            </div>
            <div class="divide-y divide-gray-100">
                @forelse($recentActivities as $activity)
                    <div class="flex items-start gap-x-3 px-6 py-3">
                        <div class="mt-0.5 h-8 w-8 rounded-full bg-gray-100 flex items-center justify-center text-xs font-medium text-gray-600">
                            {{ substr($activity->user?->name ?? '?', 0, 1) }}
                        </div>
                        <div>
                            <p class="text-sm text-gray-900"><span class="font-medium">{{ $activity->user?->name }}</span> {{ $activity->subject }}</p>
                            <p class="text-xs text-gray-500">{{ $activity->created_at->diffForHumans() }}</p>
                        </div>
                    </div>
                @empty
                    <div class="px-6 py-8 text-center text-sm text-gray-500">
                        No activity yet. Start by adding contacts and deals.
                    </div>
                @endforelse
            </div>
        </div>
    </div>
</div>
