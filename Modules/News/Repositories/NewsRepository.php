<?php

namespace Modules\News\Repositories;

use Illuminate\Http\Request;
use Modules\Core\Repositories\BaseRepository;

interface NewsRepository extends BaseRepository
{
    public function getListNews(Request $request);
}
