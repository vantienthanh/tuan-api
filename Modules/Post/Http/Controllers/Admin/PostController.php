<?php

namespace Modules\Post\Http\Controllers\Admin;

use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Modules\Post\Entities\Post;
use Modules\Post\Http\Requests\CreatePostRequest;
use Modules\Post\Http\Requests\UpdatePostRequest;
use Modules\Post\Repositories\PostRepository;
use Modules\Core\Http\Controllers\Admin\AdminBaseController;

class PostController extends AdminBaseController
{
    /**
     * @var PostRepository
     */
    private $post;

    public function __construct(PostRepository $post)
    {
        parent::__construct();

        $this->post = $post;
    }

    /**
     * Display a listing of the resource.
     *
     * @return Response
     */
    public function index()
    {
        //$posts = $this->post->all();

        return view('post::admin.posts.index', compact(''));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return Response
     */
    public function create()
    {
        return view('post::admin.posts.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  CreatePostRequest $request
     * @return Response
     */
    public function store(CreatePostRequest $request)
    {
        $this->post->create($request->all());

        return redirect()->route('admin.post.post.index')
            ->withSuccess(trans('core::core.messages.resource created', ['name' => trans('post::posts.title.posts')]));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  Post $post
     * @return Response
     */
    public function edit(Post $post)
    {
        return view('post::admin.posts.edit', compact('post'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  Post $post
     * @param  UpdatePostRequest $request
     * @return Response
     */
    public function update(Post $post, UpdatePostRequest $request)
    {
        $this->post->update($post, $request->all());

        return redirect()->route('admin.post.post.index')
            ->withSuccess(trans('core::core.messages.resource updated', ['name' => trans('post::posts.title.posts')]));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  Post $post
     * @return Response
     */
    public function destroy(Post $post)
    {
        $this->post->destroy($post);

        return redirect()->route('admin.post.post.index')
            ->withSuccess(trans('core::core.messages.resource deleted', ['name' => trans('post::posts.title.posts')]));
    }
}
