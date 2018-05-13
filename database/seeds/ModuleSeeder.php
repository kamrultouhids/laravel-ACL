<?php

use Illuminate\Database\Seeder;


class ModuleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('modules')->truncate();
        DB::table('modules')->insert(
            [
                ['name' => 'Administration','icon_class' => 'mdi mdi-contacts'],
                ['name' => 'User','icon_class' => 'mdi mdi-account-alert'],
            ]
        );
    }
}
