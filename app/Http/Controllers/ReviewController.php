<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\User;
use App\Review;
use App\Http\Resources\ReviewResource;

use Illuminate\Support\Facades\Auth;

class ReviewController extends ApiController
{

    public function __construct()
    {

        $this->middleware('auth:api')->only('index');

    }

    /**
     * Get the reviews of the authenticated user
     */
    public function index()
    {

        $reviews = User::find(Auth::id())->reviews;

        if ($reviews->isEmpty())
        {

            return $this->respondSuccess('You didnt write any reviews');

        }

        return ReviewResource::collection($reviews);

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

        $reviews = $user->reviews;

        if ($reviews->isEmpty())
        {

            return $this->respondSuccess('There are no reviews');

        }

        return ReviewResource::collection($reviews);

    }

}
