<?php

namespace Modules\Post\Entities;

use Dimsav\Translatable\Translatable;
use Illuminate\Database\Eloquent\Model;

class Post extends Model
{
    const TYPE_EMPLOYER = 'employer';
    const MEMBER_EMPLOYER = 'member';

    protected $table = 'post';
    protected $fillable = ['career','company_name','wage','location','description','user_id','type','startDatetime','endDatetime'];
}
