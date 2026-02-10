<div>
    <div class="flex items-center justify-between">
        <div>
            <h1 class="text-2xl font-bold text-gray-900">Tasks</h1>
            <p class="mt-1 text-sm text-gray-500">Manage your tasks and follow-ups.</p>
        </div>
        <button wire:click="$set('showCreateModal', true)" class="rounded-lg bg-primary-600 px-4 py-2 text-sm font-medium text-white hover:bg-primary-700">+ Add Task</button>
    </div>

    <div class="mt-6 flex flex-col sm:flex-row gap-4">
        <input wire:model.live.debounce.300ms="search" type="search" placeholder="Search tasks..." class="flex-1 max-w-md rounded-lg border-gray-300 text-sm focus:border-primary-500 focus:ring-primary-500">
        <select wire:model.live="statusFilter" class="rounded-lg border-gray-300 text-sm">
            <option value="">All Status</option>
            <option value="pending">Pending</option>
            <option value="in_progress">In Progress</option>
            <option value="completed">Completed</option>
        </select>
        <select wire:model.live="priorityFilter" class="rounded-lg border-gray-300 text-sm">
            <option value="">All Priority</option>
            <option value="urgent">Urgent</option>
            <option value="high">High</option>
            <option value="medium">Medium</option>
            <option value="low">Low</option>
        </select>
    </div>

    <div class="mt-4 space-y-2">
        @forelse($tasks as $task)
            <div class="flex items-center gap-x-4 rounded-xl bg-white px-4 py-3 shadow-sm ring-1 ring-gray-200">
                <button wire:click="toggleComplete({{ $task->id }})" class="shrink-0">
                    @if($task->status === 'completed')
                        <svg class="h-5 w-5 text-green-500" fill="currentColor" viewBox="0 0 20 20"><path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.857-9.809a.75.75 0 00-1.214-.882l-3.483 4.79-1.88-1.88a.75.75 0 10-1.06 1.061l2.5 2.5a.75.75 0 001.137-.089l4-5.5z" clip-rule="evenodd"/></svg>
                    @else
                        <div class="h-5 w-5 rounded-full border-2 border-gray-300 hover:border-primary-500"></div>
                    @endif
                </button>

                <div class="flex-1 min-w-0">
                    <p class="text-sm font-medium {{ $task->status === 'completed' ? 'text-gray-400 line-through' : 'text-gray-900' }}">{{ $task->title }}</p>
                    <div class="flex items-center gap-x-2 mt-0.5">
                        @if($task->due_date)
                            <span class="text-xs {{ $task->due_date->isPast() && $task->status !== 'completed' ? 'text-red-500' : 'text-gray-500' }}">{{ $task->due_date->format('M d') }}</span>
                        @endif
                        @if($task->assignee)
                            <span class="text-xs text-gray-400">{{ $task->assignee->name }}</span>
                        @endif
                    </div>
                </div>

                <span class="inline-flex items-center rounded-full px-2 py-0.5 text-xs font-medium
                    {{ $task->priority === 'urgent' ? 'bg-red-100 text-red-700' : '' }}
                    {{ $task->priority === 'high' ? 'bg-orange-100 text-orange-700' : '' }}
                    {{ $task->priority === 'medium' ? 'bg-yellow-100 text-yellow-700' : '' }}
                    {{ $task->priority === 'low' ? 'bg-gray-100 text-gray-700' : '' }}
                ">{{ ucfirst($task->priority) }}</span>

                <button wire:click="deleteTask({{ $task->id }})" wire:confirm="Delete this task?" class="text-gray-400 hover:text-red-500">
                    <svg class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" d="M6 18L18 6M6 6l12 12" /></svg>
                </button>
            </div>
        @empty
            <div class="rounded-xl bg-white px-6 py-12 text-center shadow-sm ring-1 ring-gray-200">
                <p class="text-sm text-gray-500">No tasks found.</p>
            </div>
        @endforelse
    </div>

    <div class="mt-4">{{ $tasks->links() }}</div>

    {{-- Create Modal --}}
    @if($showCreateModal)
        <div class="fixed inset-0 z-50 overflow-y-auto" x-data x-init="$el.querySelector('input[type=text]')?.focus()">
            <div class="fixed inset-0 bg-gray-500/75" wire:click="$set('showCreateModal', false)"></div>
            <div class="relative mx-auto mt-20 max-w-lg rounded-xl bg-white p-6 shadow-xl">
                <h2 class="text-lg font-semibold text-gray-900">New Task</h2>
                <form wire:submit="createTask" class="mt-4 space-y-4">
                    <div>
                        <label class="block text-sm font-medium text-gray-700">Title *</label>
                        <input wire:model="title" type="text" class="mt-1 block w-full rounded-lg border-gray-300 text-sm focus:border-primary-500 focus:ring-primary-500">
                        @error('title')<p class="mt-1 text-sm text-red-600">{{ $message }}</p>@enderror
                    </div>
                    <div>
                        <label class="block text-sm font-medium text-gray-700">Description</label>
                        <textarea wire:model="description" rows="2" class="mt-1 block w-full rounded-lg border-gray-300 text-sm focus:border-primary-500 focus:ring-primary-500"></textarea>
                    </div>
                    <div class="grid grid-cols-2 gap-4">
                        <div>
                            <label class="block text-sm font-medium text-gray-700">Due Date</label>
                            <input wire:model="due_date" type="date" class="mt-1 block w-full rounded-lg border-gray-300 text-sm focus:border-primary-500 focus:ring-primary-500">
                        </div>
                        <div>
                            <label class="block text-sm font-medium text-gray-700">Priority</label>
                            <select wire:model="priority" class="mt-1 block w-full rounded-lg border-gray-300 text-sm focus:border-primary-500 focus:ring-primary-500">
                                <option value="low">Low</option>
                                <option value="medium">Medium</option>
                                <option value="high">High</option>
                                <option value="urgent">Urgent</option>
                            </select>
                        </div>
                    </div>
                    <div>
                        <label class="block text-sm font-medium text-gray-700">Assign to</label>
                        <select wire:model="assigned_to" class="mt-1 block w-full rounded-lg border-gray-300 text-sm focus:border-primary-500 focus:ring-primary-500">
                            <option value="">Unassigned</option>
                            @foreach($users as $user)
                                <option value="{{ $user->id }}">{{ $user->name }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="flex justify-end gap-x-3">
                        <button type="button" wire:click="$set('showCreateModal', false)" class="rounded-lg border border-gray-300 px-4 py-2 text-sm font-medium text-gray-700 hover:bg-gray-50">Cancel</button>
                        <button type="submit" class="rounded-lg bg-primary-600 px-4 py-2 text-sm font-medium text-white hover:bg-primary-700">Create Task</button>
                    </div>
                </form>
            </div>
        </div>
    @endif
</div>
