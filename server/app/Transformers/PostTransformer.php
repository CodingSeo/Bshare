<?php
namespace App\Transformers;

use Illuminate\Support\Collection;
use Illuminate\Pagination\LengthAwarePaginator;

class PostTransformer{
    public function withPagination(Collection $posts)
    {
        $payload = [
            'total' => $posts->get('total'),
            'per_page' => $posts->get('per_page'),
            'current_page' => $posts->get('current_page'),
            'last_page' => $posts->get('last_page'),
            'next_page_url' => $posts->get('next_page_url'),
            'prev_page_url' => $posts->get('prev_page_url'),
            // array_map (callback, 'item')
            'data'=>$posts->get('data'),
            // 'data' => array_map([$this, 'transform'], collect($posts->get('data'))),
        ];
        return response()->json($payload,200,[],JSON_PRETTY_PRINT);
    }

    public function withItem(Collection $post)
    {
        return response()->json($this->transform($post),200,[],JSON_PRETTY_PRINT);
    }

    public function transform(Collection $post)
    {
        return [
            'id' => $post->get('id'),
            'title' => $post->get('title'),
            'content' => $post->get('text'),
            'view_count' => $post->get('view_count'),
            'created' => $post->get('created_at'),
            // 'attachments'  => $post->attachments->count(),
            'comments'     => $post->get('comments'),
            'links' => [
                [
                    'rel' => 'self',
                    'href' => route('api.posts.show', $post->get('id')),
                ],
            ],
        ];
    }
}
