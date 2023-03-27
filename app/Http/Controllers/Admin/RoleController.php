<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use Spatie\Permission\Models\Role;
use App\Http\Controllers\Controller;

class RoleController extends Controller
{
    public function index(){
        $roles=Role::all();
        return view('admin.role.index',compact('roles'));
    }

    public function create(){
        return view('admin.role.create');
    }

    public function store(Request $request){
        $data=$request->validate([
            'name'=>'required|unique:roles,name',
        ]);
       
        Role::create($data);
        return redirect()->route('roles')->with('message','Role Created Successfully');
    }
    public function edit($id){
        $role=Role::find($id);
        return view('admin.role.edit',compact('role'));
    }

    public function update(Request $request,$id){
      $data= $request->validate([
            'name'=>'required|unique:roles,name',
        ]);

        $role=Role::find($id);
        if($role){
            $role->update($data);
            return redirect()->route('roles')->with('message','Role Updated Successfully');
        }
        else{
            return redirect()->route('roles')->with('message','Something Went Wrong!');
         
        }

    }

    public function delete($id){
        $role=Role::find($id);
        if($role){
            $role->delete();
            return redirect()->route('roles')->with('message','Role Deleted Successfully');
        }
        else{
            return redirect()->route('roles')->with('message','Something Went Wrong!');
        }

    }
}
