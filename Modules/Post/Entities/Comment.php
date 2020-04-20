<?php


namespace Modules\Post\Entities;


use Illuminate\Database\Eloquent\Model;

class Comment extends Model
{

    protected $table = 'comment';
    protected $fillable = ['content','user_id','type'];
}