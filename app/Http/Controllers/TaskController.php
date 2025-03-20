<?php

namespace App\Http\Controllers;

use App\Models\Task;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class TaskController extends Controller
{
    public function index()
    {
        $pageTitle = "Task Board";
        $tasks = Task::orderBy('status')->get(); // Mengurutkan berdasarkan status atau tahap
        return view('tasks.index', compact('pageTitle', 'tasks'));
    }


    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
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
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Task $task)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Task $task)
    {
        //
    }

    public function updateTaskOrder(Request $request)
    {
        $tasks = $request->tasks;
        $userId = Auth::id(); // Ambil ID user yang sedang login

        if (is_null($tasks)) {
            $tasks = []; // Pastikan tetap array kosong agar tidak error
        }

        foreach ($tasks as $taskData) {
            $task = Task::find($taskData['id']);

            if (!$task) {
                return response()->json(['error' => 'Task not found: ' . $taskData['id']], 404);
            }

            // Pastikan hanya pemilik taskboard yang bisa mengupdate
            if ($task->user_id !== $userId) {
                return response()->json(['error' => 'Unauthorized action'], 403);
            }

            $task->order = $taskData['order'];
            $task->status = $taskData['status'];
            $task->save();
        }

        $updatedTasks = Task::orderBy('status')->orderBy('order')->get();

        return response()->json(['updatedTasks' => $updatedTasks]);
    }


    public function updateTaskInline(Request $request)
    {
        $request->validate([
            'id' => 'required|integer|exists:tasks,id',
            'field' => 'required|string|in:title,description',
            'value' => 'required|string|max:255',
        ]);

        // Cari task berdasarkan ID
        $task = Task::find($request->id);

        // Pastikan task ditemukan dan dimiliki oleh user yang sedang login
        if (!$task) {
            return response()->json(['success' => false, 'message' => 'Task not found'], 404);
        }

        if ($task->user_id !== auth()->id()) {
            return response()->json(['success' => false, 'message' => 'Unauthorized: You cannot update this task'], 403);
        }

        // Update field yang relevan
        $field = $request->field;
        $task->$field = $request->value;
        $task->save();

        return response()->json(['success' => true, 'task' => $task]);
    }

    public function deleteTask(Request $request)
    {
        $request->validate([
            'id' => 'required|integer|exists:tasks,id',
        ]);

        $task = Task::find($request->id);

        if (!$task) {
            return response()->json(['success' => false, 'message' => 'Task not found'], 404);
        }

        // Pastikan hanya pemilik task yang bisa menghapus
        if ($task->user_id !== auth()->id()) {
            return response()->json(['success' => false, 'message' => 'Unauthorized: You cannot delete this task'], 403);
        }

        $task->delete();

        return response()->json(['success' => true, 'message' => 'Task deleted successfully']);
    }
}
