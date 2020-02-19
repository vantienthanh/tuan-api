<?php

namespace Modules\News\Repositories\Eloquent;

use Illuminate\Http\Request;
use Modules\News\Events\NewsWasCreated;
use Modules\News\Events\NewsWasDeleted;
use Modules\News\Events\NewsWasUpdated;
use Modules\News\Repositories\NewsRepository;
use Modules\Core\Repositories\Eloquent\EloquentBaseRepository;

class EloquentNewsRepository extends EloquentBaseRepository implements NewsRepository
{
    public function create($data)
    {
        $news = $this->model->create($data);

        event(new NewsWasCreated($news, $data));

        return $news;
    }

    public function update($news, $data)
    {
        $news->update($data);

        event(new NewsWasUpdated($news, $data));

        return $news;
    }

    public function destroy($news)
    {
        event(new NewsWasDeleted($news));

        return $news->delete();
    }

    public function getListNews(Request $request)
    {
        $query = $this->allWithBuilder();

        if ($request->get('search') !== null) {
            $term = $request->get('search');
            $query->where(function ($query) use ($request, $term) {
                $query->where('title', 'LIKE', "%{$term}%")
                    ->orWhere('id', 'LIKE', "%{$term}%")
                    ->orWhere('content', 'LIKE', "%{$term}%")
                    ->orWhere('url', 'LIKE', "%{$term}%");
            });
        }

        $query->orderBy('created_at', 'desc');
        return $query->paginate($request->get('per_page', 10));
    }
}
