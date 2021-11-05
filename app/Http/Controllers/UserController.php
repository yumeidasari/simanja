<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Http\Requests\UserRequest;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Carbon;


class UserController extends Controller
{
    /**  igM+oq3vEKMG  password addondomain
     * Display a listing of the users
     *
     * @param  \App\Models\User  $model
     * @return \Illuminate\View\View
     */
    //public function index(User $model)
	public function index()
    {
		//$semua_user = User::all();
		$semua_user = User::orderBy('id','DESC')->paginate(5);
        return view('users.index', compact('semua_user'));
        //return view('users.index', ['users' => $model->paginate(15)]);
    }
	
	public function create()
    {
        //$this->authorize('kelola-user');
        return view('users.create');
    }
	
	public function store(UserRequest $request)
    {
        //$this->authorize('kelola-user');
				
        $user = new User;  //--->> new Nama MOdel!!!!
        $user->name=$request->name;
        $user->email=$request->email;
        $user->password=Hash::make($request->password);
		$user->email_verified_at = Carbon::now();
        $user->save();
		//return response()->json(['data' => $user]);
        return redirect()->to('user')->with('message','Berhasil menambah User baru');
    }
	
	 public function edit($id)
    {
        //$this->authorize('kelola-user');
        $user=User::findOrFail($id);
        
        return view('users.edit',compact('user'));
    }
	
	public function update(Request $request, $id)
    {
        //$this->authorize('kelola-user');
		$user=User::findOrFail($id);
		        
        $user->name=$request->name;
        $user->email=$request->email;
        $user->password=Hash::make($request->password);
		//$user->email_verified_at = Carbon::now();
        $user->save();
		//return response()->json(['data' => $user]);
        return redirect()->to('user')->with('message','Berhasil Update data User');
    }
	
	public function destroy($id)
    {
       // $this->authorize('kelola-user');
        $user=User::findOrFail($id);
        $user->delete();
        return redirect()->to('user')->with('message','Berhasil Hapus data User');
    }

}
