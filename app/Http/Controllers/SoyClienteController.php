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
     * @return Renderable
     */
    public function index()
    {
        return view('soycliente.index');
    }

     /**
     * Handle account login request
     * 
     * @param SoyClienteRequest $request
     * 
     *
     */
    public function login(SoyClienteRequest $request)
    {
        $credentials = $request->getCredentials();
        //$client = Client::select()->where('nif', '=','49731902Z')
        // ->first();

        // dd($credentials);

        if (!$credentials['nif']) {
            return to_route('soycliente.index')->withErrors([
                'nif' => 'The provided credentials do not match our records.',
                'tlf' => 'The provided credentials do not match our records.',
            ]);
         }
         else{
            return to_route('soycliente.show');
         }
    }

    /**
    * Display the specified resource.
    *
    * @param  \App\Models\Client  $client
    * 
    */
    public function show(Client $client, SoyClienteRequest $request)
    {  
        // $cuotes = Cuote::where('clients_id', '=', auth()->user()->id)->get();
        return view('soycliente.show', [
            'cuotes' => Cuote::where('clients_id', '=', $client->id)->get()
        ]);
        
    // return view('soycliente.show',compact('client', 'cuotes'));
    } 

    /**Cliente crea nueva tarea: */
    public function create()
    {
        $provincias = Provincia::select('id', 'nombre')->get();
        $clients = Client::select('id', 'name')->get();
        return view('soycliente.create', compact('provincias', 'clients'));
    }
    /**
    * Store a newly created resource in storage.
    *
    * @param  \Illuminate\Http\Request  $request
    * @return \Illuminate\Http\Response
    */

    // hacer vista para ‘soy cliente’ y que vea todas las cuotas asignadas a su NIF / TLF

//   public function store(TaskClientRequest $request)
//     {
   
//         $v = $request->validated();
//         // Log::debug('peticion:'.print_r($v,true));
//        // dd($v);
//         $t=Task::create($v);
//         // Log::debug('peticion:'.print_r($t,true));;
//         $t->users_id=$request->users_id;
//         $t->fechaC=$request->fechaC;
//         $t->fechaR=$request->fechaR;
//         $t->save();
//         session()->flash('status','task updated!');

//         return to_route('tasks.index');
//     }
}
