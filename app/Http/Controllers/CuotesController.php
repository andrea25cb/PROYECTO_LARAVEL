<?php

namespace App\Http\Controllers;
use App\Models\Cuote;
use App\Models\Task;
use Illuminate\Http\Request;
use App\Http\Requests\CuoteRequest;
class CuotesController extends Controller
{   public function index()
    {
        return view('cuotes.index', [
            'cuotes' => Cuote::paginate(3)
        ]);
    }
    public function create()
    {
        $tasks = Task::select('id', 'name')->get();
        
        return view('cuotes.create', compact('tasks'));
    }
    /**
    * Store a newly created resource in storage.
    *
    * @param  \Illuminate\Http\CuoteRequest  $request
    * @return \Illuminate\Http\Response
    */
    public function store(CuoteRequest $request)
    {
        Cuote::create($request->validated()); 
            session()->flash('status','cuota creada!');

        return to_route('cuotes.index');
    }
    
    /**
    * Display the specified resource.
    *
    * @param  \App\Models\Cuote  $cuote
    * @return \Illuminate\Http\Response
    */
    public function show(Cuote $cuote)
    {
    return view('cuotes.show',compact('cuote'));
    } 
    /**
    * Show the form for editing the specified resource.
    *
    * @param  \App\Models\Cuote  $cuote
    * @return \Illuminate\Http\Response
    */
    public function edit(Cuote $cuote)
    {
        $tasks = Task::select('id', 'name')->get();
        
        return view('cuotes.edit', compact('tasks'));
    }
    /**
    * Update the specified resource in storage.
    *
    * @param  \Illuminate\Http\Request  $request
    * @param  \App\Models\Cuote  $cuote
    * @return \Illuminate\Http\Response
    */
    public function update(CuoteRequest $request, $id)
    {
    $cuote = Cuote::find($id);
    $cuote->concepto = $request->concepto;
    $cuote->importe = $request->importe;
    $cuote->pagada = $request->pagada;
    $cuote->fechaPago = $request->fechaPago;
    $cuote->notas = $request->notas;
    $cuote->tasks_id = $request->tasks_id;
    $cuote->save();
    return redirect()->route('cuotes.index')->with('success','cuote has been updated successfully');
    }
    /**
    * Remove the specified resource from storage.
    *
    * @param  \App\Models\Cuote $cuote
    * @return \Illuminate\Http\Response
    */
    public function destroy(Cuote $cuote)
    {
        $cuote->delete();
        $cuote = Cuote::withTrashed()->get();
        return redirect()->route('cuotes.index')->with('delete', 'ok');
    }
    }
