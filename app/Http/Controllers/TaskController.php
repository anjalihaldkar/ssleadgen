<?php

namespace App\Http\Controllers;

use App\Models\Task;
use App\Models\TaskNote;
use Illuminate\Http\Request;

class TaskController extends Controller
{
    public function index()
    {
        // Load tasks and notes (newest tasks first, or sorted by due date)
        $tasks = Task::with('notes')->orderBy('due_date', 'asc')->get();
        return view('pages.utilities.tasks', compact('tasks'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'client_name' => 'nullable|string|max:255',
            'due_date' => 'required|date',
            'priority' => 'required|in:High,Medium,Low',
        ]);

        $task = Task::create($validated);
        
        // Add initial note
        $task->notes()->create([
            'note' => 'Task created.'
        ]);

        return redirect()->back()->with('success', 'Task added successfully.');
    }

    public function updateStatus(Task $task)
    {
        $task->update([
            'status' => $task->status === 'Completed' ? 'Pending' : 'Completed'
        ]);

        // Add a note about the status change
        $task->notes()->create([
            'note' => 'Status updated: ' . $task->status . '.'
        ]);

        return redirect()->back()->with('success', 'Task status updated.');
    }

    public function storeNote(Request $request, Task $task)
    {
        $validated = $request->validate([
            'note' => 'required|string',
        ]);

        $task->notes()->create($validated);

        return redirect()->back()->with('success', 'Task note added.');
    }

    public function destroy(Task $task)
    {
        $task->delete();
        return redirect()->back()->with('success', 'Task deleted successfully.');
    }
}
