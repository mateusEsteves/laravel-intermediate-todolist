<?php

namespace App\Http\Controllers;

use App\Task;
use Illuminate\Http\Request;
use App\Repositories\TaskRepository;

class TaskController extends Controller
{
    public function __construct(TaskRepository $tasks){
        $this->middleware('auth');

        $this->tasks = $tasks;
    }

    public function index(Request $request){
        return view('tasks.index', [
            'tasks' => $this->tasks->getTasksForUser($request->user())
        ]);
    }

    public function add(Request $request){
        $this->validate($request, [
            'name' => 'required|max:255'
        ]);
        
        $request->user()->tasks()->create([
            'name' => $request->name
        ]);

        return redirect('/tasks');
    }


    public function delete(Request $request, Task $task){
        $this->authorize('delete', $task);

        $task->delete();

        return redirect('/tasks');
    }
}
