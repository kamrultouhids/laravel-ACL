<?php

use Illuminate\Database\Seeder;

use Carbon\Carbon;

class RoleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $time = Carbon::now();
        DB::table('role')->truncate();
        DB::table('role')->insert(
            [
                ['role_name' => 'Super Admin','created_at'=>$time,'updated_at'=>$time],
                ['role_name' => 'Admin','created_at'=>$time,'updated_at'=>$time],
                ['role_name' => 'HR','created_at'=>$time,'updated_at'=>$time],
                ['role_name' => 'Accounts','created_at'=>$time,'updated_at'=>$time],
                ['role_name' => 'Developer','created_at'=>$time,'updated_at'=>$time],
            ]

        );
    }
}
