<?php
/** 
* @file UsersController.php
* @author andrea cordon
* @date 28/02/2023
*/
namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use App\Http\Requests\RegisterRequest;
use App\Http\Requests\UpdateUserRequest;
use Yajra\DataTables\DataTables;

class UsersController extends Controller
{
    /**
     * Display all users with datatable
     * 
     */
    public function index(Request $request)
    {
        if ($request->ajax()) {
            $data = User::latest()->get();
            return Datatables::of($data)
                ->addIndexColumn()
                ->addColumn('action', function($row){
                    $btn = '<button href="javascript:void(0)" class="btn btn-info btn-sm open-modal" data-original-title="Edit" value="'.$row->id.'">Edit</button>';
                    $btn = $btn.' <button href="javascript:void(0)" data-id="'.$row->id.'" data-original-title="Delete" class="btn btn-danger btn-sm deletePost">Delete</button>';
                    $btn = $btn.' <button href="javascript:void(0)" class="btn btn-warning btn-sm show-modal" data-id="'.$row->id.'" data-original-title="Show">Show</button>';

                     return $btn;
                })
                ->rawColumns(['action'])
                ->make(true);
        }
        $users = User::all();

        return view('users.index')->with('users', $users);
       
    }

    /**
     * Show form for creating user
     * 
     * 
     */
    public function create() 
    {
        return view('users.create');
    }

    /**
     * Store a newly created user
     * 
     * @param User $user
     * @param RegisterRequest $request
     * 
     *
     */
     public function store(RegisterRequest $request)
     {
         User::updateOrCreate(['id' => $request->id],
                 ['nif' => $request->nif, 'name' => $request->name,'username' => $request->username, 'direccion' => $request->direccion, 'email' => $request->email, 'tlf' => $request->tlf, 'password' => $request->password, 'tipo' => $request->tipo]);        
    
         return response()->json(['success'=>'user saved successfully.']);
     }

    /**
     * Show user data
     * 
     * @param User $user
     * 
     * @return \Illuminate\Http\Response
     */
    public function show(User $user)
    {
    return view('users.show',compact('user'));
    } 

    public function edit($id)
    {
        $user = User::find($id);
        return response()->json($user);
    }

    /**
     * Update user data
     * 
     * @param User $user
     * @param UpdateUserRequest $request
     * 
     *
     */
    public function update(UpdateUserRequest $request, $id)
    {
        // $user =User::where('id',$id)->first();
        $user = User::find($id);
        $user->nif = $request->nif;
        $user->name = $request->name;
        $user->username = $request->username;
        $user->direccion = $request->direccion;
        $user->email = $request->email;
        $user->tlf = $request->tlf;
        $user->password = $request->password;
        $user->created_at = $request->created_at;
        $user->tipo = $request->tipo;
        $user->save();
        return response()->json($user);
    }

     /**
     * Delete user data
     * 
     * @param User $user
     * 
     *
     */

    public function destroy($id)
    {
        $user =User::where('id',$id)->withTrashed()->first();

        if ($user != null) {
            $user->delete();
        }
        return response()->json(['success'=>'User deleted successfully.']);
    }
}
