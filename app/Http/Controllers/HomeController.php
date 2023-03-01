<?php
/** 
* @file HomeController.php
* @author andrea cordon
* @date 28/02/2023
*/
namespace App\Http\Controllers;

use Illuminate\Http\Request;


class HomeController extends Controller
{
    /**
    * @brief Display a listing of the resource. GET / api / v1 / { id } is the id of the resource. POST / api / v1 / { id } is the id of the resource.
    * @return View to display the index page of the resource. GET / api / v1 / { id } is the id of the resource
    */
    public function index() 
    {
        return view('home.index');
    }
}
