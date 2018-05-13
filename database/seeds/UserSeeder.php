<?php

use Illuminate\Database\Seeder;

use Carbon\Carbon;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $time = Carbon::now();

        DB::table('user')->truncate();
        DB::table('user')->insert(
            [
                ['role_id' => 1,'user_name' => 'admin','password' => bcrypt('123'), 'remember_token' => str_random(10), 'status' => 1, 'created_by' => 1,'updated_by' => 1,'created_at' => $time, 'updated_at' => $time],
            ]
        );
        
    }
}
