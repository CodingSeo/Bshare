<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class UsersSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('users')->insert([
            'id' => 0,
            'name' => 'testuser',
            'email' => 'test@test.com',
            'password' => bcrypt('123456789a'),
            'password_bcrypt' => '123456789a'
        ]);
    }
}
