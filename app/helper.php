<?php

	use Illuminate\Support\Facades\DB;

	function dateConvertFormtoDB($date){
		if(!empty($date)){
			return date("Y-m-d",strtotime(str_replace('/','-',$date)));
		}
	}

	function dateConvertDBtoForm($date){
		if(!empty($date)){
			$date = strtotime($date);
			return date('d/m/Y', $date);
		}
	}

	function employeeInfo(){
        return DB::table('user')->where('user_id',session('logged_session_data.user_id'))->first();
    }

	function permissionCheck(){

		$role_id = session('logged_session_data.role_id');
		return $result =  json_decode(DB::table('menus')->select('menu_url')
						->join('menu_permission', 'menu_permission.menu_id', '=', 'menus.id')
						->where('menu_permission.role_id', '=', $role_id)
						->whereNotNull('action')->get()->toJson(),true);

	}

	function showMenu(){
        $role_id = session('logged_session_data.role_id');
        $modules = json_decode(DB::table('modules')->get()->toJson(), true);
        $menus =  json_decode(DB::table('menus')
            ->select(DB::raw('menus.id, menus.name, menus.menu_url, menus.parent_id, menus.module_id'))
            ->join('menu_permission', 'menu_permission.menu_id', '=', 'menus.id')
            ->where('menu_permission.role_id',$role_id)
            ->where('menus.status',1)
            ->whereNull('action')
            ->orderBy('module_group_id','ASC')
            ->get()->toJson(),true);
        $sideMenu = [];
        if($menus){
            foreach ($menus as $menu){
                if(!isset($sideMenu[$menu['module_id']])){
                    $moduleId = array_search($menu['module_id'], array_column($modules, 'id'));
                    if($menu['name'] !='') {
                        $sideMenu[$menu['module_id']] = [];
                        $sideMenu[$menu['module_id']]['id'] = $modules[$moduleId]['id'];
                        $sideMenu[$menu['module_id']]['name'] = $modules[$moduleId]['name'];
                        $sideMenu[$menu['module_id']]['icon_class'] = $modules[$moduleId]['icon_class'];
                        $sideMenu[$menu['module_id']]['menu_url'] = '#';
                        $sideMenu[$menu['module_id']]['parent_id'] = '';
                        $sideMenu[$menu['module_id']]['module_id'] = $modules[$moduleId]['id'];
                        $sideMenu[$menu['module_id']]['flag'] = "hasChildMenu";
                        $sideMenu[$menu['module_id']]['sub_menu'] = [];
                    }else{
                        $sideMenu[$menu['module_id']] = [];
                        $sideMenu[$menu['module_id']]['id'] = $modules[$moduleId]['id'];
                        $sideMenu[$menu['module_id']]['name'] = $modules[$moduleId]['name'];
                        $sideMenu[$menu['module_id']]['icon_class'] = $modules[$moduleId]['icon_class'];
                        $sideMenu[$menu['module_id']]['menu_url'] = $menu['menu_url'];
                        $sideMenu[$menu['module_id']]['flag'] = "noChildMenu";
                        $sideMenu[$menu['module_id']]['sub_menu'] = [];
                    }
                }
                if($menu['name'] !='') {
                    if ($menu['parent_id'] == 0) {
                        $sideMenu[$menu['module_id']]['sub_menu'][$menu['id']] = $menu;
                        $sideMenu[$menu['module_id']]['sub_menu'][$menu['id']]['sub_menu'] = [];
                    } else {
                        array_push($sideMenu[$menu['module_id']]['sub_menu'][$menu['parent_id']]['sub_menu'], $menu);
                    }
                }

            }
        }

        return $sideMenu;
    }


?>