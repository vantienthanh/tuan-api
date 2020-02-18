<?php


namespace Modules\News\Transformers;


use Illuminate\Http\Resources\Json\Resource;

class NewsDetailTransformers extends Resource
{
    public function toArray($request)
    {
        return [
          'id' => $this->id,
          'title' => $this->title,
          'content' => $this->content,
//          'avatar' => $this,
          'created_at' => $this->created_at
        ];
    }
}