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
            'email' => 'test@test',
            'password' => bcrypt(12345678),
            'password_bcrypt' => 12345678
        ]);
    }
}
