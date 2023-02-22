<?php

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
     * Display login page.
     * 
     * 
     */
    public function index()
    {
        $provincias = Provincia::select('id', 'nombre')->get();
        $clients = Client::select('id', 'name')->get();
        return view('soycliente.index', compact('provincias', 'clients'));
    }

    public function create(SoyClienteRequest $request)
    {
        $credentials = $request->getCredentials();
        $client = Client::select()->where('nif', '=',$credentials['nif'])
        ->where('tlf', '=',$credentials['tlf'])
        ->first();
  
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
