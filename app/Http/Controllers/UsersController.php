<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use App\Http\Requests\RegisterRequest;
use App\Http\Requests\UpdateUserRequest;

class UsersController extends Controller
{
    /**
     * Display all users
     * 
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('users.index', [
            'users' => User::latest()->paginate(3)
        ]);
    }

    /**
     * Show form for creating user
     * 
     * @return \Illuminate\Http\Response
     */
    public function create() 
    {
        
        return view('users.create');
    }

    /**
     * Store a newly created user
     * 
     * @param User $user
     * @param RegisterRequest $request
     * 
     * @return \Illuminate\Http\Response
     */
    public function store(User $user, RegisterRequest $request) 
    {
  //recibe un array de los datos que enviamos
    // $request->validate([
    // 'nif' => 'required',
    // 'name' => 'required', 
    // 'direccion' => 'required',
    // 'tlf' => 'required|regex:/^([0-9\s\-\+\(\)]*)$/|min:9',
    // 'email' => 'required|email',
    // 'password' => 'required',

    // ]);
    User::create($request->validated());

session()->flash('status','user created!');

    return to_route('users.index');
    }

    /**
     * Show user data
     * 
     * @param User $user
     * 
     * @return \Illuminate\Http\Response
     */
    public function show(User $user)
    {
    return view('users.show',compact('user'));
    } 

    /**
     * Edit user data
     * 
     * @param User $user
     * 
     * @return \Illuminate\Http\Response
      */
      public function edit(User $user)
      {
      return view('users.edit',compact('user'));
      }

    /**
     * Update user data
     * 
     * @param User $user
     * @param UpdateUserRequest $request
     * 
     * @return \Illuminate\Http\Response
     */
    public function update(RegisterRequest $request, $id)
    {
    //     $request->validate([
    //         'nif' => 'required',
    //         'name' => 'required', //que sea obligatorio escribir el nombre, 
    //         //si falla nos regresa a la misma página y envia los errores de validacion para que el user sepa que ha fallado
    //         'direccion' => 'required',
    //         'tlf' => 'required|regex:/^([0-9\s\-\+\(\)]*)$/|min:9',
    //         'email' => 'required|email',
    //         'password' => 'required|min:8',
    //         'tipo' =>'required',
    //     ]);
    $user = User::find($id);
    $user->name = $request->name;
    $user->username = $request->username;
    $user->email = $request->email;
    $user->direccion = $request->direccion;
    $user->tlf = $request->tlf;
    $user->nif = $request->nif;
    $user->password = $request->password;
    $user->created_at = $request->created_at;
    $user->tipo = 'operario';
    $user->save();
    return redirect()->route('users.index')->with('success','user has been updated successfully');
    }

     /**
     * Delete user data
     * 
     * @param User $user
     * 
     * @return \Illuminate\Http\Response
     */
    public function destroy(User $user) 
    {
        $user->delete();
        $user = User::withTrashed()->get();
        return redirect()->route('users.index')->with('delete', 'ok');
    }
}
