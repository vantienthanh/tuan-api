<?php

namespace Modules\Review\Entities;

use Dimsav\Translatable\Translatable;
use Illuminate\Database\Eloquent\Model;

class Company extends Model
{

    protected $table = 'company';
    protected $fillable = ['name','address','career','accepted'];

    public function review()
    {
        return $this->hasMany(Review::class,'company_id','id');
    }
}
