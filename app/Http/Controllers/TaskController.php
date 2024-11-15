<?php

namespace App\Http\Controllers;

use App\Models\Task;
use Illuminate\Http\Request;

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
        $tasks = $request->tasks; // Ambil data task yang dikirimkan
        foreach ($tasks as $taskData) {
            $task = Task::find($taskData['id']);
            if (!$task) {
                // Jika task tidak ditemukan, beri respon error
                return response()->json(['error' => 'Task not found: ' . $taskData['id']], 404);
            }
            $task->order = $taskData['order'];
            $task->status = $taskData['status'];
            $task->save();
        }

        // Ambil semua task yang terupdate dan urutkan berdasarkan status dan order
        $updatedTasks = Task::orderBy('status')->orderBy('order')->get();

        // Kembalikan data task yang telah terupdate
        return response()->json(['updatedTasks' => $updatedTasks]);
    }
}
