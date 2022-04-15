<?php

use Illuminate\Database\Seeder;
use App\Models\Post;

class PostsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // DB::table('users')->insert([
        //     [
        //     'username' => '未乗',
        //     'mail' => 'minori@gmail.com',
        //     'password' => '0314',
        //     'bio' => 'みのりです。',
        //     ],
        // ]);
        for($i = 1; $i <=10; $i++) {
            Post::create([
                'user_id'   =>$i,
                'post'      =>'これはテスト投稿' .$i,
                'created_at'=>now(),
                'updated_at'=>now()
            ]);
        }
    }
}
