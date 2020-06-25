<?php


namespace Modules\Review\Transformers;


use Carbon\Carbon;
use Illuminate\Http\Resources\Json\Resource;

class CompanyDetailTransformers extends Resource
{
    public function toArray($request)
    {
        return [
            'id' => $this->id,
            'name' => $this->name,
            'address' => $this->address,
            'career' => $this->career,
            'created_at' => Carbon::parse($this->created_at)->timestamp,
            'updated_at' => Carbon::parse($this->updated_at)->timestamp,
            'avatar' => '',
            'rating_star' => $this->getRatingStar($this->id),
            'rating_count' => $this->getRatingCount($this->id),
            'rating_list' => ReviewTransformers::collection($this->review)
        ];
    }

    public function getRatingStar($company_id)
    {
        $list = $this->review;
        $star = 0;
        foreach ($list as $item) {
            $star+= $item->star;
        }

        return $this->review->count() ? $star/$this->review->count() : 0;
    }

    public function getRatingCount($company_id)
    {
        return $this->review->count();
    }
}