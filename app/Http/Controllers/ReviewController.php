<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Game;
use App\User;
use App\Review;
use App\Http\Resources\ReviewResource;
use App\Http\Resources\UserReviewResource;

use Illuminate\Support\Facades\Auth;

class ReviewController extends ApiController
{

    public function __construct()
    {

        $this->middleware('auth:api')->only('showCurrentUserReviews');

    }

    /**
     * Get the authenticated user's reviews
     */
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

    /**
     */
    public function index()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }

    /**
     * Get the requested user's reviews
     */
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

    /**
     * Get the requested game's reviews
     */
    public function showGameReviews($id)
    {

        $game = Game::find($id);

        if (empty($game))
        {

            return $this->respondNotFound('Requested game not found');

        }

        $reviews = $game->reviews;

        if ($reviews->isEmpty())
        {

            return $this->respondSuccess('There are no reviews');

        }

        return UserReviewResource::collection($reviews);

    }

}
