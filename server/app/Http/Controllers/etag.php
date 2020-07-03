
<?php
// app/Http/Controllers/ArticlesController.php

class ArticlesController extends Controller
{
    protected $cache;

    public function __construct()
    {
        // taggable() Helper 를 이용하여 기본 쿼리를 만든다.
        // .env 에 CACHE_DRIVER= 값이 file 이나 database 이면 Cache Tag 를 쓸 수 없다.
        $this->cache = taggable() ? app('cache')->tags('articles') : app('cache');

        // ...
    }

    public function index(FilterArticlesRequest $request, $slug = null)
    {
        // ...

        // cache_key() Helper 를 이용해 캐시에 사용할 고유한 key 를 만든다.
        $cacheKey = cache_key('articles.index');

        $articles = $this->cache->remember($cacheKey, 5, function() use($query, $request) {
            return $this->filter($query)->paginate($request->input('pp', 5));
        });

        // ...
    }

    public function show($id)
    {
        $cacheKey = cache_key("articles.show.{$id}");
        $secondKey = cache_key("articles.show.{$id}.comments");

        $article = $this->cache->remember($cacheKey, 5, function() use($id) {
            return Article::with('comments', 'tags', 'attachments', 'solution')->findOrFail($id);
        });

        $commentsCollection = $this->cache->remember($secondKey, 5, function() use($article){
            return $article->comments()->with('replies')->withTrashed()->whereNull('parent_id')->latest()->get();
        });

        // ...
    }
}
class Article extends Model
{
    public function etag($cacheKey = null)
    {
        $etag = $this->getTable() . $this->getKey();

        if ($this->usesTimestamps()) {
            $etag .= $this->updated_at->timestamp;
        }

        return md5($etag.$cacheKey);
    }
}
// app/Http/Controllers/Controller.php

class Controller extends BaseController
{
    // ...

    public function etags($collection, $cacheKey = null)
    {
        $etag = '';

        foreach($collection as $instance) {
            $etag .= $instance->etag();
        }

        return md5($etag.$cacheKey);
    }
}
// app/Http/Controllers/ArticlesController.php

class ArticlesController extends Controller
{
    public function show($id)
    {
        // ...

        if (! is_api_request()) {
            event(new ArticleConsumed($article));
        }

        return $this->respondItem($article, $commentsCollection, $cacheKey.$secondKey);
    }
}
// app/Http/Controllers/Api/V1/ArticlesController.php

class ArticlesController extends ParentController
{
    protected function respondCollection(LengthAwarePaginator $articles, $cacheKey = null)
    {
        // Request 붙어 온 If-None-Match Header 가져오기
        $reqEtag = request()->getETags();
        // 베이스 클래스에 만든 Collection 에 대한 Etag 만들기
        $genEtag = $this->etags($articles, $cacheKey);

        if (isset($reqEtag[0]) and $reqEtag[0] === $genEtag) {
            // $reqEtag = ["65f8322657950bdccdc48df21dddfc33"] 이기 때문에 Array Access 해야 함.
            return $this->respondNotModified();
        }

        // 클라이언트가 If-None-Match Header 를 보내 오지 않았거나,
        // 클라이언트가 보내온 Header 가 $genEtag 와 다를 경우.
        // 즉, 모델이 수정되었을 경우.
        return json()->setHeaders(['Etag' => $genEtag])->withPagination($articles, new ArticleTransformer);
    }

    protected function respondItem(Article $article, Collection $commentsCollection = null, $cacheKey = null)
    {
        $reqEtag = request()->getETags();
        // 단일 Instance 에 대한 Etag 만들기
        $genEtag = $article->etag($cacheKey);

        if (isset($reqEtag[0]) and $reqEtag[0] === $genEtag) {
            return $this->respondNotModified();
        }

        return json()->setHeaders(['Etag' => $genEtag])->withItem($article, new ArticleTransformer);
    }

    protected function respondNotModified()
    {
        return json()->notModified();
    }
}
