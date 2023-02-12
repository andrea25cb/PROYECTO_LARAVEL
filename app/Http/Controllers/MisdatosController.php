<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use App\Http\Requests\UpdateUserRequest;

class MisdatosController extends Controller{

  public function index()
    {
        return view('misdatos.index', [
            'users' => User::where('id', '=', auth()->user()->id)->get()
        ]);
    }

    // public function create()
    // {
    //     return view('misdatos.create', compact('users', 'provincias', 'clients'));
    // }
    /**
    * Store a newly created resource in storage.
    *
    * @param  \Illuminate\Http\Request  $request
    * @return \Illuminate\Http\Response
    */
    // public function store(TaskOperRequest $request)
    // {
    //     $v = $request->validated();
    //     Log::debug('peticion:'.print_r($v,true));
    //    // dd($v);
    //     $t=user::create($v);
    //     Log::debug('peticion:'.print_r($t,true));;
    //     $t->users_id=$request->users_id;
    //     $t->fechaC=$request->fechaC;
    //     $t->fechaR=$request->fechaR;
    //     $t->save();
    //     session()->flash('status','tarea creada!');

    //     return to_route('misdatos.index');
    // }
    /**
    * Display the specified resource.
    *
    * @param  \App\Models\user  $user
    * @return \Illuminate\Http\Response
    */
    public function show(user $user)
    {
    return view('misdatos.show',compact('user'));
    } 
    /**
    * Show the form for editing the specified resource.
    *
    * @param  \App\Models\user  $user
    * @return \Illuminate\Http\Response
    */
    public function edit(User $user)
      {
        $user =  User::where('id', '=', auth()->user()->id);
        dd(  $user);
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
    /**
    * Remove the specified resource from storage.
    *
    * @param  \App\Models\user  $user
    * @return \Illuminate\Http\Response
    */
    // public function destroy(user $user)
    // {
    //     $user->delete();
    //     $user = User::withTrashed()->get();
    //     return redirect()->route('login')->with('delete', 'ok');
    // }
    }