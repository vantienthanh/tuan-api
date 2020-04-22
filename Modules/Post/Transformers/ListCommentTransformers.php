<?php


namespace Modules\Post\Transformers;


use Carbon\Carbon;
use Illuminate\Http\Resources\Json\Resource;
use Modules\User\Entities\Sentinel\User;

class ListCommentTransformers extends Resource
{
    public function toArray($request)
    {
        $user = User::where(['id' => $this->user_id])->first();
        return [
            'id' => $this->id,
            'content' => $this->content,
            'user_name' => $user->first_name . " " . $user->last_name,
            'user_avatar' => 'updating',
            'created_at' => Carbon::parse($this->created_at)->timestamp
        ];
    }
}