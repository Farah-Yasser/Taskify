<?php

namespace App\Http\Controllers;

use App\Models\Task;
use Illuminate\Http\Request;

class TaskController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $query = Task::where('user_id', auth('web')->id());

        $status = $request->get('status', '');
        if ($status !== '' && in_array($status, ['pending', 'in_progress', 'completed'], true)) {
            $query->where('status', $status);
        } else {
            $status = '';
        }

        $sort = $request->get('sort', 'created_at');
        if (! in_array($sort, ['created_at', 'title', 'status'], true)) {
            $sort = 'created_at';
        }

        $order = strtolower($request->get('order', 'desc'));
        if (! in_array($order, ['asc', 'desc'], true)) {
            $order = 'desc';
        }

        $tasks = $query->orderBy($sort, $order)->get();

        return view('tasks.tasks', compact('tasks', 'status', 'sort', 'order'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('tasks.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'nullable|string',
            'status' => 'required|in:pending,in_progress,completed',
        ]);

        $task = new Task();
        $task->title = $request->title;
        $task->description = $request->description;
        $task->status = $request->status;
        $task->user_id = auth('web')->id();
        $task->save();

        return redirect()->route('tasks.index')->with('success', 'Task created successfully.');
    }

    /**
     * Display the specified resource.
     */
    public function show(Task $task)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Task $task)
    {
        $this->ensureTaskOwner($task);

        return view('tasks.edit', compact('task'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Task $task)
    {
        $this->ensureTaskOwner($task);

        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'nullable|string',
            'status' => 'required|in:pending,in_progress,completed',
        ]);

        $task->fill($validated);
        $task->save();

        return redirect()->route('tasks.index')->with('success', 'Task updated successfully.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Task $task)
    {
        $this->ensureTaskOwner($task);

        $task->delete();
        return redirect()->route('tasks.index')->with('success', 'Task deleted successfully.');
    }

    private function ensureTaskOwner(Task $task): void
    {
        if ($task->user_id !== auth('web')->id()) {
            abort(404);
        }
    }
}
