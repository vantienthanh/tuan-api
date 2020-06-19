<?php

namespace Modules\Review\Repositories\Eloquent;

use Modules\Review\Repositories\CompanyRepository;
use Modules\Core\Repositories\Eloquent\EloquentBaseRepository;

class EloquentCompanyRepository extends EloquentBaseRepository implements CompanyRepository
{

    public function getListCompany()
    {
        return $this->model->newQuery()->where('accepted',false)->paginate(10);
    }

    public function search($name)
    {
        return $this->model->newQuery()->where('name','like','%'.$name.'%')->get();
    }

}
