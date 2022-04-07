<?php

use Illuminate\Database\Seeder;

class PostsTableSeeder extends Seeder
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
            [
            'username' => '未乗',
            'mail' => 'minori@gmail.com',
            'password' => '0314',
            'bio' => 'みのりです。',
            ],
        ]);
    }
}
