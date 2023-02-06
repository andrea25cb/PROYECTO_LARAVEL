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
        $u= User::create($request->validated());
        $u->save();
        session()->flash('status','user updated!');

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
    $user->tipo = '';
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
