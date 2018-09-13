<?php

namespace App\Http\Controllers\User;

use App\Model\Menu;
use App\Model\Module;
use App\Model\Role;

use Illuminate\Http\Request;

use Illuminate\Support\Facades\Auth;
use function MongoDB\BSON\toJSON;

use Illuminate\Support\Facades\DB;

use App\Http\Controllers\Controller;

use App\Http\Requests\RolePermissionRequest;


class RolePermissionController extends Controller
{

    public function index()
    {
        $roleList = Role::pluck('role_name','role_id');
        return view('admin.user.role.add_user_permission', ['data' => $roleList]);
    }


    public function getAllMenu(Request $request)
    {
        $role_id     = $request->role_id;
        $permissions =  json_decode(DB::table('menus')
                        ->select(DB::raw('menus.id, menus.name, menus.menu_url, menus.parent_id, menus.module_id,menu_permission.menu_id'))
                        ->join('menu_permission', 'menu_permission.menu_id', '=', 'menus.id')
                        ->where('menu_permission.role_id', '=', $role_id)
                        ->get()->toJson(),true);


        $allMenus = json_decode(DB::table('menus')
                    ->select(DB::raw('menus.*,modules.name as moduleName,modules.icon_class'))
                    ->join('modules', 'modules.id', '=', 'menus.module_id')
                    ->where('menus.status', '=', 1)
                    ->whereNotNull('menu_url')
                    ->get()->toJSON(),true);

        $arrayFormat = [];
        $subMenu = [];

        foreach ($allMenus as $allMenu)
        {
            $hasPermission = array_search($allMenu['id'], array_column($permissions, 'menu_id'));

            if(gettype($hasPermission) == 'integer'){
                $allMenu['hasPermission'] ='yes';
            }else{
                $allMenu['hasPermission'] ='no';
            }

            if(!empty($allMenu['action'])){
                $subMenu[$allMenu['parent_id']][] = $allMenu;
            }

            if(empty($allMenu['name'])){
                $allMenu['name'] = $allMenu['moduleName'];
                $arrayFormat[$allMenu['moduleName']][$allMenu['moduleName']] = $allMenu;
            }

            if($allMenu['action']=='' && $allMenu['name'] !=''){
                $arrayFormat[$allMenu['moduleName']][$allMenu['name']] = $allMenu;
            }
        }
        return ['arrayFormat'=>$arrayFormat,'subMenu'=>$subMenu];
    }


    public function store(RolePermissionRequest $request)
    {

        try{
            DB::beginTransaction();

                $role_id    =  $request->role_id;
                DB::table('menu_permission')->where('role_id', '=', $role_id)->delete();
                $menu       = count($request->menu_id);

                if($menu == 0)
                {
                    DB::commit();
                    return redirect()->back()->with('success', 'Role permission update successfully');
                }

                for ($i = 0; $i < $menu; $i++)
                {
                    $getParentId = DB::table('menus')->where('id','=',$request->menu_id[$i])->first();
                    if($getParentId->parent_id !=0)
                    {
                        $checkParentMenuDuplicate = DB::table('menu_permission')->where('role_id',$role_id)->where('menu_id',$getParentId->parent_id)->first();
                        if(!$checkParentMenuDuplicate)
                        {
                            $insertParentMenu = array(
                                "menu_id" => $getParentId->parent_id,
                                "role_id" => $role_id,
                            );
                            DB::table('menu_permission')->insert($insertParentMenu);
                        }
                    }
                    $insertMenu = array(
                        "menu_id" => $request->menu_id[$i],
                        "role_id" => $role_id,
                    );
                    DB::table('menu_permission')->insert($insertMenu);
                }
            $this->reset_session();
            DB::commit();
            $bug = 0;
        }
        catch(\Exception $e){
            DB::rollback();
            $bug = $e->errorInfo[1];
        }

        if($bug == 0){
            return redirect()->back()->with('success', 'Role Permission Update Successfully');
        } else {
            return redirect()->back()->with('error', 'Something Error Found !, Please try again.');
        }

    }

    public function reset_session()
    {
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
    }

    public function back_to_home()
    {
        $this->reset_session();
        return redirect('dashboard');
    }


}
