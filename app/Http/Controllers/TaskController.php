<?php
/** 
* @file TaskController.php
* @author andrea cordon
* @date 28/02/2023
*/
namespace App\Http\Controllers;
use App\Models\Task;
use App\Models\User;
use App\Models\Client;
use App\Models\Provincia;
use Illuminate\Support\Facades\Storage;
use App\Http\Requests\TaskRequest;
use Illuminate\Support\Facades\Log;

class TaskController extends Controller
{
    /**
    * Display a listing of the resource. GET / tasks / { id }. Method : GET. Redirects to the tasks index page.
    * 
    * 
    * @return View with tasks list and pagination information to display in the form of an array of Task objects sorted by fecha
    */
    public function index()
    {
        return view('tasks.index', [
            'tasks' => Task::orderByDesc('fechaC')->paginate(3)
        ]);
    }
    /**
    * Devuelve la vista del formulario para crear un task. If successfull retorna el view asociativo con el mensaje de task.
    * 
    * 
    * @return Mensaje del view asociativo con el mensaje de task encontr
    */
    public function create()
    {
        $users = User::select('id', 'name')->where('tipo', '=', 'operario')->get();
        $provincias = Provincia::select('id', 'nombre')->get();
        $clients = Client::select('id', 'name')->get();
        return view('tasks.create', compact('users', 'provincias', 'clients'));
    }

    /**
    * Metodo para guardar el formulario de creacion de un nuevo task. Luego se encarga de guardar la instancia de Titulo en la base de datos.
    * 
    * @param $request
    * 
    * @return Si el usuario se llama a guardar el proceso exitosa retorna un route'tasks '
    */
    public function store(TaskRequest $request)
    {
        // $request->file('fichero')->store('public');
       // Metodo para fichero de fichero de fichero de fichero de fichero
       if( $request->file('fichero')){
            $request->file('fichero')->move('storage');
       }
   
        $v = $request->validated();
        Log::debug('peticion:'.print_r($v,true));
       // dd($v);
        $t=Task::create($v);
        Log::debug('peticion:'.print_r($t,true));;
        $t->users_id=$request->users_id;
        $t->fechaC=$request->fechaC;
        $t->fechaR=$request->fechaR;
        $t->save();
        session()->flash('status','task created!');

        return to_route('tasks.index');
    }

    /**
    * Devuelve la vista del usuario en formato html. Si el nuevo task tiene que hay algun asignado se encuentra el archivo de fichero y enlace la url correspondiente
    * 
    * @param $task
    * 
    * @return Retorna un view'tasks. show'con el formulario html del usuario
    */
    public function show(Task $task)
    {
        //Genero la url del fichero para poder descargarlo mediante un enlace:
        // The task s fichero page.
        if($task->fichero != '' || $task->fichero == null){
            $url = Storage::url('files/'.$task->fichero);
            return view('tasks.show', compact('task', 'url'));
        }

    return view('tasks.show',compact('task'));
    } 

    /**
    * Show the form for editing the specified resource. GET / tasks / { id } / edit. php
    * 
    * @param $task
    * 
    * @return The view for editing the specified task or error message if one exists. Null if editing is not allowed
    */
    public function edit(Task $task)
    {
        $users = User::select('id', 'name')->where('tipo', '=', 'operario')->get();
        $provincias = Provincia::select('nombre')->get();
        $clients = Client::select('id', 'name')->get();
        return view('tasks.edit', compact('task','users', 'provincias', 'clients'));
    }
    /**
    * Update a task in the database. This is a form that allows to update an existing task from the data sent to the client
    * 
    * @param $request
    * @param $id
    * 
    * @return True if successful false
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
    return redirect()->route('tasks.index')->with('success','task has been updated successfully');
    }
    /**
    * Remove the specified task from storage. DELETE / tasks / { id } Response will be redirected to the index page.
    * 
    * @param $task
    * 
    * @return The task that was deleted or a redirect to the index page if the task couldn't be found
    */
    public function destroy(Task $task)
    {
        $task->delete();
        $task = Task::withTrashed()->get();
        return redirect()->route('tasks.index')->with('delete', 'ok');
    }
    }