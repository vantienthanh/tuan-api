<?php


namespace Modules\Post\Transformers;


use Carbon\Carbon;
use Illuminate\Http\Resources\Json\Resource;
use Modules\User\Entities\Sentinel\User;

class ListMemberTransformers  extends Resource
{
    public function toArray($request)
    {
        $user = User::where(['id'=>$this->user_id])->first();
        return [
            'id' => $this->id,
            'career' => $this->career,
            'location' => $this->location,
            'description' => $this->description,
            'startDatetime' => Carbon::parse($this->startDatetime)->timestamp,
            'endDatetime' => Carbon::parse($this->endDatetime)->timestamp,
            'like_count' => $this->like->count(),
            'comment_count' => $this->comment->count(),
            'user_name' => $user->first_name . " " . $user->last_name,
            'user_avatar' => 'updating link',
            'created_at' => Carbon::parse($this->created_at)->timestamp
        ];
    }
}