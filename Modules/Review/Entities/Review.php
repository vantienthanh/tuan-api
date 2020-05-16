<?php

namespace Modules\Review\Entities;

use Dimsav\Translatable\Translatable;
use Illuminate\Database\Eloquent\Model;

class Review extends Model
{

    protected $table = 'reviews';
    protected $fillable = ['review_name','review_content','user_id','company_id','star'];
}
