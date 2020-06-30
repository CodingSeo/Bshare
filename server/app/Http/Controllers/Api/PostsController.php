<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\PostsRequest;
use Illuminate\Support\Facades\DB;
use App\Transformers\PostTransformer;

use App\Category;
use App\Post;
use App\Content;

class PostsController extends Controller
{
    public function show(Post $post)
    {
        return (new PostTransformer) -> withItem($post);
    }
    public function show($index){
        $post = Post::find($index);
        return (new PostTransformer)->withItem($post);
    }

    public function store(PostsRequest $request)
    {
        $post = new Post;
        $content = new Content;
        $post -> fill($request->all());
        $content->body = $request->body;
        DB::beginTransaction();
        $post ->save();
        $content->post_id = $post->id;
        $content->save();
        DB::commit();
        return (new PostTransformer) -> withItem($post);
    }

    public function update(Post $post, PostsRequest $request)
    {
        DB::beginTransaction();
        $post ->update($request->all());
        $post ->content()->update([
            'body'=>$request->body
        ]);
        DB::commit();
        return (new PostTransformer) -> withItem($post);
    }

    public function destroy(Post $post)
    {
        $post->delete();
        return (new PostTransformer) -> withItem($post);
    }
}
