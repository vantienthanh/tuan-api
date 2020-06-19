<?php


namespace Modules\Review\Transformers;


use Illuminate\Http\Resources\Json\Resource;

class SearchCompanyTransformers extends Resource
{
    public function toArray($request)
    {
        return [
            'id' => $this->id,
            'name' => $this->name,
            'avatar' => ''
        ];
    }
}