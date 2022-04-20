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
        DB::table('posts')->insert([
            'created_at' => new DateTime(),
            'updated_at' => new DateTime(),
        ]);

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
