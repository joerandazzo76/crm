<?php

namespace App\Livewire\Tasks;

use App\Models\Task;
use Livewire\Component;
use Livewire\WithPagination;

class TaskIndex extends Component
{
    use WithPagination;

    public string $search = '';
    public string $statusFilter = '';
    public string $priorityFilter = '';
    public bool $showCreateModal = false;

    public string $title = '';
    public string $description = '';
    public ?string $due_date = null;
    public string $priority = 'medium';
    public ?int $assigned_to = null;

    public function updatingSearch(): void { $this->resetPage(); }

    public function createTask(): void
    {
        $data = $this->validate([
            'title' => 'required|string|max:255',
            'description' => 'nullable|string',
            'due_date' => 'nullable|date',
            'priority' => 'required|in:low,medium,high,urgent',
            'assigned_to' => 'nullable|exists:users,id',
        ]);

        Task::create($data);
        $this->reset(['title', 'description', 'due_date', 'priority', 'assigned_to', 'showCreateModal']);
        session()->flash('success', 'Task created.');
    }

    public function toggleComplete(int $id): void
    {
        $task = Task::findOrFail($id);
        $task->update([
            'status' => $task->status === 'completed' ? 'pending' : 'completed',
            'completed_at' => $task->status === 'completed' ? null : now(),
        ]);
    }

    public function deleteTask(int $id): void
    {
        Task::findOrFail($id)->delete();
    }

    public function render()
    {
        $tasks = Task::with('assignee', 'taskable')
            ->when($this->search, fn ($q) => $q->where('title', 'like', "%{$this->search}%"))
            ->when($this->statusFilter, fn ($q) => $q->where('status', $this->statusFilter))
            ->when($this->priorityFilter, fn ($q) => $q->where('priority', $this->priorityFilter))
            ->orderByRaw("FIELD(status, 'pending', 'in_progress', 'completed')")
            ->orderBy('due_date')
            ->paginate(20);

        $users = \App\Models\User::orderBy('name')->get();

        return view('livewire.tasks.task-index', compact('tasks', 'users'))
            ->layout('layouts.app', ['title' => 'Tasks']);
    }
}
