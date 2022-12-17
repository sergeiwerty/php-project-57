<?php

namespace App\Http\Controllers;

use App\Models\TaskStatus;
use Illuminate\Http\Request;

class TaskStatusController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $tasks = TaskStatus::all();
        return view('taskStatus.index', compact('tasks'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $taskStatus = new TaskStatus();
        return view('taskStatus.create', compact('taskStatus'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function store(Request $request)
    {
        if (TaskStatus::where('name', '=', $request->name)->exists()) {
//            dump($request->name);
            flash('Статус с таким именем уже существует')->info();
//            sleep(800);

//            return redirect()->route('task_statuses.create');
        }

        $request->validate([
            'name' => 'required|max:100|unique:App\Models\TaskStatus,name'
        ], [
            'name.unique:App\Models\TaskStatus,name' => 'Статус с таким именем уже существует',
            'name.required' => 'Это обязательное поле',
            'name.max:100' => 'Превышена максимальная длина в 100 символов'
        ]);

        $taskStatus = new TaskStatus();
        $taskStatus->fill($request->all());
        $taskStatus->save();

        return redirect()->route('task_statuses.index');
    }

//    /**
//     * Display the specified resource.
//     *
//     * @param  \App\Models\TaskStatus  $taskStatus
//     * @return \Illuminate\Http\Response
//     */
//    public function show(TaskStatus $taskStatus)
//    {
//        $taskStatus
//    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\TaskStatus  $taskStatus
     * @return \Illuminate\Http\Response
     */
    public function edit(TaskStatus $taskStatus)
    {
        //
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
        //
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
