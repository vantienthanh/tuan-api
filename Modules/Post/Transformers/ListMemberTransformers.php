<?php


namespace Modules\Post\Transformers;


use Carbon\Carbon;
use Illuminate\Http\Resources\Json\Resource;
use Illuminate\Support\Facades\Auth;
use Modules\Post\Entities\Like;
use Modules\User\Entities\Sentinel\User;

class ListMemberTransformers  extends Resource
{
    public function toArray($request)
    {
        $userAuth = Auth::user();
        $user = User::where(['id'=>$this->user_id])->first();
        return [
            'id' => $this->id,
            'career' => $this->career,
            'location' => $this->location,
            'description' => $this->description,
            'startDatetime' => Carbon::parse($this->startDatetime)->timestamp,
            'endDatetime' => Carbon::parse($this->endDatetime)->timestamp,
            'like_count' => $this->like->count(),
            'is_liked' => $this->getLikeStatus($userAuth->id, $this->id),
            'comment_count' => $this->comment->count(),
            'user_name' => $user->first_name . " " . $user->last_name,
            'user_id' => $user->id,
            'user_avatar' => $user->getImages1(),
            'created_at' => Carbon::parse($this->created_at)->timestamp
        ];
    }

    private function getLikeStatus($user_id, $post_id)
    {
        return Like::where('user_id', $user_id)->where('post_id', $post_id)->first() == null ? false : true;
    }
}