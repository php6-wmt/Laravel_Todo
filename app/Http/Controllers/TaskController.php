<?php

namespace App\Http\Controllers;

use App\Task;
use Illuminate\Http\Request;
use Session;

class TaskController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $tasks = Task::orderBy('id', 'desc')->paginate(5);
        return view('tasks.index')->with('DisplayTask', $tasks);

    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $this->validate($request, [
            'new_task_name' => 'required|min:5|max:225',
        ]);
        $task = new Task();

        $task->name = $request->new_task_name;

        $task->save();
        Session::flash('success','new Task is successfully added');
        return redirect()->route('task.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\task $task
     * @return \Illuminate\Http\Response
     */
    public function show(task $task)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\task $task
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $task = Task::find($id);

        return view('tasks.edit')->with('TaskEdit', $task);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @param  \App\task $task
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $this->validate($request, [
            'updatedName' => 'required|min:5|max:225',
        ]);
        $task = Task::find($id);
        $task->name = $request->updatedName;
        $task->save();
        Session::flash('success','Task '.$id.' is successfully edited.');
        return redirect()->route('task.index');


    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\task $task
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $task =Task::find($id);

        $task->delete();
        Session::flash('success','Task '.$id.' is successfully deleted.');
        return redirect()->route('task.index');
    }
}
