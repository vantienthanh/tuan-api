<?php


namespace Modules\Post\Http\Controllers\Api;


use App\Http\Controllers\Controller;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Modules\Post\Entities\Comment;
use Modules\Post\Entities\Like;
use Modules\Post\Entities\Post;
use Modules\Post\Repositories\PostRepository;
use Modules\Post\Transformers\EmployerDetailTransformers;
use Modules\Post\Transformers\ListEmployerTransformers;
use Modules\Post\Transformers\ListMemberTransformers;
use Modules\Post\Transformers\MemberDetailTransformers;

class PostController extends Controller
{
    private $post;
    private $comment;
    private $like;

    public function __construct(PostRepository $post)
    {
        $this->post = $post;
    }

    public function listEmployer()
    {
        $listEmployer = $this->post->getListEmployer();
        return ListEmployerTransformers::collection($listEmployer);
    }

    public function employerDetail(Request $request)
    {
        $detail = $this->post->find($request->id);
        return new EmployerDetailTransformers($detail);
    }

    public function createEmployer(Request $request)
    {
        $user = Auth::user();
        $data = $request->all();
        $data['type'] = Post::TYPE_EMPLOYER;
        $data['user_id'] = $user->id;
        $data['startDatetime'] = Carbon::createFromTimestamp($data['startDatetime'])->toDateTime();
        $data['endDatetime'] = Carbon::createFromTimestamp($data['endDatetime'])->toDateTime();
        try {
            $this->post->create($data);

            return response()->json([
                'errors' => 'false',
                'message' => 'Created successfully',
            ],
                200
            );
        } catch ( \Exception $e) {
            return response()->json([
                'errors' => 'true',
                'message' => $e,
            ],
                500
            );
        }
    }

    public function listMember()
    {
        $listMember = $this->post->getListMember();
        return ListMemberTransformers::collection($listMember);
    }

    public function memberDetail(Request $request)
    {
        $detail = $this->post->find($request->id);
        return new MemberDetailTransformers($detail);
    }

    public function createMember(Request $request)
    {
        $user = Auth::user();
        $data = $request->all();
        $data['type'] = Post::TYPE_MEMBER;
        $data['user_id'] = $user->id;
        $data['startDatetime'] = Carbon::createFromTimestamp($data['startDatetime'])->toDateTime();
        $data['endDatetime'] = Carbon::createFromTimestamp($data['endDatetime'])->toDateTime();
        try {
            $this->post->create($data);

            return response()->json([
                'errors' => 'false',
                'message' => 'Created successfully',
            ],
                200
            );
        } catch ( \Exception $e) {
            return response()->json([
                'errors' => 'true',
                'message' => $e,
            ],
                500
            );
        }
    }

    public function postComment(Request $request)
    {
        $user = Auth::user();
        $data = $request->all();
        $data['user_id'] = $user->id;
        $data['type'] = Comment::TYPE_COMMENT_POST;
        try {
            $comment = new Comment($data);
            $comment->save();

            return response()->json([
                'errors' => 'false',
                'message' => 'Created comment successfully',
            ],
                200
            );
        } catch ( \Exception $e) {
            return response()->json([
                'errors' => 'true',
                'message' => $e,
            ],
                500
            );
        }
    }

    public function likeOrrUnlike(Request $request)
    {
        $user = Auth::user();
        $post_id = $request->id;
        $post = $this->post->getByAttributes(['id' => $post_id])->first();
        $like = Like::where('user_id',$user->id)->where('post_id',$post_id)->where('type',Like::TYPE_POST)->first();
        if (isset($like)) {
            $like->delete();
            return response()->json([
                'errors' => 'false',
                'message' => "Unlike successfully",
            ],
                200
            );
        } else {
            $data = [
                'user_id' => $user->id,
                'post_id' => $post->id,
                'action' => Like::ACTION_LIKE,
                'type' => Like::TYPE_POST
            ];
            $like = new Like($data);
            $like->save();
            return response()->json([
                'errors' => 'false',
                'message' => "Like successfully",
            ],
                200
            );
        }
    }

    public function searchEmployer(Request $request)
    {
        $data = $this->post->searchEmployer($request->string);

        return ListEmployerTransformers::collection($data);
    }

    public function searchMember(Request $request)
    {
        $data = $this->post->searchMember($request->string);

        return ListMemberTransformers::collection($data);
    }
}