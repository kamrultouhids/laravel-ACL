<?php

use Illuminate\Database\Seeder;

class MenuSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('menus')->truncate();
        DB::table('menus')->insert(
            array
            (
                /**
                 *
                 * @user management
                 *
                 */
                array('parent_id' => 0,'action'=>NULL,'name'  => 'Manage Role', 'menu_url'  => NULL, 'module_id'  => '1', 'status'  => '1','module_group_id'=>'1.1'),
                array('parent_id' => 1,'action'=>NULL,'name'  => 'Add Role', 'menu_url'  => 'add-role.index', 'module_id'  => '1', 'status'  => '1','module_group_id'=>'1.2'),
                array('parent_id' => 2,'action'=> 2,'name'  => 'Add', 'menu_url'  => 'add-role.create', 'module_id'  => '1', 'status'  => '1','module_group_id'=>'1.3'),
                array('parent_id' => 2,'action'=> 2,'name'  => 'Edit', 'menu_url'  => 'add-role.edit', 'module_id'  => '1', 'status'  => '1','module_group_id'=>'1.4'),
                array('parent_id' => 2,'action'=> 2,'name'  => 'Delete', 'menu_url'  => 'add-role.destroy', 'module_id'  => '1', 'status'  => '1','module_group_id'=>'1.5'),

                array('parent_id' => 1,'action'=>NULL,'name'  => 'Add Role Permission', 'menu_url'  => 'permission.index', 'module_id'  => '1', 'status'  => '1','module_group_id'=>'1.5'),
                array('parent_id' => 0,'action'=>NULL,'name'  => 'Change Password', 'menu_url'  => 'changePassword.index', 'module_id'  => '1', 'status'  => '1','module_group_id'=>'1.6'),

                array('parent_id' => 0,'action'=>NULL,'name'  => '', 'menu_url'  => 'user.index', 'module_id'  => '2', 'status'  => '1','module_group_id'=>'2'),
                array('parent_id' => 8,'action'=> 8,'name'  => 'Add', 'menu_url'  => 'user.create', 'module_id'  => '1', 'status'  => '1','module_group_id'=>'2.1'),
                array('parent_id' => 8,'action'=> 8,'name'  => 'Edit', 'menu_url'  => 'user.edit', 'module_id'  => '1', 'status'  => '1','module_group_id'=>'2.3'),
                array('parent_id' => 8,'action'=> 8,'name'  => 'Delete', 'menu_url'  => 'user.destroy', 'module_id'  => '1', 'status'  => '1','module_group_id'=>'2.4'),

            )
        );

    }
}
