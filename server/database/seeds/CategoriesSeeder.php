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
            'trade_info' => 1,
            'book_info' => 1,
        ]);
        DB::table('categories')->insert([
            'category' => 'BookBuying',
            'trade_info' => 1,
            'book_info' => 1,
        ]);
        DB::table('categories')->insert([
            'category' => 'BookReview',
            'trade_info' => 0,
            'book_info' => 1,
        ]);
        DB::table('categories')->insert([
            'category' => 'QnA',
            'trade_info' => 0,
            'book_info' => 0,
        ]);
    }
}
