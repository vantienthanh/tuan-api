<?php

namespace Modules\Post\Repositories;

use Modules\Core\Repositories\BaseRepository;

interface PostRepository extends BaseRepository
{
    public function getListEmployer ();

    public function getListMember ();
}
