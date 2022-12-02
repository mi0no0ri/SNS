<?php

use Illuminate\Database\Seeder;
use App\Models\User;

class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        for ($i = 1; $i <= 10; $i++) {
            User::create([
                'username' => 'TEST' .$i,
                'mail' => 'test' .$i. '@test.com',
                'password' => Hash::make('12345678'),
                'images' => null,
                'created_at' => now(),
                'updated_at' => now(),
            ]);
        }
    }
}
