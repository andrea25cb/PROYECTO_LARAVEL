<?php

namespace App\Http\Controllers;
use App\Models\Client;
use Illuminate\Http\Request;
use App\Http\Requests\CuoteRequest;
use App\Models\Cuote;

class CuotesGController extends Controller
{
    public function create()
    {
        $clients = Client::select('id', 'name')->get();
        return view('cuotesg.create', compact('clients'));
    }

    public function store(CuoteRequest $request)
    {
        Cuote::create($request->validated()); 
            session()->flash('status','cuota creada!');

        return to_route('cuotes.index');
    }
}
