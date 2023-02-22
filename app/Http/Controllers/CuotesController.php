<?php

namespace App\Http\Controllers;
use App\Models\Cuote;
use App\Models\Client;
use Illuminate\Http\Request;
use App\Http\Requests\CuoteRequest;
use App\Http\Requests\CuoteAllRequest;
use Illuminate\Support\Facades\Mail;
use App\Mail\DemoMail;
use Barryvdh\DomPDF\Facade\Pdf as PDF;
class CuotesController extends Controller
{   public function index()
    {
        return view('cuotes.index', [
            'cuotes' => Cuote::paginate(3)
        ]);
    }
    public function create()
    {
        $clients = Client::select('id', 'name','email','cuotaMensual')->get();
        return view('cuotes.create', compact('clients'));
    }

    public function createAll()
    {
        // $clients = Client::select('id', 'name')->get();
        return view('cuotes.createall');
    }
    /**
    * Store a newly created resource in storage.
    *
    * @param  $request
    * @return 
    */
    public function store(CuoteRequest $request)
    {

        Cuote::create($request->validated()); 
            session()->flash('status','cuota creada!');
            $clients = Client::select('id', 'name','cuotaMensual','email')->get();
            // $cuotes = Cuote::select()->where('clients_id', '=', $clients->id)->first();
        
            // foreach ($cuotes as $cuote){  

            foreach ($clients as $client){
               // dd($client->email);
               $mailData = [
                'title' => '¡HOLA!',
                'body' => 'datos de la cuota',
                'id' => $client['id'],
                'name' => $client['name'],
                'email' => $client['email'],
                'cuentaCorriente' => $client['cuentaCorriente'],
                'cuotaMensual' => $client['cuotaMensual'],
                'concepto' => $request->concepto,
                'fecha' => $request->created_at,
                'importe' => $request->importe,
              ];

              $pdf = PDF::loadView('myPDF', $mailData);

       Mail::to($client->email)->send(new DemoMail($mailData,$pdf))
       ; //el email del cliente que elija en el formulario de crear cuota
         }
        // }
            
        return to_route('cuotes.index')->with('success','factura de cuota en pdf enviada a su cliente');
    }
    public function storeall(CuoteAllRequest $request)
    {
        $cuote = [];
        Cuote::create($request->validated()); 

        $clients = Client::select('id', 'name','cuotaMensual','email')->get();
        // alert($clients->email);
        foreach ($clients as $client){
            // dd($client->email);
            $data['concepto'] =$request->concepto;
            $data['importe'] =  $request->importe;
            $data['created_at'] =  $request->created_at;
            $data['pagada'] = $request->pagada;
            $data['fechaPago'] =  $request->fechaPago;
            $data['notas'] =  $request->notas;
            $data['clients_id'] = $client->id;
      
            array_push($cuote, $data);
            // if ($client->nif != $request->nif){

            // }
            
         Cuote::insert($cuote);

            $mailData = [
                'title' => '¡HOLA!',
                 'body' => 'datos de la cuota'.$request->importe,
                
              ];

              $pdf = PDF::loadView('myPDF', $mailData);
              Mail::to($client->email)->send(new DemoMail($mailData,$pdf))
              ; //el email del cliente que elija en el formulario de crear cuota
                }
    
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
        $clients = Client::select('id', 'name')->get();     
        return view('cuotes.edit', compact('cuote','clients'));
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
    $cuote->clients_id = $request->clients_id;
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