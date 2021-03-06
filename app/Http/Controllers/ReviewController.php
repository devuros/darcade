<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Game;
use App\User;
use App\Review;
use App\Http\Resources\ReviewResource;
use App\Http\Resources\ReviewBaseResource;
use App\Http\Resources\UserReviewResource;
use Illuminate\Support\Facades\Auth;
use App\Http\Requests\StoreReview;
use App\Http\Requests\UpdateReview;

class ReviewController extends ApiController
{
    public function __construct()
    {
        $this->middleware('auth:api')->only(['showCurrentUserReviews', 'store', 'update', 'destroy']);
    }

    public function showCurrentUserReviews()
    {
        $reviews = User::find(Auth::id())
            ->reviews()
            ->join('games', 'reviews.game_id', '=', 'games.id')
            ->select('reviews.*', 'games.image', 'games.title')
            ->get();

        if ($reviews->isEmpty())
        {
            return $this->respondSuccess('You did not write any reviews');
        }

        return ReviewResource::collection($reviews);
    }

    public function store(StoreReview $request)
    {
        if (Auth::user()->cant('store', 'App\Review'))
        {
            return $this->respondForbidden('You dont have the permissions');
        }

        $game_review_exists = User::find(Auth::id())->reviews()->where('game_id', $request->game)->exists();

        if ($game_review_exists)
        {
            return $this->respondForbidden('You already wrote a review for this game');
        }

        $review = new Review;
        $review->game_id = $request->game;
        $review->user_id = Auth::id();
        $review->recommended = $request->recommended;
        $review->body = $request->body;
        $review->save();

        return $this->respondCreated('Review successfully created');
    }

    public function show($id)
    {
        $review = Review::find($id);

        if (empty($review))
        {
            return $this->respondNotFound('Sorry, the requested review was not found');
        }

        return new ReviewBaseResource($review);
    }

    public function update(UpdateReview $request, $id)
    {
        $review = Review::find($id);

        if (empty($review))
        {
            return $this->respondNotFound('Sorry, the requested review was not found');
        }

        if (Auth::user()->cant('update', $review))
        {
            return $this->respondForbidden('You dont have the permissions');
        }

        $review->recommended = $request->recommended;
        $review->body = $request->body;
        $review->save();

        return $this->respondSuccess('Review updated successfully');
    }

    public function destroy($id)
    {
        $review = Review::find($id);

        if (empty($review))
        {
            return $this->respondNotFound('Sorry, the requested review was not found');
        }

        if (Auth::user()->cant('delete', $review))
        {
            return $this->respondForbidden('You dont have the permissions');
        }

        if ($review->delete())
        {
            return $this->respondSuccess('Review successfully deleted');
        }

        return $this->respondInternalError('Something went wrong, action could not be completed');
    }

    public function showUserReviews($id)
    {
        $user = User::find($id);

        if (empty($user))
        {
            return $this->respondNotFound('Requested user not found');
        }

        $reviews = $user
            ->reviews()
            ->join('games', 'reviews.game_id', '=', 'games.id')
            ->select('reviews.*', 'games.image', 'games.title')
            ->get();

        if ($reviews->isEmpty())
        {
            return $this->respondSuccess('There are no reviews');
        }

        return ReviewResource::collection($reviews);
    }

    public function showGameReviews($id)
    {
        $game = Game::find($id);

        if (empty($game))
        {
            return $this->respondNotFound('Requested game not found');
        }

        $reviews = $game->reviewsWithUsers;

        if ($reviews->isEmpty())
        {
            return $this->respondSuccess('There are no reviews');
        }

        return UserReviewResource::collection($reviews);
    }

    public function showOverallStatistics($id)
    {
        $game = Game::find($id);

        if (empty($game))
        {
            return $this->respondNotFound('Requested game not found');
        }

        $game_reviews = Review::gameReviews($id)->count();

        if ($game_reviews == 0)
        {
            return $this->respondCustom([
                'stats'=> 'There are no reviews'
            ]);
        }

        $recommended_game_reviews = Review::gameReviews($id)->recommended()->count();

        if ($recommended_game_reviews == 0)
        {
            return $this->respondCustom([
                'stats'=> '0% positive ('.$game_reviews.' total)'
            ]);
        }

        $positive_percentage = round($recommended_game_reviews/$game_reviews, 2)*100;

        return $this->respondCustom([
            'stats'=> $positive_percentage.'% positive ('.$game_reviews.' total)'
        ]);
    }

}
