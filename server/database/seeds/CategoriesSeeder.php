<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class CategoriesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('categories')->insert([
            'category' => 'BookSelling',
            'id' => 1,
            'use_trade' => 1,
            'use_comments' => 1,
            'use_book' => 1,
            'writable' => 1,
        ]);
        DB::table('categories')->insert([
            'category' => 'BookBuying',
            'id' => 2,
            'use_trade' => 1,
            'use_comments' => 1,
            'use_book' => 1,
            'writable' => 1,
        ]);
        DB::table('categories')->insert([
            'category' => 'BookReview',
            'id' => 3,
            'use_trade' => 0,
            'use_comments' => 1,
            'use_book' => 1,
            'writable' => 1,
        ]);
        DB::table('categories')->insert([
            'category' => 'QnA',
            'id' => 4,
            'use_comments' => 0,
            'use_trade' => 0,
            'use_book' => 0,
            'writable' => 0,
        ]);
    }
}
