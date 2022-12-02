<?php

use Illuminate\Database\Seeder;
use App\Models\Questions;

class QuestionsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Questions::create([
            'title' => 'よくある質問です',
            'contents' => 'テストです。',
            'admin_id' => 1,
            'created_at' => now(),
            'updated_at' => now(),
        ]);
    }
}
