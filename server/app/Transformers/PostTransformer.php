<?php

namespace App\Transformers;

use App\DTO\CommentDTO;
use App\DTO\ContentDTO;
use App\DTO\PostCommentsDTO;
use App\DTO\PostDTO;
use App\EloquentModel\Content;
use Illuminate\Support\Collection;
use Illuminate\Pagination\LengthAwarePaginator;

class PostTransformer
{
    public function withPagination($posts)
    {
        $payload = [
            'total' => $posts->total,
            'per_page' => $posts->per_page,
            'current_page' => $posts->current_page,
            'last_page' => $posts->last_page,
            'next_page_url' => $posts->next_page_url,
            'prev_page_url' => $posts->prev_page_url,
            'data' => array_map([$this, 'transformPost'], $posts->data),
        ];
        return response()->json($payload, 200, [], JSON_PRETTY_PRINT);
    }

    public function withArray(array $ItemArray)
    {
        $payload = array();
        $payload = array_merge($payload,$this->transformPost($ItemArray['post']));

        $payload['content'] = $this->transformContent($ItemArray['content']);

        if(isset($ItemArray['comments']))$payload['comments']= array_map([$this,'transformComments'],$ItemArray['comments']);
        return response()->json($payload, 200, [], JSON_PRETTY_PRINT);
    }

    public function transformPost(PostDTO $post)
    {
        return [
            'id' => $post->id,
            'user_id' => $post->user_id,
            'title' => $post->title,
            'view_count' => $post->view_count,
            'created' => $post->created_at,
            'links' => [
                [
                    'rel' => 'self',
                    'href' => route('api.posts.show', $post->id),
                ],
            ],
        ];
    }
    public function transformContent(ContentDTO $content)
    {
        return [
            'body' => $content->body,
        ];
    }
    public function transformComments(PostCommentsDTO $comments)
    {

        return [
            'body' => $comments->body,
            'created_at' => $comments->created_at,
            'replies'=>empty($comments->replies)?
            []:
            array_map([$this,'transformReplies'],$comments->replies),
        ];
    }
    public function transformReplies($replies){
        return[
            'body'=>$replies->body,
            'created_at'=>$replies->created_at,
        ];
    }
}
