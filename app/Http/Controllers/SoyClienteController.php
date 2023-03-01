<?php
/** 
* @file SoyClienteController.php
* @author andrea cordon
* @date 28/02/2023
*/
namespace App\Http\Controllers;
use App\Http\Requests\SoyClienteRequest;
use App\Http\Requests\TaskClientRequest;
use App\Models\TaskClient;
use App\Models\Client;
use App\Models\Task;
use App\Models\Provincia;
use App\Models\Cuote;
use App\Models\SoyCliente;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

class SoyClienteController extends Controller
{

    /**
    * Devuelve la vista de clientes que haya usado por el metodo cliente.
    * 
    * 
    * @return Devuelve la vista de clientes que haya usado por el metodo client
    */
    public function index()
    {
        $provincias = Provincia::select('id', 'nombre')->get();
        $clients = Client::select('id', 'name')->get();
        return view('soycliente.index', compact('provincias', 'clients'));
    }

    /**
    * Creates a task. This will return a Response object that contains the ID of the task and an array of errors if any.
    * 
    * @param $request
    * 
    * @return Response object or error message in case of failure. On success it will contain the ID of the task
    */
    public function create(SoyClienteRequest $request)
    {
        $credentials = $request->getCredentials();
        $client = Client::select()->where('nif', '=',$credentials['nif'])
        ->where('tlf', '=',$credentials['tlf'])
        ->first();
  
        // Create a new task.
        if (!$client) {
            return to_route('soycliente.index')
            ->withErrors([
                'nif' => 'The provided credentials do not match our records.',
                'tlf' => 'The provided credentials do not match our records.',
            ]);
         }
         else {
            $v = $request->validated();
            $t=Task::create($v);
            $t->users_id=$request->users_id;
            $t->fechaC=$request->fechaC;
            $t->fechaR=$request->fechaR;
            $t->clients_id=$client->id;
            $t->save();
            return to_route('soycliente.index')->with('success','task has been created successfully');
         }
    }

}
