<?php


namespace Modules\Post\Entities;


use Illuminate\Database\Eloquent\Model;
use Modules\User\Entities\Sentinel\User;

class Comment extends Model
{
    const TYPE_COMMENT_POST = "comment_post";
    const TYPE_REVIEW = "review_company";

    protected $table = 'comment';
    protected $fillable = ['content','user_id','type','post_id'];

    public function post()
    {
        return $this->belongsTo('post','post_id','id');
    }

    public function user ()
    {
        return $this->hasOne(User::class,'user_id','id');
    }
}