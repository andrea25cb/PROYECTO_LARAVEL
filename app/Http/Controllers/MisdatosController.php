<?php
/** 
* @file MisdatosController.php
* @author andrea cordon
* @date 28/02/2023
*/
namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use App\Http\Requests\UpdateUserRequest;

class MisdatosController extends Controller{

  /**
  * Muestra el listado de misdatos. Devuelve un view que contiene los datos del usuario en la pantalla
  * 
  * 
  * @return Si el usuario se encuentra logueado retorna un view que contiene los datos del usuario
  */
  public function index()
    {
        return view('misdatos.index', [
            'users' => User::where('id', '=', auth()->user()->id)->get()
        ]);
    }

    /**
    * Muestra el formulario para editar un usuario. Tambien este metodo se encarga de realizar la vista de mostrar los datos en el sistema que haya un usuario
    * 
    * @param $id
    * 
    * @return Devuelve un objeto pasado como view con el contenido del usuario
    */
    public function edit($id)
      {
        $user = User::findOrFail($id);
  
        //dd($user);
      return view('misdatos.edit',compact('user'));
      }
/**
     * Update user data
     * 
     * @param User $user
     * @param UpdateUserRequest $request
     * 
     * @return \Illuminate\Http\Response
     */
    /**
    * Metodo para actualizar los datos desde la entidad de usuarios. Parametros de entrada : $request - > nif $id Devuelve : objeto que se encarga de guardar el usuario en la peticion.
    * 
    * @param $request
    * @param $id
    * 
    * @return objeto que se encuentra logueado por el usuario y retorna un objeto con el mensaje de
    */
    public function update(UpdateUserRequest $request, $id)
    {
      
    $user = User::find($id);
    $user->nif = $request->nif;
    $user->name = $request->name;
    $user->username = $request->username;
    $user->direccion = $request->direccion;
    $user->email = $request->email;
    $user->tlf = $request->tlf;
    $user->password = $request->password;
    $user->created_at = $request->created_at;
    $user->tipo = $request->tipo;
    $user->save();
    return redirect()->route('misdatos.index')->with('success','user has been updated successfully');
    }

    }