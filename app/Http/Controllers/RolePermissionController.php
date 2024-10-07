<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;

class RolePermissionController extends Controller
{
    public function __construct(){
        $this->middleware('permission:role-list|role-create|role-edit|role-delete',['only'=>['index','show']]);
        $this->middleware('permission:role-create',['only'=>['create','store']]);
        $this->middleware('permission:role-edit',['only'=>['edit','update']]);
        $this->middleware('permission:role-delete',['only'=>['destory']]);
   }
   public function index(){
       $roles=Role::all();
       return view('admin.role-and-permission.list',compact('roles'));
   }
   public function create(){
       $permissions=Permission::all();
       return view('admin.role-and-permission.create',compact('permissions'));
   }

   public function store(Request $request){
       $request->validate([
           'name'=>'required|unique:roles,name',
           'permissions'=>'required|array',
       ]);
       $role=new Role();
       $role->name=$request->name;
       $role->save();
       $permissions=Permission::whereIn('id',$request->permissions)->pluck('name')->toArray();
       $role->syncPermissions($permissions);
   
       return redirect()->route('admin.roles-and-permission.index')->with('success','Roles has been created!');
   }

   public function show($id){
     
       $role=Role::find(base64_decode($id));
       if(!$role){
           return back()->with('error','Role data not found!');
       }
       return view('admin.role-and-permission.show',compact('role'));
   }
   public function edit($id){
       $role=Role::find(base64_decode($id));
       if(!$role){
        return back()->with('error','Data not found!');
       }
       $permissions=Permission::all();
       return view('admin.role-and-permission.edit',compact('permissions','role'));
   }

   public function update(Request $request,$id){
       $request->validate([
           'name'=>'required|unique:roles,name,'.$id,
           'permissions'=>'required|array',
       ]);

       $role=Role::find($id);
       if(!$role){
        return back()->with('error','Data not found!');
       }
       $role->name=$request->name;
       $role->save();
       $permissions=Permission::whereIn('id',$request->permissions)->pluck('name')->toArray();
       $role->syncPermissions($permissions);
       return redirect()->route('admin.roles-and-permission.index')->with('success','Role Data Updated');

   }

   public function destroy($id){
       $role=Role::find(base64_decode($id));
       if(!$role){
        return back()->with('error','Role not found!');
       }
       $role->delete();
       return back()->with('success','Role has been deleted');
   }
}
