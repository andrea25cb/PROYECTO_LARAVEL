<?php

namespace App\Http\Controllers;
use App\Http\Requests\SoyClienteRequest;
use App\Models\SoyCliente;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;

class SoyClienteController extends Controller
{
      public function __construct(){
        $this->middleware('client');
    }

     /**
     * Display login page.
     * 
     * @return Renderable
     */
    public function show()
    {
        return view('auth.soycliente');
    }

     /**
     * Handle account login request
     * 
     * @param SoyClienteRequest $request
     * 
     * @return \Illuminate\Http\Response
     */
    public function soycliente(SoyClienteRequest $request, SoyCliente $soycliente)
    {
        if ($soycliente->nif != $request->nif  || $soycliente->tlf != $request->tlf ) {

            return redirect()->to('soycliente')->withErrors([
                'nif' => 'The provided credentials do not match our records.',
                'tlf' => 'The provided credentials do not match our records.',
            ]);
        } 
        return redirect()->to('soycliente.index');
    }

      /**
     * Handle response after user authenticated
     * 
     * @param Request $request
     * @param Auth $user
     * 
     * @return \Illuminate\Http\Response
     */
    protected function authenticated(Request $request, $user) 
    {
        return redirect()->intended();
    }
}
