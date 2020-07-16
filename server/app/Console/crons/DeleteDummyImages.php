<?php
namespace App\Console\crons;

use Illuminate\Support\Facades\DB;

class DeleteDummyImages
{
    public function __invoke()
    {
        $images = DB::table('images')->whereNull('content_id')->get();
        foreach($images as $image){
            $path = $image->filepath.DIRECTORY_SEPARATOR.$image->filename;
            if(\File::exists($path)){
                \File::delete($path);
            }
            DB::table('images')->where('id',$image->id)->delete();
        }
    }
}
