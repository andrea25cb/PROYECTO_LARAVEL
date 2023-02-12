<?php

namespace App\Http\Controllers;

use App\Models\Task;
use Illuminate\Http\Request;
use App\Http\Requests\TaskRequest;
use App\Http\Requests\TaskOperRequest;
use Illuminate\Support\Facades\Log;
class TaskOperController extends Controller{

  public function index()
    {
        return view('tasksOper.index', [
            'tasksOper' => Task::where('users_id', '=', auth()->user()->id)->get()
        ]);
    }

    public function pendientes()
    {
        return view('tasksOper.pendientes', [
            'tasksOper' => Task::where('users_id', '=', auth()->user()->id)->get()
            // 'tasksOper' => Task::where('estadoTarea', '=', 'Esperando a ser aprobada')->where('users_id', '=', auth()->user()->id)->first()
        ]);
    }
    /**
    * Display the specified resource.
    *
    * @param  \App\Models\Task  $task
    * @return \Illuminate\Http\Response
    */
    public function show(Task $task)
    {
    return view('tasksOper.show',compact('task'));
    } 
    /**
    * Show the form for editing the specified resource.
    *
    * @param  \App\Models\Task  $task
    * @return \Illuminate\Http\Response
    */
    public function edit(Task $task)
    {
        return view('tasksOper.edit', compact('task'));
    }
    /**
    * Update the specified resource in storage.
    *
    * @param  \Illuminate\Http\Request  $request
    * @param  \App\Models\Task  $task
    * @return \Illuminate\Http\Response
    */
    public function update(TaskRequest $request, $id)
    {
    
    $tasksOper = Task::find($id);
    $tasksOper->name = $request->name;
    $tasksOper->email = $request->email;
    $tasksOper->direccion = $request->direccion;
    $tasksOper->tlf = $request->tlf;
    $tasksOper->cp = $request->cp;
    $tasksOper->descripcion = $request->descripcion;
    $tasksOper->anotA = $request->anotA;
    $tasksOper->anotP = $request->anotP;
    $tasksOper->provincia = $request->provincia;
    $tasksOper->poblacion = $request->poblacion;
    $tasksOper->estadoTarea = $request->estadoTarea;
    $tasksOper->fechaC = $request->fechaC;
    $tasksOper->fechaR = $request->fechaR;
    $tasksOper->users_id = $request->users_id;
    $tasksOper->clients_id = $request->clients_id;
    $tasksOper->fichero = $request->fichero;
    $tasksOper->save();
    return redirect()->route('tasksOper.index')->with('success','task has been updated successfully');
    }
    /**
    * Remove the specified resource from storage.
    *
    * @param  \App\Models\Task  $task
    * @return \Illuminate\Http\Response
    */
    public function destroy(Task $task)
    {
        $task->delete();

        return redirect()->route('tasksOper.index')->with('delete', 'ok');
    }
    }