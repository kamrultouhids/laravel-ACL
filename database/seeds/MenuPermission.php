<?php

use Illuminate\Database\Seeder;

class MenuPermission extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('menu_permission')->truncate();
        DB::table('menu_permission')->insert(
            [
                ['role_id' => 1,'menu_id' => 1],
                ['role_id' => 1,'menu_id' => 2],
                ['role_id' => 1,'menu_id' => 3],
                ['role_id' => 1,'menu_id' => 4],
                ['role_id' => 1,'menu_id' => 5],
                ['role_id' => 1,'menu_id' => 6],
                ['role_id' => 1,'menu_id' => 7],
                ['role_id' => 1,'menu_id' => 8],
                ['role_id' => 1,'menu_id' => 9],
                ['role_id' => 1,'menu_id' => 10],
                ['role_id' => 1,'menu_id' => 11],
            ]
        );
    }
}
