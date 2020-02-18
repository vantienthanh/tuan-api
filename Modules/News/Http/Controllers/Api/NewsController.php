<?php


namespace Modules\News\Http\Controllers\Api;


use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Modules\News\Repositories\NewsRepository;
use Modules\News\Transformers\NewsDetailTransformers;
use Modules\News\Transformers\NewsListTransformers;

class NewsController extends Controller
{
    private $news;
    public function __construct(NewsRepository $news)
    {
        $this->news = $news;
    }

    public function listNews(Request $request)
    {
        $news = $this->news->getListNews($request);

        return NewsListTransformers::collection($news);
    }

    public function newsDetail(Request $request)
    {
        $detail = $this->news->find($request->id);

        return new NewsDetailTransformers($detail);
    }
}