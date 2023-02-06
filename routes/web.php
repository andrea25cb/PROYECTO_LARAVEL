<?php

use Illuminate\Support\Facades\Route;

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