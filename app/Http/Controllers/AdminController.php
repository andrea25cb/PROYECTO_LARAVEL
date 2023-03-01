<?php

/** 
* @file AdminController.php
* @author andrea cordon
* @date 28/02/2023
*/

namespace App\Http\Controllers;

use App\Models\Task;
use Illuminate\Http\Request;

class AdminController extends Controller
{
    public function __construct(){
        $this->middleware('admin');
    }

    public function index()
    {
    //     return view('tasks.index', [
    //         'tasks' => Task::paginate(3)
    //     ]);
     }
}
