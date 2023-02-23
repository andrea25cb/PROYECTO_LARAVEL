<?php
use Illuminate\Support\Facades\Mail;
use App\Mail\DemoMail;

use App\Http\Controllers\Auth\GoogleSocialiteController;
use App\Http\Controllers\Auth\GithubSocialiteController;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Laravel\Socialite\Facades\Socialite;
use Illuminate\Support\Facades\Route;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Password;
use Illuminate\Auth\Events\PasswordReset;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;
 
use App\Http\Controllers\MailController;
  
use App\Http\Controllers\PDFController;
/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/
Route::group(['namespace' => 'App\Http\Controllers'], function()
{   
    /**
     * Home Routes
     */
    Route::get('/', 'HomeController@index')->name('home.index');

    Route::group(['middleware' => ['guest']], function() {
        /**
         * Register Routes
         */
        Route::get('/register', 'RegisterController@show')->name('register.show');
        Route::post('/register', 'RegisterController@register')->name('register.perform');

        /**
         * Login Routes
         */
        Route::get('/login', 'LoginController@show')->name('login.show');
        Route::post('/login', 'LoginController@login')->name('login.perform');
        
        /**
         * LOGIN WITH GOOGLE: 
         * */
        Route::get('/auth/redirect', function () {
            return Socialite::driver('google')->redirect();
        })->name('login-google');

        Route::get('/auth/callback', [GoogleSocialiteController::class, 'handleCallback']);
        
  /**
         * LOGIN WITH GITHUB: 
         * */
        Route::get('auth/github', [GithubSocialiteController::class, 'gitRedirect']);
        Route::get('auth/github/callback', [GithubSocialiteController::class, 'handleCallback']);

            
    /** Password reset link request and reset routes*/ 
        Route::get('/forgot-password', function () {
        return view('auth.forgot-password');
        })->middleware('guest')->name('password.request'); 
        
           /**lleva a la vista de reset password:*/
        Route::get('/reset-password/{token}', function ($token) {
            return view('auth.reset-password', ['token' => $token]);
        })->middleware('guest')->name('password.reset');
       
        /**lleva a la vista que enviará el email*/
        Route::post('/forgot-password', function (Request $request) {
            $request->validate(['email' => 'required|email']);
        
            $status = Password::sendResetLink(
                $request->only('email')
            );
        
            return $status === Password::RESET_LINK_SENT
                        ? back()->with(['status' => __($status)])
                        : back()->withErrors(['email' => __($status)]);
        })->middleware('guest')->name('password.email');


        /** Formulario para cambiar la contraseña:
         * no funciona:*/ 
        Route::post('/reset-password', function (Request $request) {
            $request->validate([
                'token' => 'required',
                'email' => 'required|email',
                'password' => 'required|min:8|confirmed',
            ]);
 
            $status = Password::reset(
                $request->only('email', 'password', 'password_confirmation', 'token'),
                function ($user, $password) {
                    $user->forceFill([
                        'password' => Hash::make($password)
                    ])->setRememberToken(Str::random(60));
                    $user->save();
                    event(new PasswordReset($user));
                }
            );
        
            return $status === Password::PASSWORD_RESET
                        ? redirect()->route('login.show')->with('status', __($status))
                        : back()->withErrors(['email' => 'The provided credentials do not match our records.']);
        })->middleware('auth')->name('password.update');
        // FIN de formulario para cambiar la contraseña.
     
        /**
        * Rutas del cliente
         */
       
        // vista login
        Route::get('/soycliente', 'SoyClienteController@index')->name('soycliente.index');
        // // comprueba login es correcto:
        Route::post('/soycliente', 'SoyClienteController@create')->name('soycliente.create');
        // // si login es correcto, mostrar menu del cliente que haga login, con sus cuotas/tareas
        // Route::get('/soyclienteMenu', 'SoyClienteController@show')->name('soycliente.show');
        // // el cliente pueda crear una nueva tarea:
        // Route::get('/soyclienteTarea', 'SoyClienteController@create')->name('soycliente.create');

        Route::post('/soyclienteTarea', 'SoyClienteController@store')->name('soycliente.store');
        
        Route::resource('soyCliente', SoyClienteController::class);

        // Route::get('/paypal/pay', 'CuotesController@payWithPayPal')->name('cuotes.payWithPayPal');
        // Route::get('/paypal/status', 'CuotesController@payPalStatus')->name('cuotes.payPalStatus');

    });

    Route::group(['middleware' => 'admin'], function () {
        Route::get('/admin', 'AdminController@index');
       
    });

    /** 
     * RUTAS ADMIN:
     */
     Route::group(['middleware' => ['admin']], function() {
        
        Route::get('allcuotes', 'CuotesController@createall')->name('cuotes.createall');
        Route::post('allcuotes', 'CuotesController@storeall')->name('cuotes.storeall');

        Route::get('/paypal/pay/{id}', 'CuotesController@payWithPayPal')->name('cuotes.payWithPayPal');
        Route::get('/paypal/status/{id}', 'CuotesController@payPalStatus')->name('cuotes.payPalStatus');
        Route::get('/paypal/final', 'CuotesController@pagoFinalizado')->name('cuotes.pagofinalizado');

        Route::resource('tasks', TaskController::class);

        Route::resource('tasksOper', TaskOperController::class);

        Route::resource('users', UsersController::class);
        
        Route::resource('clients', ClientsController::class);

        Route::resource('cuotes', CuotesController::class);

        Route::resource('misdatos', MisdatosController::class);



        /**
         * Logout Routes
         */
        Route::get('/logout', 'LogoutController@perform')->name('logout.perform');
    });

    /** 
     * RUTAS OPERARIO: 
     */
      Route::group(['middleware' => ['auth']], function() {
        
        Route::get('pendientes', 'TaskOperController@pendientes')->name('tasksOper.pendientes');
        Route::resource('tasksOper', TaskOperController::class);
        Route::resource('misdatos', MisdatosController::class);

        /**
         * Logout Routes
         */
        Route::get('/logout', 'LogoutController@perform')->name('logout.perform');
    }); 
     
        /**VUE CDN: */
        Route::get('/landing-cdn', function () {
            return view('vuecdn');
        })->name('landing-cdn');

        Route::get('/landing-vue', function () {
            return view('vue');
        })->name('landing-vue');

});   

        