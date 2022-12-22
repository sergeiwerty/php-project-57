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
        if (TaskStatus::where('name', '=', $request->name)->exists()) {
//            dump($request->name);
//            flash('уже существует')->info();
//            sleep(800);

//            return redirect()->route('task_statuses.create');
        }

        $this->validate($request, [
            'name' => 'required|max:100|unique:App\Models\TaskStatus,name'
        ], [
            'name.required' => 'Это обязательное поле',
            'name.max:100' => 'Превышена максимальная длина в 100 символов'
        ]);

        $taskStatus = new TaskStatus();
        $taskStatus->fill($request->all());
        $taskStatus->save();

        return redirect()->route('task_statuses.index');
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\TaskStatus  $taskStatus
     * @return \Illuminate\Http\Response
     */
    public function edit(TaskStatus $taskStatus)
    {
        $updatedTaskStatus = TaskStatus::findOrFail($taskStatus->id);
        return view('taskStatus.edit', compact('updatedTaskStatus'));
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
        $updatedTaskStatus = TaskStatus::findOrFail($taskStatus->id);
        $this->validate($request, [
            'name' => 'required|max:100|unique:App\Models\TaskStatus,name'. $updatedTaskStatus->id,
        ], [
            'name.required' => 'Это обязательное поле',
            'name.max:100' => 'Превышена максимальная длина в 100 символов'
        ]);

        $taskStatus = new TaskStatus();
        $taskStatus->fill($request->all());
        $taskStatus->save();

        return redirect()->route('task_statuses.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\TaskStatus  $taskStatus
     * @return \Illuminate\Http\Response
     */
    public function destroy(TaskStatus $taskStatus)
    {
        //
    }
}
