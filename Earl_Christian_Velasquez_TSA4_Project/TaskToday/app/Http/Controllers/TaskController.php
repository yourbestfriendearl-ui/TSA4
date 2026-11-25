<?php

namespace App\Http\Controllers;

use App\Mail\TaskCompleted;
use App\Models\Task;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use Illuminate\View\View;

class TaskController extends Controller
{
    public function index(): View
    {
        $tasks = Task::where('is_archived', false)->orderBy('due_date')->get();
        return view('tasks.index', compact('tasks'));
    }

    public function create(): View { return view('tasks.create'); }

    public function store(Request $request): RedirectResponse
    {
        Task::create($this->validated($request));
        return redirect()->route('tasks.index')->with('success', 'Task created.');
    }

    public function edit(Task $task): View
    {
        abort_if($task->is_archived, 404);
        return view('tasks.edit', compact('task'));
    }

    public function update(Request $request, Task $task): RedirectResponse
    {
        abort_if($task->is_archived, 404);
        $wasDone = $task->status === 'done';
        $data = $this->validated($request);
        $task->update($data);
        if (!$wasDone && $task->status === 'done') {
            $recipient = config('tasks.notification_email');
            if ($recipient) Mail::to($recipient)->send(new TaskCompleted($task));
        }
        return redirect()->route('tasks.index')->with('success', 'Task updated.');
    }

    public function destroy(Task $task): RedirectResponse
    {
        $task->update(['is_archived' => true]);
        return redirect()->route('tasks.index')->with('success', 'Task archived.');
    }

    private function validated(Request $request): array
    {
        return $request->validate([
            'title' => ['required', 'string', 'min:3', 'max:120'],
            'description' => ['required', 'string', 'max:2000'],
            'due_date' => ['required', 'date'],
            'status' => ['required', 'in:pending,in_progress,done'],
        ]);
    }
}
