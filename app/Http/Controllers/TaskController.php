<?php

namespace App\Http\Controllers;

use App\Models\Label;
use App\Models\Task;
use App\Models\User;
use App\Models\TaskStatus;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class TaskController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Contracts\Foundation\Application|
     * \Illuminate\Contracts\View\Factory|
     * \Illuminate\Contracts\View\View
     */
    public function index()
    {
        $tasks = Task::orderBy('created_at', 'asc')->paginate();
        return view('task.index', compact('tasks'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Contracts\Foundation\Application|
     * \Illuminate\Contracts\View\Factory|
     * \Illuminate\Contracts\View\View
     */
    public function create()
    {
        if (Auth::check()) {
            $task = new Task();
            $statuses = TaskStatus::all()->pluck('name', 'id');
            $performers = User::all()->pluck('name', 'id');
            $labels = Label::all()->pluck('name', 'id');
            return view('task.create', compact('task', 'statuses', 'performers', 'labels'));
        }
        return redirect('/login');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function store(Request $request)
    {
        if (Auth::check()) {
            $data = $this->validate($request, [
                'name' => 'required|unique:App\Models\Task',
                'status_id' => 'required',
            ], [
                'name.required' => __('validation.Field is required'),
                'name.unique' => __('validation.The task name has already been taken'),
                'status_id' => __('validation.Field is required'),
            ]);

            $task = new Task();
            $task->fill(array_merge($request->all(), ['created_by_id' => Auth::id()]));
            $task->save();

            if (isset($request['labels'])) {
                $task->labels()->attach($request['labels']);
            }

            if (Task::find($task->id)) {
                flash(__('task.Task has been added successfully'))->success();
                return redirect()->route('tasks.index');
            }
        }

        return redirect('/login');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Task  $task
     * @return \Illuminate\Contracts\Foundation\Application|
     *         \Illuminate\Contracts\View\Factory|
     *         \Illuminate\Contracts\View\View
     */
    public function show(Task $task)
    {
        $task = Task::findOrFail($task->id);
        $labels = $task->labels;
        return view('task.show', compact('task', 'labels'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Task  $task
     * @return \Illuminate\Contracts\Foundation\Application|
     *         \Illuminate\Contracts\View\Factory|
     *         \Illuminate\Contracts\View\View
     */
    public function edit(Task $task)
    {
        if (Auth::check()) {
            $task = Task::findOrFail($task->id);
            $statuses = TaskStatus::all()->pluck('name', 'id');
            $performers = User::all()->pluck('name', 'id');
            $labels = Label::all()->pluck('name', 'id');
            return view('task.edit', compact('task', 'statuses', 'performers', 'labels'));
        }
        return redirect('/login');
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Task  $task
     * @return \Illuminate\Http\RedirectResponse
     */
    public function update(Request $request, Task $task)
    {
        if (Auth::check()) {
            $task = Task::findOrFail($task->id);

            $this->validate($request, [
                'name' => 'required|unique:App\Models\Task,name,' . $task->id,
                'status_id' => 'required',
            ], [
                'name.required' => __('validation.Field is required'),
                'name.unique' => __('validation.The task name has already been taken'),
                'status_id' => __('validation.Field is required'),
            ]);

            $task->fill(array_merge($request->all(), ['created_by_id' => Auth::id()]));
            $task->save();

            flash(__('task.Task has been updated successfully'))->success();
            return redirect()->route('tasks.index');
        }

        return redirect('/login');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Task  $task
     * @return \Illuminate\Http\RedirectResponse
     */
    public function destroy(Task $task)
    {
        if (Auth::check()) {
            if ($task->creator->id === Auth::id()) {
                $task->labels()->detach();
                $task->delete();
                flash(__('task.Task has been deleted successfully'))->success();
                return redirect()->route('tasks.index');
            }

            flash(__('task.Task has been deleted successfully'))->success();
            return redirect()->route('tasks.index');
        }
        return redirect('/login');
    }
}
