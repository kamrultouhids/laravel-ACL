<?php

namespace App\Http\Controllers\User;

use App\User;

use App\Model\Role;

use Illuminate\Http\Request;

use App\Http\Requests\UserRequest;

use Illuminate\Support\Facades\DB;

use App\Http\Controllers\Controller;

use Illuminate\Support\Facades\Auth;

use Illuminate\Support\Facades\Hash;


class UserController extends Controller
{

    public function index()
    {
        $allUsers = User::with('role')->orderBy('user_id', 'desc')->get();
        return view('admin.user.user.index',['data'=>$allUsers]);
    }


    public function create()
    {
        $roleList = Role::pluck('role_name','role_id');
        return view('admin.user.user.add_user',['data'=>$roleList]);
    }


    public function store(UserRequest $request)
    {

        unset($request['password_confirmation']);
        $input                  = $request->all();
        $input['password']      = Hash::make($input['password']);
        $input['created_by']    = Auth::user()->user_id;
        $input['updated_by']    = Auth::user()->user_id;

        try{
            User::create($input);
            $bug = 0;
        }
        catch(\Exception $e){
            $bug = $e->errorInfo[1];
        }

        if($bug == 0){
            return redirect()->route('user.index')->with('success', 'User successfully saved.');
        } else {
            return redirect('user')->with('error', 'Something error found !, Please try again.');
        }
    }


    public function edit($id)
    {
        $roleList = Role::pluck('role_name','role_id');
        $editModeData   = User::FindOrFail($id);
        return view('admin.user.user.edit_user',['data'=>$roleList,'editModeData'=>$editModeData]);
    }


    public function update(UserRequest $request, $id)
    {

        $data                = User::FindOrFail($id);
        $input               = $request->all();
        $input['created_by'] = Auth::user()->user_id;
        $input['updated_by'] = Auth::user()->user_id;

        try{
            $data->update($input);
            $bug = 0;
        }
        catch(\Exception $e){
            $bug = $e->errorInfo[1];
        }

        if($bug==0){
            return redirect()->route('user.index')->with('success', 'User successfully updated.');
        } else {
            return redirect()->back()->with('error', 'Something error found !, Please try again.');
        }
    }


    public function destroy($id)
    {
        try{
            $user = User::FindOrFail($id);
            $user->delete();
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
