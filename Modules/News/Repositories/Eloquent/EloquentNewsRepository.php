<?php

namespace Modules\News\Repositories\Eloquent;

use Illuminate\Http\Request;
use Modules\News\Repositories\NewsRepository;
use Modules\Core\Repositories\Eloquent\EloquentBaseRepository;

class EloquentNewsRepository extends EloquentBaseRepository implements NewsRepository
{
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
