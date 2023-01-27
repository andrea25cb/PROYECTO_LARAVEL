<?php

namespace App\Http\Controllers;
use App\Models\Task;
use App\Models\User;
use App\Models\Client;
use App\Models\Provincia;
use Illuminate\Http\Request;
use App\Http\Requests\TaskRequest;

class TaskController extends Controller
{
    public function index()
    {
        return view('tasks.index', [
            'tasks' => Task::orderByDesc('fechaC')->paginate(3)
        ]);
    }
    public function create()
    {
        $users = User::select('id', 'name')->where('tipo', '=', 'operario')->get();
        $provincias = Provincia::select('id', 'nombre')->get();
        $clients = Client::select('id', 'name')->get();
        return view('tasks.create', compact('users', 'provincias', 'clients'));
    }
    /**
    * Store a newly created resource in storage.
    *
    * @param  \Illuminate\Http\Request  $request
    * @return \Illuminate\Http\Response
    */
    public function store(TaskRequest $request)
    {
        Task::create($request->validated());
        session()->flash('status','tarea creada!');

        return to_route('tasks.index');
    }
    /**
    * Display the specified resource.
    *
    * @param  \App\Models\Task  $task
    * @return \Illuminate\Http\Response
    */
    public function show(Task $task)
    {
    return view('tasks.show',compact('task'));
    } 
    /**
    * Show the form for editing the specified resource.
    *
    * @param  \App\Models\Task  $task
    * @return \Illuminate\Http\Response
    */
    public function edit(Task $task)
    {
        $users = User::select('id', 'name')->where('tipo', '=', 'operario')->get();
        $provincias = Provincia::select('nombre')->get();
        $clients = Client::select('id', 'name')->get();
        return view('tasks.edit', compact('task','users', 'provincias', 'clients'));
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
    // $request->validate([
    //     'name' => 'required', 
    //     'descripcion' => 'required',
    //     'direccion' => 'required',
    //     'estadoTarea' => 'required',
    //     'tlf' => 'required|regex:/^([0-9\s\-\+\(\)]*)$/|min:9',
    //     'email' => 'required|email',
    //     'poblacion' => 'required',
    //     'provincia' => 'required',
    //     'users_id' => 'required',
    //     'clients_id' => 'required',
    //     'cp' => 'min:5',
    //     'fechaC' => 'required',
    //     'fechaR' =>'after_or_equal:fechaC',
    //     'fichero' => 'required',
    //     'anotA' => 'required',
    //     'anotP' => 'required',
    // ]);
    
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
    $task->save();
    return redirect()->route('tasks.index')->with('success','task has been updated successfully');
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

        return redirect()->route('tasks.index')->with('delete', 'ok');
    }
    }