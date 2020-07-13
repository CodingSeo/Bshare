<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class PostsSeeder extends Seeder
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
            DB::table('posts')->insert([
                'id' => $id,
                'user_id' => 'test@test.com',
                'category_id' => $id % 4 + 1,
                'active' => 1,
                'title' => 'posts_test' . $id,
                'trade_status'=> ($id % 4 + 1 == 2 || $id % 4 + 1 == 3)?  'ongoing':null,
            ]);
        }
        for ($id = 1; $id <= $amount; $id++) {
            DB::table('contents')->insert([
                'post_id' => $id,
                'body' => 'posts_test' . $id . '_content',
            ]);
        }
    }
}
