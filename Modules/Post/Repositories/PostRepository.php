<?php

namespace Modules\Post\Repositories;

use Illuminate\Http\Request;
use Modules\Core\Repositories\BaseRepository;

interface PostRepository extends BaseRepository
{
    public function getListEmployer ();

    public function getListMember ();

    public function searchEmployer(Request $request);

    public function searchMember(Request $request);
}
