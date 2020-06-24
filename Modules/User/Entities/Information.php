<?php


namespace Modules\User\Entities;


use Illuminate\Database\Eloquent\Model;

class Information extends Model
{
    protected $table = 'information';
    protected $fillable = ['user_id','full_name','birthday','phone_number','skype','email','marital','hobby','sub_name','sort_description'];

}