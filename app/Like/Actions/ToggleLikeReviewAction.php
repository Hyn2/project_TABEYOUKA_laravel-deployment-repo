<?php

namespace App\Like\Actions;

use Illuminate\Http\Request;

use App\Like\Domain\Repositories\LikeRepository as Repository;
use App\Like\Responders\ToggleLikeReviewResponder as Responder;

class ToggleLikeReviewAction
{
  public function __construct(
    protected Repository $repository,
    protected Responder $responder
  ) {
  }

  public function __invoke(Request $request)
  {
    $this->validateRequest($request);

    $review = $request->only(['review_id', 'user_id']);

    $response = $this->repository->toggleLikeReview($review);

    return $this->responder->respond($response);
  }

  public function validateRequest(Request $request)
  {
    $request->validate([
      'review_id' => 'required|integer',
      'user_id' => 'required|string',
    ]);
  }
}
