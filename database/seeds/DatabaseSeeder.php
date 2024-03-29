<?php

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        // $this->call(UsersTableSeeder::class);
        $this->call([
            UsersTableSeeder::class,
            PostsTableSeeder::class,
            FollowersTableSeeder::class,
            AdminsTableSeeder::class,
            FavoritesTableSeeder::class,
            BlocksTableSeeder::class,
            NoticiesTableSeeder::class,
            QuestionsTableSeeder::class,
        ]);
    }
}
