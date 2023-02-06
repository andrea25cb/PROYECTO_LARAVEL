<?php

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
