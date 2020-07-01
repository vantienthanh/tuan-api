<?php


namespace Modules\Review\Transformers;


use Carbon\Carbon;
use Illuminate\Http\Resources\Json\Resource;
use Modules\Post\Entities\Like;
use Modules\User\Entities\Sentinel\User;

class ReviewTransformers extends Resource
{
    public function toArray($request)
    {
        $user = User::where(['id'=>$this->user_id])->first();
        return [
            'id' => $this->id,
            'review_name' => $this->review_name,
            'review_content' => $this->review_content,
            'star' => $this->star,
            'user_avatar' => $user->getImages1(),
            'user_id' => $user->id,
            'like_count' => $this->countLike($this),
            'dislike_count' => $this->countDislike($this),
            'created_at' => Carbon::parse($this->created_at)->timestamp,
            'updated_at' => Carbon::parse($this->updated_at)->timestamp,
        ];
    }

    private function countLike($review)
    {
        $result = Like::query()->where('post_id',$review->id)->where('type',Like::TYPE_REVIEW)->where('action',Like::ACTION_LIKE)->get()->count();

        return $result;
    }

    private function countDislike($review)
    {
        $result = Like::query()->where('post_id',$review->id)->where('type',Like::TYPE_REVIEW)->where('action',Like::ACTION_DISLIKE)->get()->count();

        return $result;
    }
}