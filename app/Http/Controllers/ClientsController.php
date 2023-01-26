<?php

namespace App\Http\Controllers;
use App\Models\Client;
use App\Models\Country;
use Illuminate\Http\Request;

class ClientsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('clients.index', [
            'clients' => Client::paginate(3)
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $paises = Country::select('id', 'nombre','iso_moneda')->get();
        return view('clients.create', compact('paises'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
         //recibe un array de los datos que enviamos
   $request->validate([
        'name' => 'required', //que sea obligatorio escribir el nombre, 
        //si falla nos regresa a la misma página y envia los errores de validacion para que el client sepa que ha fallado
        'nif' => 'required|min:9|max:9',
        'email' => 'required|email',
        'tlf' => 'required|regex:/^([0-9\s\-\+\(\)]*)$/|min:9',
        'cuentaCorriente' => 'min:12',
        ]);
        
        Client::create($request->validated());
    session()->flash('status','cliente creado!');

        return to_route('clients.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(Client $client)
    {
        return view('clients.show',compact('client'));
    }

    
    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(Client $client)
    {
        return view('clients.edit',compact('client'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $request->validate([
            'name' => 'required', //que sea obligatorio escribir el nombre, 
            //si falla nos regresa a la misma página y envia los errores de validacion para que el client sepa que ha fallado
            'descripcion' => 'required',
            'tlf' => 'required|regex:/^([0-9\s\-\+\(\)]*)$/|min:9|max:9',
            'email' => 'required|email',
            'cuentaCorriente' => 'min:12|max:12',
            
        ]);
        $client = Client::find($id);
        $client->name = $request->name;
        $client->email = $request->email;
        $client->nif = $request->nif;
        $client->tlf = $request->tlf;
        $client->cuentaCorriente = $request->cuentaCorriente;
        $client->pais = $request->pais;
        $client->moneda = $request->moneda;
        $client->cuotaMensual = $request->cuotaMensual;
        $client->estadoTarea = $request->estadoTarea;
        $client->save();
        return redirect()->route('clients.index')->with('success','client has been updated successfully');
        }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Client $client) 
    {
        $client->delete();

        return redirect()->route('clients.index')
        ->with('delete', 'ok');
    }
}
