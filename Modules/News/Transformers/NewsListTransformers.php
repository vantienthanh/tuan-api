<?php


namespace Modules\News\Transformers;


use Illuminate\Http\Resources\Json\Resource;

class NewsListTransformers extends Resource
{
 public function toArray($request)
 {
     return [
       'id' => $this->id,
       'title' => $this->title,
       'created_at' => $this->created_at,
     ];
 }
}