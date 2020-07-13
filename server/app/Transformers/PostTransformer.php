<?php

namespace App\Transformers;

use App\DTO\CommentDTO;
use App\DTO\ContentDTO;
use App\DTO\PostCommentsDTO;
use App\DTO\PostDTO;
use App\DTO\PostPaginateDTO;
use App\DTO\RepliesDTO;
use Carbon\Carbon;
use Illuminate\Http\JsonResponse;

class PostTransformer
{

    public function withArray(array $ItemArray)
    {
        $payload = array();
        // $payload = array_merge($payload, $this->transformPost($ItemArray['post']));
        if (isset($ItemArray['comments']))
            $payload['comments'] = array_map([$this, 'transformComments'], $ItemArray['comments']);
        return response()->json($payload, 200, [], JSON_PRETTY_PRINT);
    }

    public function transformPost(PostDTO $postDTO): JsonResponse
    {
        $postDTO->setCreated_at($this->changeDateTime($postDTO->getCreated_at()));
        $postDTO->setUpdated_at($this->changeDateTime($postDTO->getUpdated_at()));
        $payload = [
            'id' => $postDTO->getID(),
            'user_id' => $postDTO->getUser_id(),
            'title' => $postDTO->getTitle(),
            'content' => $this->transformContent($postDTO->getContent()),
            'view_count' => $postDTO->getView_count(),
            'trade_status' => $postDTO->getTrade_status(),
            'comments' => empty($postDTO->getComments()) ? [] : array_map([$this, 'transformComments'], $postDTO->getComments()),
            'created' => $this->changeDateTime($postDTO->getCreated_at()),
            'links' => [
                [
                    'rel' => 'self',
                    'href' => route('api.posts.show', $postDTO->getId()),
                ],
            ],
        ];
        return response()->json($payload, 200, [], JSON_PRETTY_PRINT);
    }

    public function transformPosts(array $posts): JsonResponse
    {
        $payload = array_map([$this, 'transformPostFromPaginate'], $posts);
        return response()->json($payload, 200, [], JSON_PRETTY_PRINT);
    }

    public function withPagination(PostPaginateDTO $posts)
    {
        if (!$posts->data) $posts->data = [];
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
            'id' => $post->getID(),
            'user_id' => $post->getUser_id(),
            'title' => $post->getTitle(),
            'view_count' => $post->getView_count(),
            'trade_status' => $post->getTrade_status(),
            'created' => $this->changeDateTime($post->getCreated_at()),
            'links' => [
                [
                    'rel' => 'self',
                    'href' => route('api.posts.show', $post->getId()),
                ],
            ],
        ];
    }
    public function transformContent(ContentDTO $content)
    {
        return [
            'body' => $content->getBody(),
        ];
    }

    public function transformComments(CommentDTO $comments)
    {

        return [
            'id' => $comments->id,
            'user_id' => $comments->user_id,
            'body' => $comments->body,
            'created_at' => $this->changeDateTime($comments->created_at),
            'replies' => empty($comments->replies) ? [] : array_map([$this, 'transformReplies'], $comments->replies),
        ];
    }
    public function transformReplies(RepliesDTO $comments)
    {

        return [
            'id' => $comments->id,
            'user_id' => $comments->user_id,
            'body' => $comments->body,
            'created_at' => $this->changeDateTime($comments->created_at)
        ];
    }
    public function transformComment(CommentDTO $comments)
    {
        $payload =  [
            'id' => $comments->id,
            'user_id' => $comments->user_id,
            'body' => $comments->body,
            'created_at' => $this->changeDateTime($comments->created_at),
            'replies' => empty($comments->replies) ? [] : array_map([$this, 'transformComments'], $comments->replies),
        ];
        return response()->json($payload, 200, [], JSON_PRETTY_PRINT);
    }

    public function changeDateTime($value)
    {
        return  Carbon::parse($value)->toDateTimeString();
    }
    //hellper
    public function success($message, ...$option)
    {
        $payload = [
            'message' => $message,
        ];
        return response()->json($payload, 200, [], JSON_PRETTY_PRINT);
    }
}
