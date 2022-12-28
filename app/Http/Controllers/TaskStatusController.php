<?php

namespace App\Http\Controllers;

use App\Models\TaskStatus;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\ValidationException;

use function GuzzleHttp\Promise\task;

class TaskStatusController extends Controller
{
//    public function __construct() {
//
//        $this->middleware('auth', ['only' => ['create']]);
//
//        $this->middleware('auth', ['only' => ['store']]);
//    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $taskStatuses = TaskStatus::all();
        return view('taskStatus.index', compact('taskStatuses'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        if (Auth::check()) {
            $taskStatus = new TaskStatus();
            return view('taskStatus.create', compact('taskStatus'));
        }
        return redirect('/login');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\RedirectResponse
     * @throws ValidationException
     */
    public function store(Request $request)
    {
        if (Auth::check()) {
            $this->validate($request, [
                'name' => 'required|max:100|unique:App\Models\TaskStatus'
            ], [
                'name.required' => __('validation.Field is required'),
                'name.max:50' => __('validation.Exceeded maximum name length of :max characters'),
                'name.unique' => __('validation.The status name has already been taken'),
            ]);

            $taskStatus = new TaskStatus();
            $taskStatus->fill($request->all());
            $taskStatus->save();

            if(TaskStatus::find($taskStatus->id)) {
                flash(__('taskStatus.Status has been added successfully'))->success();
            }

            return redirect()->route('task_statuses.index');
        }
        return redirect('/login');
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\TaskStatus  $taskStatus
     * @return \Illuminate\Http\Response
     */
    public function edit(TaskStatus $taskStatus)
    {
        if (Auth::check()) {
            $taskStatus = TaskStatus::findOrFail($taskStatus->id);
            return view('taskStatus.edit', compact('taskStatus'));
        }
        return redirect('/login');
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\TaskStatus  $taskStatus
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, TaskStatus $taskStatus)
    {
        if (Auth::check()) {
            $taskStatus = TaskStatus::findOrFail($taskStatus->id);
            $this->validate($request, [
                'name' => 'required|max:50|unique:App\Models\TaskStatus',
            ], [
                'name.required' => __('validation.Field is required'),
                'name.max:50' => __('validation.Exceeded maximum name length of :max characters'),
                'name.unique' => __('validation.The task name has already been taken'),
            ]);

            $taskStatus->fill($request->all());
            $taskStatus->save();

            return redirect()->route('task_statuses.index');
        }

        return redirect('/login');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\TaskStatus  $taskStatus
     * @return \Illuminate\Http\RedirectResponse
     */
    public function destroy(TaskStatus $taskStatus)
    {
        if (Auth::check()) {
            if (!$taskStatus->tasks()->exists()) {
                $taskStatus->delete();
                flash(__('taskStatus.Status has been deleted successfully'))->success();
                return redirect()->route('task_statuses.index');
            }

            flash(__('taskStatus.Failed to delete status'))->error();
            return redirect()->route('task_statuses.index');
        }
        return redirect('/login');
    }
}
