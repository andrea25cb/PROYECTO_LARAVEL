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

    Route::group(['middleware' => ['auth']], function() {
        // Route::get('/tasks', 'TaskController@index')->name('tasks.index');
        // Route::post('/tasks/create', 'TaskController@create')->name('tasks.create');
        // Route::post('/tasks', 'TaskController@store')->name('tasks.store');
        // Route::get('/tasks/{id}', 'TaskController@show')->name('tasks.show');
        // Route::get('/tasks/{id}', 'TaskController@edit')->name('tasks.edit');
        // Route::delete('tasks/{id}', 'TaskController@destroy')->name('tasks.destroy');
        Route::resource('tasks', TaskController::class);
      
        // Route::get('/users', 'UsersController@index')->name('users.index');
        // Route::post('/users/create', 'UsersController@create')->name('users.create');
        // Route::post('/users', 'UsersController@store')->name('users.store');
        // Route::get('/users/{id}', 'UsersController@show')->name('users.show');
        // Route::get('/users/{id}', 'UsersController@edit')->name('users.edit');
        // Route::delete('users/{id}', 'UsersController@destroy')->name('users.destroy');
        Route::resource('users', UsersController::class);
        
        // Route::get('/clients', 'ClientsController@index')->name('clients.index');
        // Route::post('/clients/create', 'ClientsController@create')->name('clients.create');
        // Route::post('/clients', 'ClientsController@store')->name('clients.store');
        // Route::get('/clients/{id}', 'ClientsController@show')->name('clients.show');
        // Route::get('/clients/{id}', 'ClientsController@edit')->name('clients.edit');
        // Route::delete('clients/{id}', 'ClientsController@destroy')->name('clients.destroy');
        Route::resource('clients', ClientsController::class);

        
        // Route::get('/cuotes', 'CuotesController@index')->name('cuotes.index');
        // Route::post('/cuotes/create', 'CuotesController@create')->name('cuotes.create');
        // Route::post('/cuotes', 'CuotesController@store')->name('cuotes.store');
        // Route::get('/cuotes/{id}', 'CuotesController@show')->name('cuotes.show');
        // Route::delete('cuotes/{id}', 'CuotesController@destroy')->name('cuotes.destroy');
        Route::resource('cuotes', CuotesController::class);

        /**
         * Logout Routes
         */
        Route::get('/logout', 'LogoutController@perform')->name('logout.perform');
    });
});