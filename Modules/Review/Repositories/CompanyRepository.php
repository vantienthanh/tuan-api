<?php

namespace Modules\Review\Repositories;

use Modules\Core\Repositories\BaseRepository;

interface CompanyRepository extends BaseRepository
{

    public function getListCompany();
    public function search($name);
}
