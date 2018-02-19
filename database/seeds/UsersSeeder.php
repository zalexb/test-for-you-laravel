<?php

use Illuminate\Database\Seeder;

class UsersSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
        DB::table('users')->insert([
            'id'=>1,
            'username'=>'admin',
            'password'=>\Illuminate\Support\Facades\Hash::make('123'),
            'created_at' => date("Y-m-d H:i:s")
        ]);

    }
}
