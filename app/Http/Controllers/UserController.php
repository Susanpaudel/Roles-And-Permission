<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Spatie\Permission\Models\Role;

class UserController extends Controller
{
    public function __construct(){
         $this->middleware('permission:user-list',['only'=>['index','show']]);
         $this->middleware('permission:user-create',['only'=>['create','store']]);
         $this->middleware('permission:user-edit',['only'=>['edit','update']]);
         $this->middleware('permission:user-delete',['only'=>['destory']]);
    }
    public function index(){
        $users=User::all();
        return view('admin.users.list',compact('users'));
    }
    public function create(){
        $roles=Role::all();
        return view('admin.users.create',compact('roles'));
    }

    public function store(Request $request){
        $request->validate([
            'name'=>'required',
            'email'=>'required|email|unique:users,email',
            'roles'=>'required|array',
            'password'=>'required',
        ]);
        $user=new User();
        $user->name=$request->name;
        $user->email=$request->email;
        $user->password=bcrypt($request->password);
        $user->save();
        //take name from role table
        $roles = Role::whereIn('id', $request->roles)->pluck('name')->toArray();
        $user->assignRole($roles);
    
        return redirect()->route('admin.users.index')->with('success','User has been created!');
    }

    public function show($id){
      
        $user=User::find(base64_decode($id));
        if(!$user){
            return back()->with('error','User data not found!');
        }
        return view('admin.users.show',compact('user'));
    }
    public function edit($id){
        $user=User::find(base64_decode($id));
        if(!$user){
            return back()->with('error','Data not found!');
        }
        $roles=Role::all();
        return view('admin.users.edit',compact('roles','user'));
    }

    public function update(Request $request,$id){
        $request->validate([
            'name'=>'required',
            'email'=>'required|email|unique:users,email,'.base64_decode($id),
            'roles'=>'required|array',
            'password'=>'nullable',
        ]);

        $user=User::find(base64_decode($id));
        if(!$user){
            return back()->with('error','Data not found!');
        }
        $user->name=$request->name;
        $user->email=$request->email;
        if($request->password){
            $user->password=bcrypt($request->password);
        }
        $user->save();
        DB::table('model_has_roles')->where('model_id',base64_decode($id))->delete();
        
        $roles = Role::whereIn('id', $request->roles)->pluck('name')->toArray();
        $user->assignRole($roles);

        return redirect()->route('admin.users.index')->with('success','User Data Updated');

    }

    public function destroy($id){
        $user=User::find(base64_decode($id));
        if(!$user){
            return back()->with('error','Data not found!');
        }
        DB::table('model_has_roles')->where('model_id',base64_decode($id))->delete();
        $user->delete();
        return back()->with('success','User has been deleted');
    }
}
