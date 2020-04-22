<?php

namespace Modules\Post\Entities;

use Dimsav\Translatable\Translatable;
use Illuminate\Database\Eloquent\Model;

class Post extends Model
{
    const TYPE_EMPLOYER = 'employer';
    const TYPE_MEMBER = 'member';

    protected $table = 'post';
    protected $fillable = ['career','company_name','wage','location','description','user_id','type','startDatetime','endDatetime'];

    public function like()
    {
        return $this->hasMany(Like::class,'post_id','id');
    }

    public function comment()
    {
        return $this->hasMany(Comment::class,'post_id','id');
    }
}
