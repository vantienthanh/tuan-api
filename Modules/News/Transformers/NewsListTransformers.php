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
            'image' => $this->getImages(),
            'url' => $this->url,
            'created_at' => $this->created_at,
        ];
    }
}