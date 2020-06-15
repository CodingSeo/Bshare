<?php

namespace App\Transformers;

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
            // array_map (callback, 'item')
            'data' => $posts->data,
            // 'data' => array_map([$this, 'transform'], collect($posts->get('data'))),
        ];
        return response()->json($payload, 200, [], JSON_PRETTY_PRINT);
    }

    public function withItem($post)
    {
        return response()->json($this->transform($post), 200, [], JSON_PRETTY_PRINT);
    }

    public function transform($post)
    {
        return [
            'id' => $post->id,
            'title' => $post->title,
            'content' => $post->text,
            'view_count' => $post->view_count,
            'created' => $post->created_at,
            // 'attachments'  => $post->attachments->count(),
            'comments'     => $post->comments,
            'links' => [
                [
                    'rel' => 'self',
                    'href' => route('api.posts.show', $post->id),
                ],
            ],
        ];
    }
}
