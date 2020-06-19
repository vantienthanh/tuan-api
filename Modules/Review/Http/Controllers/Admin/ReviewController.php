<?php

namespace Modules\Review\Http\Controllers\Admin;

use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Modules\Review\Entities\Review;
use Modules\Review\Http\Requests\CreateReviewRequest;
use Modules\Review\Http\Requests\UpdateReviewRequest;
use Modules\Review\Repositories\ReviewRepository;
use Modules\Core\Http\Controllers\Admin\AdminBaseController;

class ReviewController extends AdminBaseController
{
    /**
     * @var ReviewRepository
     */
    private $review;

    public function __construct(ReviewRepository $review)
    {
        parent::__construct();

        $this->review = $review;
    }

    /**
     * Display a listing of the resource.
     *
     * @return Response
     */
    public function index()
    {
        //$reviews = $this->review->all();

        return view('review::admin.reviews.index', compact(''));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return Response
     */
    public function create()
    {
        return view('review::admin.reviews.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  CreateReviewRequest $request
     * @return Response
     */
    public function store(CreateReviewRequest $request)
    {
        $this->review->create($request->all());

        return redirect()->route('admin.review.review.index')
            ->withSuccess(trans('core::core.messages.resource created', ['name' => trans('review::reviews.title.reviews')]));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  Review $review
     * @return Response
     */
    public function edit(Review $review)
    {
        return view('review::admin.reviews.edit', compact('review'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  Review $review
     * @param  UpdateReviewRequest $request
     * @return Response
     */
    public function update(Review $review, UpdateReviewRequest $request)
    {
        $this->review->update($review, $request->all());

        return redirect()->route('admin.review.review.index')
            ->withSuccess(trans('core::core.messages.resource updated', ['name' => trans('review::reviews.title.reviews')]));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  Review $review
     * @return Response
     */
    public function destroy(Review $review)
    {
        $this->review->destroy($review);

        return redirect()->route('admin.review.review.index')
            ->withSuccess(trans('core::core.messages.resource deleted', ['name' => trans('review::reviews.title.reviews')]));
    }
}
