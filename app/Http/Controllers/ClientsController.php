<?php
/** 
* @file ClientsController.php
* @author andrea cordon
* @date 28/02/2023
*/
namespace App\Http\Controllers;
use App\Models\Client;
use App\Models\Country;
use Illuminate\Http\Request;
use App\Http\Requests\ClientRequest;

class ClientsController extends Controller
{
   
    /**
    * @brief Display a listing of the resource. GET / clients / { id }. Default : id. View parameters : id ( int ) : ID of the client.
    * @return View with list of clients or error view if not found ( 404 ) or access denied ( 405 )
    */
    public function index()
    {
        return view('clients.index', [
            'clients' => Client::paginate(3)
        ]);
    }

 
    /**
    * @brief Show the form for creating a new client. GET / clients / { id }. html Sirve que devuelve el formulario para crear una nueva client.
    * @return Scrive de la vista realizada por el usuario create () o view client
    */
    public function create()
    {
        $paises = Country::select('id', 'nombre','iso_moneda')->get();
        return view('clients.create', compact('paises'));
    }

   
    /**
    * @brief Store a newly created client in storage. This is a POST method. Do not use this method directly.
    * @param $request
    * @return Redirect to index page
    */
    public function store(ClientRequest $request)
    {
        Client::create($request->validated());
    session()->flash('status','cliente creado!');

        return to_route('clients.index');
    }

  
    /**
    * @brief Display the specified client. This is the view for the clients view. If the client is found in the database it will be returned as well
    * @param $client
    * @return The client view or error view if not found ( 404 ) or not logged in ( 500 ). If the client is found in the database it will be returned as well
    */
    public function show(Client $client)
    {
        return view('clients.show',compact('client'));
    }
    

    /**
    * @brief Show the form for editing the specified client. This is a view that allows the user to edit the client's details.
    * @param $client
    * @return The client view with the details of the client that was edited or an error view if one couldn't be found
    */
    public function edit(Client $client)
    {
        return view('clients.edit',compact('client'));
    }


    /**
    * @brief Metodo que permite actualizar un nuevo cliento en la base de datos. Parametros de entrada : $request - > id ( ID de la entidad ). Devuelve : objeto HttpResponse del template clients. index renderizado con el proceso de guardarlos del formulario de modificacion.
    * @param $request
    * @param $id
    * @return Si el usuario se encuentra logueado retorna un objeto HttpResponse del template clients
    */
    public function update(ClientRequest $request, $id)
    {
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
    * @brief Remove the specified client from storage. DELETE / clients / { id } Response will be redirected to the index page.
    * @param $client
    * @return A redirect response to the index page with status 200 ( OK ). Otherwise the body of the response will be empty
    */
    public function destroy(Client $client)
    {
        $client->delete();
        $client = Client::withTrashed()->get();
        return redirect()->route('clients.index')->with('delete', 'ok');
    }
    
}
