<?php
namespace App\Console\crons;

use Illuminate\Support\Facades\DB;

class DeleteInActivePost
{
    public function __invoke()
    {
        DB::table('posts')->where('active',0)->delete();
    }
}
