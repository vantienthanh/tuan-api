<?php


namespace Modules\Post\Http\Controllers\Api;


use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Modules\Post\Entities\Post;
use Modules\Post\Repositories\PostRepository;

class PostController extends Controller
{
    private $post;

    public function __construct(PostRepository $post)
    {
        $this->post = $post;
    }

    public function listEmployer()
    {
        $listEmployer = $this->post->getByAttributes(['type' => Post::TYPE_EMPLOYER]);
    }

    public function createEmployer(Request $request)
    {

    }
}