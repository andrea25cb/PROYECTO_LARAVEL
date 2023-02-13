<?php

namespace App\Http\Controllers;

use App\Models\Task;
use App\Http\Requests\TaskRequest;
use App\Http\Requests\TaskOperRequest;
use Illuminate\Support\Facades\Storage;
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
            'tasksOper' => Task::where('estadoTarea', '=', 'Esperando a ser aprobada')
            ->where('users_id', '=', auth()->user()->id)
            ->get()
        ]);
    }
    /**
    * Display the specified resource.
    *
    * @param  \App\Models\Task  $task
    * @return \Illuminate\Http\Response
    */
    public function show($id)
    {
        $task=Task::findOrFail($id);

        //Genero la url del fichero para poder descargarlo mediante un enlace:
        if($task->fichero != '' || $task->fichero == null){
            $url = Storage::url('files/'.$task->fichero);
            return view('tasks.show', compact('task', 'url'));
        }
        //para bnuscar un elemento en el modelo, se usa find, si va a dar error usamos findOrFail
        
    return view('tasksOper.show',compact('task'));
    } 
    /**
    * Show the form for editing the specified resource.
    *
    * @param  \App\Models\Task  $task
    * @return \Illuminate\Http\Response
    */
    public function edit($id) //completar tarea operario
    {
        $task=Task::findOrFail($id);
        return view('tasksOper.edit', compact('task'));
    }
    /**
    * Update the specified resource in storage.
    *
    * @param  \Illuminate\Http\Request  $request
    * @param  \App\Models\Task  $task
    * @return \Illuminate\Http\Response
    */
    public function update(TaskOperRequest $request, $id)
    {
    
    $tasksOper = Task::find($id);
  
    $tasksOper->descripcion = $request->descripcion;
    $tasksOper->anotA = $request->anotA;
    $tasksOper->anotP = $request->anotP;
    $tasksOper->estadoTarea = $request->estadoTarea;
    $tasksOper->fechaC = $request->fechaC;
    $tasksOper->fechaR = $request->fechaR;

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