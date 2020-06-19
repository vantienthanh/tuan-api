<?php


namespace Modules\Review\Http\Controllers\Api;


use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Modules\Post\Entities\Like;
use Modules\Review\Repositories\CompanyRepository;
use Modules\Review\Repositories\ReviewRepository;
use Modules\Review\Transformers\CompanyDetailTransformers;
use Modules\Review\Transformers\ListCompanyTransformers;
use Modules\Review\Transformers\SearchCompanyTransformers;

class ReviewController extends Controller
{
    private $company;
    private $review;

    public function __construct(ReviewRepository $review, CompanyRepository $company)
    {
        $this->company = $company;
        $this->review = $review;
    }

    public function listCompany()
    {
        $data = $this->company->getListCompany();

        return ListCompanyTransformers::collection($data);
    }

    public function companyDetail(Request $request)
    {
        $detail = $this->company->find($request->id);

        return new CompanyDetailTransformers($detail);
    }

    public function createCompany(Request $request)
    {
        $data = $request->all();

        $data['accepted'] = false;

        try {
            $this->company->create($data);

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

    public function createReview(Request $request)
    {
        $user = Auth::user();

        $data = $request->all();
        $data['user_id'] = $user->id;

        try {
            $this->review->create($data);

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

    public function likeComment(Request $request)
    {
        // check if exits unlike => change to like
        $user = Auth::user();
        $post_id = $request->id;
        $post = $this->review->getByAttributes(['id' => $post_id])->first();
        $like = Like::where('user_id',$user->id)->where('post_id',$post_id)->where('type',Like::TYPE_REVIEW)->first();

        if (isset($like)) {
            // case dislike change to like
            if ($like->action == Like::ACTION_DISLIKE) {
                $like->action = Like::ACTION_LIKE;
                $like->save();
                return response()->json([
                    'errors' => 'false',
                    'message' => "Like successfully",
                ],
                    200
                );
            } else {
                // case like => unlike
                $like->delete();
                return response()->json([
                    'errors' => 'false',
                    'message' => "Unlike successfully",
                ],
                    200
                );
            }
        } else {
            // case not exits => create
            $data = [
                'user_id' => $user->id,
                'post_id' => $post->id,
                'action' => Like::ACTION_LIKE,
                'type' => Like::TYPE_REVIEW
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

    public function dislikeComment(Request $request)
    {
        // check if exits like => change to dislike
        $user = Auth::user();
        $post_id = $request->id;
        $post = $this->review->getByAttributes(['id' => $post_id])->first();
        $like = Like::where('user_id',$user->id)->where('post_id',$post_id)->where('type',Like::TYPE_REVIEW)->first();

        if (isset($like)) {
            // case like change to dislike
            if ($like->action == Like::ACTION_LIKE) {
                $like->action = Like::ACTION_DISLIKE;
                $like->save();
                return response()->json([
                    'errors' => 'false',
                    'message' => "Dislike successfully",
                ],
                    200
                );
            } else {
                // case dislike => un-dislike
                $like->delete();
                return response()->json([
                    'errors' => 'false',
                    'message' => "Un-dislike successfully",
                ],
                    200
                );
            }
        } else {
            // case not exits => create
            $data = [
                'user_id' => $user->id,
                'post_id' => $post->id,
                'action' => Like::ACTION_DISLIKE,
                'type' => Like::TYPE_REVIEW
            ];
            $like = new Like($data);
            $like->save();
            return response()->json([
                'errors' => 'false',
                'message' => "Dislike successfully",
            ],
                200
            );
        }
    }

    public function search(Request $request)
    {
        $name = $request->name;
        $result = $this->company->search($name);
        return SearchCompanyTransformers::collection($result);
    }
}