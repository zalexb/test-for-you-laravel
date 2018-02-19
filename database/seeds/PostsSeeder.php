<?php

use Illuminate\Database\Seeder;

class PostsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
        DB::table('posts')->insert([
            'id'=>1,
            'title'=>'My post',
            'description'=>'PHP is a server-side programming language that is used in conjunction with HTML to enhance the features of a website. So what can you do with PHP? Here are 10 fun and useful things you can use PHP for on your website. ',
            'user_id'=>1,
            'created_at' => date("Y-m-d H:i:s")
        ]);
    }
}
