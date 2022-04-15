<?php

use Illuminate\Database\Seeder;
use App\Models\Follow;

class FollowersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        for ($i = 2; $i <= 10; $i++){
            Follow::create([
                'follow_id'     =>$i,
                'follower_id'   =>1,
            ]);
        }
    }
}
