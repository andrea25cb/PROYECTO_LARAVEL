<?php
/** 
* @file TaskOperController.php
* @author andrea cordon
* @date 28/02/2023
*/
namespace App\Http\Controllers;

use App\Models\Task;
use App\Http\Requests\TaskRequest;
use App\Http\Requests\TaskOperRequest;
use Illuminate\Support\Facades\Storage;
class TaskOperController extends Controller{

  /**
  * @brief Display a listing of the resource. GET / tasksOper / { id }. Method : GET This method is used to display the tasks oper page.
  * @return View with the tasks oper view and tasks data to be displayed on the page as well as the details
  */
  public function index()
    {
        return view('tasksOper.index', [
            'tasksOper' => Task::where('users_id', '=', auth()->user()->id)->get()
        ]);
    }
    /**
    * @brief Muestra el listado de pendientes que haya en la tabla tasksOper
    * @return View que muestra el listado de pendientes que haya en la tabla
    */
    public function pendientes()
    {
        return view('tasksOper.pendientes', [
            'tasksOper' => Task::where('estadoTarea', '=', 'Esperando a ser aprobada')
            ->where('users_id', '=', auth()->user()->id)->get()
        ]);
    }

    /**
    * @brief Muestra el formulario de acuerdo a un registro en la base de datos
    * @param $id
    * @return Devuelve un view que muestra el registro de la base de datos si es necesario retorna un obj
    */
    public function show($id)
    {
        $task=Task::findOrFail($id);

        //Genero la url del fichero para poder descargarlo mediante un enlace:
        // The task s fichero page.
        if($task->fichero != '' || $task->fichero == null){
            $url = Storage::url('files/'.$task->fichero);
            return view('tasks.show', compact('task', 'url'));
        }
        //para bnuscar un elemento en el modelo, se usa find, si va a dar error usamos findOrFail
        
    return view('tasksOper.show',compact('task'));
    } 
 
    /**
    * @brief Devuelve la vista del formulario para editar el tarea operario.
    * @param $id
    * @return Si el usuario se encuentra logueado retorna un view pasado como parametro exitosamente retorna un mensaje de la vista
    */
    public function edit($id) //completar tarea operario
    {
        $task=Task::findOrFail($id);
        return view('tasksOper.edit', compact('task'));
    }

    /**
    * @brief Metodo para actualizar los datos desde la pantalla de un objeto Task.
    * @param $request
    * @param $id
    * @return Si el objeto es correcto retorna un objeto HttpResponseRedirect hacia el proceso de guardarlo en caso de que no se encuentra logueado exit
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
    * @brief Delete the specified task. Do not use unauthenticated user. Route : tasks / { id } /
    * @param $task
    * @return Redirects back to the tasks page with status 200 ( OK ) or 403 ( Not Found ). Handled by AuthComponent
    */
    public function destroy(Task $task)
    {
        $task->delete();

        return redirect()->route('tasksOper.index')->with('delete', 'ok');
    }
    }