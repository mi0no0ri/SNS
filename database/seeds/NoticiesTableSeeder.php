<?php

use Illuminate\Database\Seeder;
use App\Models\Noticies;

class NoticiesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Noticies::create([
            'title' => 'お知らせ',
            'contents' => 'お知らせです。',
            'admin_id' => 1,
            'created_at' => now(),
            'updated_at' => now(),
        ]);
    }
}
