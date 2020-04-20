<?php


namespace Modules\Post\Entities;


use Illuminate\Database\Eloquent\Model;

class Like extends Model
{

    protected $table = 'like';
    protected $fillable = ['user_id'];
}