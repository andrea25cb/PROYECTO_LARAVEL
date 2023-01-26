<?php

namespace App\Http\Controllers;
use App\Models\Cuote;

use Illuminate\Http\Request;

class CuotesController extends Controller
{
    public function index()
    {
        return view('cuotes.index', [
            'cuotes' => Cuote::paginate(3)
        ]);
    }
    public function create()
    {
        // $users = User::select('id', 'name')->where('tipo', '=', 'operario')->get();
        // $provincias = Provincia::select('id', 'nombre')->get();
        // $clients = Client::select('id', 'name')->get();
        // return view('cuotes.create', compact('users', 'provincias', 'clients'));
    }
    /**
    * Store a newly created resource in storage.
    *
    * @param  \Illuminate\Http\Request  $request
    * @return \Illuminate\Http\Response
    */
    public function store(Request $request)
    {
        // dd($request);
    //recibe un array de los datos que enviamos
    $data = $request->validate([
        'name' => 'required', //que sea obligatorio escribir el nombre, 
        //si falla nos regresa a la misma página y envia los errores de validacion para que el user sepa que ha fallado
        'descripcion' => 'required',
        'direccion' => 'required',
        'estadoTarea' => 'required',
        'tlf' => 'required|regex:/^([0-9\s\-\+\(\)]*)$/|min:9|max:9',
        'email' => 'required|email',
        'poblacion' => 'required',
        'provincia' => 'required',
        'users_id' => 'required',
        'clients_id' => 'required',
        'cp' => 'min:5',
        'fechaC' => 'required',
        'fechaR' =>'after_or_equal:fechaC',
        'fichero' => 'required',
        'anotA' => 'required',
        'anotP' => 'required',
        //poner todos los campos required para que salgan todos
        ]);
        
        Cuote::create($data);
    session()->flash('status','tarea creada!');

        return to_route('cuotes.index');
    }
    /**
    * Display the specified resource.
    *
    * @param  \App\Models\Cuote  $Cuote
    * @return \Illuminate\Http\Response
    */
    public function show(Cuote $Cuote)
    {
    return view('cuotes.show',compact('Cuote'));
    } 
    /**
    * Show the form for editing the specified resource.
    *
    * @param  \App\Models\Cuote  $Cuote
    * @return \Illuminate\Http\Response
    */
    public function edit(Cuote $Cuote)
    {
        // $users = User::select('id', 'name')->where('tipo', '=', 'operario')->get();
        // $provincias = Provincia::select('nombre')->get();
        // $clients = Client::select('id', 'name')->get();
        // return view('cuotes.edit', compact('Cuote','users', 'provincias', 'clients'));
    }
    /**
    * Update the specified resource in storage.
    *
    * @param  \Illuminate\Http\Request  $request
    * @param  \App\Models\Cuote  $Cuote
    * @return \Illuminate\Http\Response
    */
    public function update(Request $request, $id)
    {
    $request->validate([
        'name' => 'required', //que sea obligatorio escribir el nombre, 
        //si falla nos regresa a la misma página y envia los errores de validacion para que el user sepa que ha fallado
        'descripcion' => 'required',
        'tlf' => 'required|regex:/^([0-9\s\-\+\(\)]*)$/|min:9|max:9',
        'email' => 'required|email',
        'cp' => 'min:5',
        'fechaR' =>'required|date|after_or_equal:fechaC',
    ]);
    
    $Cuote = Cuote::find($id);
    $Cuote->name = $request->name;
    $Cuote->email = $request->email;
    $Cuote->direccion = $request->direccion;
    $Cuote->tlf = $request->tlf;
    $Cuote->cp = $request->cp;
    $Cuote->descripcion = $request->descripcion;
    $Cuote->anotA = $request->anotA;
    $Cuote->anotP = $request->anotP;
    $Cuote->provincia = $request->provincia;
    $Cuote->poblacion = $request->poblacion;
    $Cuote->estadoTarea = $request->estadoTarea;
    $Cuote->fechaC = $request->fechaC;
    $Cuote->fechaR = $request->fechaR;
    $Cuote->users_id = $request->users_id;
    $Cuote->clients_id = $request->clients_id;
    $Cuote->save();
    return redirect()->route('cuotes.index')->with('success','Cuote has been updated successfully');
    }
    /**
    * Remove the specified resource from storage.
    *
    * @param  \App\Models\Cuote  $Cuote
    * @return \Illuminate\Http\Response
    */
    public function destroy(Cuote $Cuote)
    {
        $Cuote->delete();

        return redirect()->route('cuotes.index')
        ->with('delete', 'ok');
    }
}
