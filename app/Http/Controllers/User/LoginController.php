<?php

namespace App\Http\Controllers\User;

use App\Model\Menu;
use App\Model\Module;
use Illuminate\Support\Facades\DB;
use Session;

use Illuminate\Http\Request;

use App\Http\Requests\LoginRequest;

use App\Lib\Enumerations\UserStatus;

use Illuminate\Support\Facades\Auth;

use App\Http\Controllers\Controller;


class LoginController extends Controller
{


    public function index()
    {
        if(Auth::check()){
            return redirect()->intended(url('/dashboard'));
        }
        return view('admin.login');
    }


    public function Auth(LoginRequest $request)
    {
        if (Auth::attempt(['user_name'=>$request->user_name,'password'=>$request->user_password])) {
            $userStatus = Auth::user()->status;
            if ($userStatus == UserStatus::$ACTIVE) {

                /*
                 *  menu session set
                 */
               $all_menu =  array_column(json_decode(Menu::select('menu_url')->where('status', 1)->where('menu_url','!=',null)->get()->toJson(), true),'menu_url');

                $permission_menu_for_sideber_show =  json_decode(Menu::select(DB::raw('menus.id, menus.name, menus.menu_url, menus.parent_id, menus.module_id'))
                    ->join('menu_permission', 'menu_permission.menu_id', '=', 'menus.id')
                    ->where('menu_permission.role_id',Auth::user()->role_id)
                    ->where('menus.status',1)
                    ->whereNull('action')
                    ->orderBy('module_group_id','ASC')
                    ->get()->toJson(),true);

                $modules = json_decode(Module::get()->toJson(), true);

                $permission_menu = array_column(json_decode(Menu::join('menu_permission', 'menu_permission.menu_id', '=', 'menus.id')
                    ->where('role_id', Auth::user()->role_id)
                    ->where('menu_url', '!=',null)
                    ->get()->toJson(), true),'menu_url');


                session()->put('modules', $modules);
                session()->put('menus', $permission_menu_for_sideber_show);
                session()->put('all_menus', $all_menu);
                session()->put('permission_menu', $permission_menu);

                return redirect()->intended(url('/dashboard'));
            } elseif ($userStatus == UserStatus::$INACTIVE) {
                Auth::logout();
                return redirect(url('/'))->withInput()->with('error','You are temporary blocked. please contact to admin');
            } else{
                Auth::logout();
                return redirect(url('/'))->withInput()->with('error','You are terminated. please contact to admin');
            }
        }else {
            return redirect(url('/'))->withInput()->with('error','User name or password does not matched');
        }
    }


    public function logout(){
        Auth::logout();
        Session::flush();
        return redirect(url('/'))->with('success','logout successful ..!');
    }


}
