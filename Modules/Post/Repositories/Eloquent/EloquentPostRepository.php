<?php

namespace Modules\Post\Repositories\Eloquent;

use Modules\Post\Entities\Post;
use Modules\Post\Repositories\PostRepository;
use Modules\Core\Repositories\Eloquent\EloquentBaseRepository;

class EloquentPostRepository extends EloquentBaseRepository implements PostRepository
{
    public function getListEmployer ()
    {
        return $this->model->newQuery()->where('type',Post::TYPE_EMPLOYER)->paginate(10);
    }

    public function getListMember ()
    {
        return $this->model->newQuery()->where('type',Post::TYPE_MEMBER)->paginate(10);
    }

    public function searchEmployer($string)
    {
        return $this->model->newQuery()
            ->where('type',Post::TYPE_EMPLOYER)
            ->where(function($q) use ($string) {
            $q->where('company_name','like','%'.$string.'%')
                ->orWhere('location','like','%'.$string.'%')
                ->orWhere('wage','like','%'.$string.'%')
                ->orWhere('career','like','%'.$string.'%');
        })->paginate(10);
    }

    public function searchMember($string)
    {
        return $this->model->newQuery()
            ->where('type',Post::TYPE_MEMBER)
            ->where(function($q) use ($string) {
                $q->where('company_name','like','%'.$string.'%')
                    ->orWhere('location','like','%'.$string.'%')
                    ->orWhere('wage','like','%'.$string.'%')
                    ->orWhere('career','like','%'.$string.'%');
            })->paginate(10);
    }
}
