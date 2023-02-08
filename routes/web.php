<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Password;
use Illuminate\Auth\Events\PasswordReset;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;
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

      //** Password reset link request and reset routes*/ 
        Route::get('/forgot-password', function () {
        return view('auth.forgot-password');
        })->middleware('guest')->name('password.request'); 
        
        
        Route::get('/reset-password/{token}', function ($token) {
            return view('auth.reset-password', ['token' => $token]);
        })->middleware('guest')->name('password.reset');


        Route::post('/forgot-password', function (Request $request) {
            $request->validate(['email' => 'required|email']);
        
            $status = Password::sendResetLink(
                $request->only('email')
            );
        
            return $status === Password::RESET_LINK_SENT
                        ? back()->with(['status' => __($status)])
                        : back()->withErrors(['email' => __($status)]);
        })->middleware('guest')->name('password.email');

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
                        ? redirect()->route('tasks.index')->with('status', __($status))
                        : back()->withErrors(['email' => [__($status)]]);
        })->middleware('auth')->name('password.update');
       

        /**
        * Client Routes
         */
        Route::get('/soycliente', 'SoyClienteController@show')->name('soycliente.show');
        Route::post('/soycliente', 'SoyClienteController@soycliente')->name('soycliente.perform');
        
        
        /**
         * Login with Social Media:
         */
        Route::get('login/facebook', 'Auth\LoginFacebookController@redirect');
        Route::get('login/facebook/callback', 'Auth\LoginFacebookController@callback');

    });

    Route::group(['middleware' => 'admin'], function () {
        Route::get('/admin', 'AdminController@index');
       
    });

    //RUTAS ADMIN
     Route::group(['middleware' => ['admin']], function() {
     
        Route::resource('tasks', TaskController::class);

        Route::resource('tasksOper', TaskOperController::class);

        Route::resource('users', UsersController::class);

        Route::resource('clients', ClientsController::class);

        Route::resource('cuotes', CuotesController::class);
        // Route::get('cuotes', 'CuotesController@createall')->name('cuotes.createall');

        /**
         * Logout Routes
         */
        Route::get('/logout', 'LogoutController@perform')->name('logout.perform');
    });

    //RUTAS OPERARIO:
      Route::group(['middleware' => ['auth']], function() {
  
        // Route::resource('tasks', TaskController::class);

        Route::resource('tasksOper', TaskOperController::class);

        /**
         * Logout Routes
         */
        Route::get('/logout', 'LogoutController@perform')->name('logout.perform');
    });
});