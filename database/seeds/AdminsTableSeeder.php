<?php

use Illuminate\Database\Seeder;
use App\Models\Admin;

class AdminsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        for ($i = 1; $i <= 10; $i++) {
            Admin::create([
                'name'      =>'ADMIN' .$i,
                'email'          =>'admin' .$i. '@test.com',
                'password'      =>Hash::make('12345678'),
                'images'        =>'https://placehold.jp/50×50.png',
                'created_at'    =>now(),
                'updated_at'     =>now(),
            ]);
        }
    }
}
