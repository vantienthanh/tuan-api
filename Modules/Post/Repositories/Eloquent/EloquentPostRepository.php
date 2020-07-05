<?php

namespace Modules\Post\Repositories\Eloquent;

use Illuminate\Http\Request;
use Modules\Post\Entities\Post;
use Modules\Post\Repositories\PostRepository;
use Modules\Core\Repositories\Eloquent\EloquentBaseRepository;

class EloquentPostRepository extends EloquentBaseRepository implements PostRepository
{
    public function getListEmployer ()
    {
        return $this->model->newQuery()->where('type',Post::TYPE_EMPLOYER)->orderBy('created_at','desc')->paginate(10);
    }

    public function getListMember ()
    {
        return $this->model->newQuery()->where('type',Post::TYPE_MEMBER)->orderBy('created_at','desc')->paginate(10);
    }

    public function searchEmployer(Request $request)
    {

        return $this->model->newQuery()
            ->where('type',Post::TYPE_EMPLOYER)
            ->where(function($q) use ($request) {
                if ($request->get('company_name') !== null) {
                    $q->where('company_name','like','%'.$request->get('company_name').'%');
                }
                if ($request->get('location') !== null) {
                    $q->where('location','like','%'.$request->get('location').'%');
                }
                if ($request->get('wage') !== null) {
                    $q->where('wage','like','%'.$request->get('wage').'%');
                }
                if ($request->get('career') !== null) {
                    $q->where('career','like','%'.$request->get('career').'%');
                }
                if ($request->get('description') !== null) {
                    $q->where('description','like','%'.$request->get('description').'%');
                }
        })->orderBy('created_at','desc')
            ->paginate(10);
    }

    public function searchMember(Request $request)
    {
        return $this->model->newQuery()
            ->where('type',Post::TYPE_MEMBER)
            ->where(function($q) use ($request) {
                if ($request->get('company_name') !== null) {
                    $q->where('company_name','like','%'.$request->get('company_name').'%');
                }
                if ($request->get('location') !== null) {
                    $q->where('location','like','%'.$request->get('location').'%');
                }
                if ($request->get('wage') !== null) {
                    $q->where('wage','like','%'.$request->get('wage').'%');
                }
                if ($request->get('career') !== null) {
                    $q->where('career','like','%'.$request->get('career').'%');
                }
                if ($request->get('description') !== null) {
                    $q->where('description','like','%'.$request->get('description').'%');
                }
            })->orderBy('created_at','desc')
            ->paginate(10);
    }
}
