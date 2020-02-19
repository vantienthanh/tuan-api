<?php

namespace Modules\News\Entities;

use Dimsav\Translatable\Translatable;
use Illuminate\Database\Eloquent\Model;
use Modules\Media\Support\Traits\MediaRelation;

class News extends Model
{
    use MediaRelation;
    protected $table = 'news';
    protected $fillable = ['title','content','url'];

    public function getImages()
    {
        $file = $this->files()->first();
        if ($file) {
//            $img = app(Imagy::class);
            return $file->path;
        }
        return null;
    }
}
