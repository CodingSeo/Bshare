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
                'user_id' => 'test@test',
                'category_id' => $id % 3 + 1,
                'active' => 1,
                'title' => 'posts_test' . $id,
            ]);
            DB::table('contents')->insert([
                'post_id' => $id,
                'body' => 'posts_test' . $id . '_content'
            ]);
        }
    }
}
