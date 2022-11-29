<?php

use Illuminate\Database\Seeder;
use App\Models\Favorite;

class FavoritesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        for ($i = 1; $i <= 10; $i++) {
            Favorite::create([
                'user_id'      =>$i,
                'post_id'      =>$i,
                'created_at'    =>now(),
                'updated_at'     =>now(),
            ]);
        }
    }
}
