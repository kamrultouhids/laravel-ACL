<?php

namespace App\Http\Controllers\User;

use App\Model\Role;

use Illuminate\Http\Request;

use App\Http\Requests\RoleRequest;

use App\Http\Controllers\Controller;

use Illuminate\Support\Facades\Auth;


class RoleController extends Controller
{

    public function index()
    {
        $data = Role::all();
        return view('admin.user.role.index',compact('data'));
    }


    public function create()
    {
        return view('admin.user.role.form');
    }


    public function store(RoleRequest $request)
    {
        $input = $request->all();
        try{
            Role::create($input);
            $bug = 0;
        }
        catch(\Exception $e){
            $bug = $e->errorInfo[1];
        }

        if($bug == 0){
            return redirect()->route('add-role.index')->with('success', 'Role Successfully saved.');
        }else {
            return redirect('role')->with('error', 'Something Error Found !, Please try again.');
        }
    }


    public function edit($id)
    {
        $editModeData = Role::FindOrFail($id);
        return view('admin.user.role.form',compact('editModeData'));
    }


    public function update(RoleRequest $request,$id)
    {
          $data = Role::FindOrFail($id);
          $input = $request->all();
          try{
              $data->update($input);
              $bug = 0;
          }
          catch(\Exception $e){
              $bug = $e->errorInfo[1];
          }

          if($bug == 0){
              return redirect()->route('add-role.index')->with('success', 'Role Successfully Updated.');
          }else {
              return redirect()->back()->with('error', 'Something Error Found !, Please try again.');
          }
    }


    public function destroy($id)
    {
        try{
            $role = Role::FindOrFail($id);
            $role->delete();
            $bug = 0;
        }
        catch(\Exception $e){
            $bug = $e->errorInfo[1];
        }

        if($bug == 0){
            echo "success";
        }elseif ($bug == 1451) {
            echo 'hasForeignKey';
        } else {
            echo 'error';
        }
    }


}
