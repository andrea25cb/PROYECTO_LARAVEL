<?php

/** 
* @file CuotesController.php
* @author andrea cordon
* @date 28/02/2023
*/

namespace App\Http\Controllers;
use App\Models\Cuote;
use App\Models\Client;
use Illuminate\Http\Request;
use App\Http\Requests\CuoteRequest;
use App\Http\Requests\CuoteAllRequest;
use Illuminate\Support\Facades\Mail;
use App\Mail\DemoMail;
use Barryvdh\DomPDF\Facade\Pdf as PDF;
use Illuminate\Support\Facades\Config;
use PayPal\Api\Amount;
use PayPal\Api\Payer;
use PayPal\Api\Payment;
use PayPal\Api\PaymentExecution;
use PayPal\Api\RedirectUrls;
use PayPal\Api\Transaction;
use PayPal\Auth\OAuthTokenCredential;
use PayPal\Exception\PayPalConnectionException;
use PayPal\Rest\ApiContext;
class CuotesController extends Controller
/**
* @brief Display a listing of cuotes. GET|HEAD / cuotes / { id }. Default : id
* @return View with list of cuotes and pagination information. If there is a pagination information the view will return a JSON object with two keys :'cuotes'and'count '
*/
{   public function index()
    {
        return view('cuotes.index', [
            'cuotes' => Cuote::paginate(3)
        ]);
    }
    /**
    * @brief Show the form for creating a new cuota. GET / cuotes / create?cid = 1
    * @return Json response with list of
    */
    public function create()
    {
        $clients = Client::select('id', 'name','email','cuotaMensual')->get();
        return view('cuotes.create', compact('clients'));
    }

    /**
    * @brief [ Route ] Shows form to create all cuotes [ Route ] Handles GET / cuotes / createall
    * @return View to create all cuotes in the database or error if something goes wrong with the data sent to
    */
    public function createAll()
    {
        // $clients = Client::select('id', 'name')->get();
        return view('cuotes.createall');
    }
  
 
    /**
    * @brief Metodo responsavel por persistir la cuenta de un nuovo cuote.
    * @param $request
    * @return Si el usuario esta inserido devuelve un obj
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
    /**
    * @brief Metodo que permite guardar las cuentas del usuario en la base de datos
    * @param $request
    * @return Devuelve un objeto Cuote con los datos del usuario en la base de
    */
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
    * @brief Display the specified cuote. This is a view that allows the user to view the cuote and its details.
    * @param $cuote
    * @return The cuote view with the cuote details in JSON format or an error view if the cuote is not found
    */
    public function show(Cuote $cuote)
    {
    return view('cuotes.show',compact('cuote'));
    } 
   
    /**
    * @brief Show the form for editing the cuote. GET / cuotes / { id } / edit.
    * @param $cuote
    * @return View to edit the cuote and its clients in the database or to display a list of clients that have been added
    */
    public function edit(Cuote $cuote)
    {
        $clients = Client::select('id', 'name')->get();     
        return view('cuotes.edit', compact('cuote','clients'));
    }

    /**
    * @brief Metodo que actualiza el cuote en la base de datos. Parametros : Valores de la cual se desea actualizar los datos de la entidad que pertenece al modelo cuote
    * @param $request
    * @param $id
    * @return Si el usuario se encuentra logueado correctamente retorna un objeto HttpResponse con el mensaje de cu
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
    * @brief Remove the specified cuote from storage. DELETE / cuotes / { id } Response will be redirected to the'index'page.
    * @param $cuote
    * @return Redirects on successful deletion renders view otherwise ( unsuccess ) throws exception on failure or prints error message to standard
    */
    public function destroy(Cuote $cuote)
    {
        $cuote->delete();
        $cuote = Cuote::withTrashed()->get();
        return redirect()->route('cuotes.index')->with('delete', 'ok');
    }

    private $apiContext;

    /**
    * @brief Constructor for the PaypalApiContext class. Initializes the ApiContext and sets the configuration from the config
    */
    public function __construct()
    {
        $payPalConfig = Config::get('paypal');

        $this->apiContext = new ApiContext(
            new OAuthTokenCredential(
                $payPalConfig['client_id'],
                $payPalConfig['client_secret']
            )
        );

        // $this->apiContext->setConfig($payPalConfig['settings']);
    }


    /**
    * @brief Pays with PayPal. This is a controller action that allows you to make a payment with PayPal.
    * @param $id
    * @return The response to send back to the client after the payment is made. If there is an error the response will be redirected to the page that contains the error
    */
    public function payWithPayPal($id)
    {
        
        $payer = new Payer();
        $payer->setPaymentMethod('paypal');

        $amount = new Amount();
        $amount->setTotal(Cuote::find($id)->importe);
        $amount->setCurrency('USD');

        $transaction = new Transaction();
        $transaction->setAmount($amount);

        $callbackUrl = url('/paypal/status/'.$id);

        $redirectUrls = new RedirectUrls();
        $redirectUrls
            ->setReturnUrl($callbackUrl)
            ->setCancelUrl($callbackUrl);

        $payment = new Payment();
        $payment->setIntent('sale')
            ->setPayer($payer)
            ->setTransactions(array($transaction))
            ->setRedirectUrls($redirectUrls);

        try {
            $payment->create($this->apiContext);
            return redirect()->away($payment->getApprovalLink());
        } catch (PayPalConnectionException $ex) {
            echo $ex->getData();
        }
    }

    /**
    * @brief Este metodo permite realizar el proceso de pantalla en la pagina
    * @param $request
    * @param $id
    * @return Si el usuario se abre el proceso retorna un objeto HttpResponse del fichero de la vista escritura o null si hay algun error
    */
    public function payPalStatus(Request $request, $id)
    {
        
        $cuota = Cuote::find($id);
        // dd($cuota);
        $paymentId = $request->input('paymentId');
        $payerId = $request->input('PayerID');
        $token = $request->input('token');
        $id = $request->input('id');

        // Lo sentimos el pagofinalizado a través de PayPal no payer
        if (!$paymentId || !$payerId || !$token) {
            $status = 'Lo sentimos... El pago a través de PayPal no se pudo realizar.';
            return redirect()->route('cuotes.pagofinalizado',['id'=>$id])->with(compact('status'));
        }

        $payment = Payment::get($paymentId, $this->apiContext);

        $execution = new PaymentExecution();
        $execution->setPayerId($payerId);

        /** Execute the payment **/
        $result = $payment->execute($execution, $this->apiContext);

        // Metodo que se encarga el pagofinalizado.
        if ($result->getState() === 'approved') {
            $status = '¡Gracias! El pago a través de PayPal se ha realizado correctamente.';
            $cuota->pagada = 'S';
            $cuota->save();
            
            return to_route('cuotes.pagofinalizado')->with(compact('status'));
        }

        $status = 'Lo sentimos! El pago a través de PayPal no se pudo realizar.';
        return to_route('cuotes.index')->with(compact('status'));
    }

    /**
    * @brief Devuelve la vista del pago finalizado. This function is called when the user clicks the finalizado button.
    * @param $request
    * @return View para mostrar la vista del pago finalizado en el sistema
    */
    public function pagoFinalizado(Request $request)
{
    $status = $request->session()->get('status');
    return view('cuotes.pagofinalizado', compact('status'));
}
    }