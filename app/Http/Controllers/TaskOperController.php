<?php

namespace App\Http\Controllers;

use App\Models\Task;
use Illuminate\Http\Request;
use App\Http\Requests\TaskRequest;
use Illuminate\Support\Facades\Log;
class TaskOperController extends Controller{


  public function index()
    {
        return view('tasksOper.index', [
            'tasksOper' => Task::orderByDesc('fechaC')->paginate(3)
        ]);
    }
    public function create()
    {
        return view('tasksOper.create', compact('users', 'provincias', 'clients'));
    }
    /**
    * Store a newly created resource in storage.
    *
    * @param  \Illuminate\Http\Request  $request
    * @return \Illuminate\Http\Response
    */
    public function store(TaskRequest $request)
    {
        $v = $request->validated();
        Log::debug('peticion:'.print_r($v,true));
       // dd($v);
        $t=Task::create($v);
        Log::debug('peticion:'.print_r($t,true));;
        $t->users_id=$request->users_id;
        $t->fechaC=$request->fechaC;
        $t->fechaR=$request->fechaR;
        $t->save();
        session()->flash('status','tarea creada!');

        return to_route('tasksOper.index');
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
    
    $task = Task::find($id);
    $task->name = $request->name;
    $task->email = $request->email;
    $task->direccion = $request->direccion;
    $task->tlf = $request->tlf;
    $task->cp = $request->cp;
    $task->descripcion = $request->descripcion;
    $task->anotA = $request->anotA;
    $task->anotP = $request->anotP;
    $task->provincia = $request->provincia;
    $task->poblacion = $request->poblacion;
    $task->estadoTarea = $request->estadoTarea;
    $task->fechaC = $request->fechaC;
    $task->fechaR = $request->fechaR;
    $task->users_id = $request->users_id;
    $task->clients_id = $request->clients_id;
    $task->fichero = $request->fichero;
    $task->save();
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