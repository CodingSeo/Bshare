<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class CommentsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $amount = 50;
        for ($id = 1; $id <= $amount; $id++) {
            DB::table('comments')->insert([
                'id' => $id,
                'user_id' => 'test@test.com',
                'post_id' => $id,
                'body' => 'test comments'
            ]);
        }
        for ($id = 1; $id <= $amount; $id++) {
            DB::table('comments')->insert([
                'id' => $id+51,
                'user_id' => 'test@test.com',
                'post_id' => $id,
                'parent_id' => $id % 20 +1,
                'body' => 'test replies comments'
            ]);
        }
    }
}
