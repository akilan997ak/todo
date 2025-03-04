<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Task;

class TaskController extends Controller
{
    
    

    public function store(Request $request)
    {
        // Validate incoming request data
        $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'nullable|string',
        ]);
    
        // Create a new task and associate it with the authenticated user
        $task = Task::create([
            'user_id' => auth()->id(),
            'title' => $request->title,
            'description' => $request->description,
            'completed' => 0,  // Add default value for completed
        ]);
    
        // Return the task as a JSON response
        // return response()->json(['status'=>true,'message'=>'add successfully'],200);
        return response()->json($task);
    }
    
    public function destroy($id)
    {
        $task = Task::findOrFail($id);
        $task->delete();
        return response()->json(['message' => 'Task deleted successfully']);
    }
    

    public function complete(Task $task)
    {
        if ($task->user_id === auth()->id()) {
            $task->completed = !$task->completed;
            $task->save();
            return back();
        }

        return abort(403); // Forbidden if user is not the owner
    }
    
    public function fetchTasks(Request $request)
    {
        try {
            $tasks = auth()->user()->tasks;
    
            if ($tasks->isEmpty()) {
                return response()->json(['message' => 'No tasks found.'], 404);
            }
    
            return response()->json($tasks);
        } catch (\Exception $e) {
            \Log::error('Error fetching tasks: ' . $e->getMessage());
    
            return response()->json(['error' => 'Error fetching tasks.'], 500);
        }
    }
    

}

