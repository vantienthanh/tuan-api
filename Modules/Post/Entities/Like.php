<?php


namespace Modules\Post\Entities;


use Illuminate\Database\Eloquent\Model;

class Like extends Model
{
    const TYPE_POST = 'post';
    const TYPE_REVIEW = 'review';
    const ACTION_LIKE = 'like';
    const ACTION_DISLIKE = 'dislike';

    protected $table = 'like';
    protected $fillable = ['user_id','post_id','action','type'];
}