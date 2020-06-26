<?php

namespace App\Transformers;

use App\DTO\CommentDTO;
use App\DTO\ContentDTO;
use App\DTO\PostCommentsDTO;
use App\DTO\PostDTO;
use App\DTO\PostPaginateDTO;
use Carbon\Carbon;

class PostTransformer
{
    public function withArray(array $ItemArray)
    {
        $payload = array();
        // $payload = array_merge($payload, $this->transformPost($ItemArray['post']));
        $payload['content'] = $this->transformContent($ItemArray['content']);
        if (isset($ItemArray['comments']))
            $payload['comments'] = array_map([$this, 'transformComments'], $ItemArray['comments']);
        return response()->json($payload, 200, [], JSON_PRETTY_PRINT);
    }

    public function transformPost(PostDTO $post){
        $post->created_at = $this->changeDateTime($post->created_at);
        $post->updated_at = $this->changeDateTime($post->updated_at);
        $post->comments = empty($post->comments)?[]:array_map([$this, 'transformComments'], $post->comments);
        $post->content = $this->transformContent($post->content);
        return response()->json($post, 200, [], JSON_PRETTY_PRINT);
    }

    public function withPagination(PostPaginateDTO $posts)
    {
        $payload = [
            'total' => $posts->total,
            'per_page' => $posts->per_page,
            'current_page' => $posts->current_page,
            'last_page' => $posts->last_page,
            'next_page_url' => $posts->next_page_url,
            'prev_page_url' => $posts->prev_page_url,
            'data' => array_map([$this, 'transformPostFromPaginate'], $posts->data),
        ];
        return response()->json($payload, 200, [], JSON_PRETTY_PRINT);
    }

    public function transformPostFromPaginate(PostDTO $post)
    {
        return [
            'id' => $post->id,
            'user_id' => $post->user_id,
            'title' => $post->title,
            'view_count' => $post->view_count,
            'created' => $this->changeDateTime($post->created_at),
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
    
    public function transformComments($comments)
    {

        return [
            'id'=>$comments->id,
            'user_id'=>$comments->user_id,
            'body' => $comments->body,
            'created_at' => $this->changeDateTime($comments->created_at),
            'replies' => empty($comments->replies)?[]:array_map([$this, 'transformComments'], $comments->replies),
        ];
    }
    public function transformComment(CommentDTO $comments)
    {

        $payload =  [
            'id'=>$comments->id,
            'user_id'=>$comments->user_id,
            'body' => $comments->body,
            'created_at' => $this->changeDateTime($comments->created_at),
            'replies' => empty($comments->replies)?[]:array_map([$this, 'transformComments'], $comments->replies),
        ];
        return response()->json($payload, 200, [], JSON_PRETTY_PRINT); 
    }

    public function changeDateTime($value)
    {
        return  Carbon::parse($value)->toDateTimeString();
    }
    //hellper
    public function success($message,...$option){
        $payload = [
            'message'=>$message,
        ];
        return response()->json($payload, 200, [], JSON_PRETTY_PRINT);
    }

}
