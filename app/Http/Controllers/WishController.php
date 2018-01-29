<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Wish;
use App\User;
use App\Http\Resources\GameResource;
use App\Http\Resources\WishResource;

use Illuminate\Support\Facades\Auth;

use App\Http\Requests\StoreWish;

class WishController extends ApiController
{

    public function __construct()
    {

        $this->middleware('auth:api')->only(['showCurrentUserWishes', 'store', 'destroy']);

    }

    /**
     * Get the authenticated user's wishes
     */
    public function showCurrentUserWishes()
    {

        $wishes = User::find(Auth::id())->wishes;

        if ($wishes->isEmpty())
        {

            return $this->respondSuccess('You dont have any games in wishlist');

        }

        $wishes_with_date = Wish::where('user_id', Auth::id())
            ->join('games', 'wishes.game_id', '=' , 'games.id')
            ->select('games.*', 'wishes.id as wish', 'wishes.created_at as created')
            ->get();

        return WishResource::collection($wishes_with_date);

    }

    /**
     *
     */
    public function index()
    {
        // route disabled
    }

    /**
     * Store a newly created wish
     */
    public function store(StoreWish $request)
    {

        if (Auth::user()->cant('create', 'App\Wish'))
        {

            return $this->respondForbidden('You dont have the permissions');

        }

        $wish_exists = User::find(Auth::id())
            ->wishes()
            ->where('game_id', $request->game)
            ->exists();

        if ($wish_exists)
        {

            return $this->respondForbidden('You already have this game in your wishlist');

        }

        $wish = new Wish;

        $wish->game_id = $request->game;
        $wish->user_id = Auth::id();

        $wish->save();

        return $this->respondCreated('Wish successfully created');

    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        // route disabled
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
        // route disabled
    }

    /**
     * Remove the specified wish
     */
    public function destroy($id)
    {

        $wish = Wish::find($id);

        if (empty($wish))
        {

            return $this->respondNotFound('Sorry, the requested wish was not found');

        }

        if (Auth::user()->cant('delete', $wish))
        {

            return $this->respondForbidden('You dont have the permissions');

        }

        if ($wish->delete())
        {

            return $this->respondSuccess('Wish successfully removed');

        }

        return $this->respondInternalError('Something went wrong, action could not be completed');

    }

    /**
     * Get the requested user's wishes
     */
    public function showUserWishes($id)
    {

        $user = User::find($id);

        if (empty($user))
        {

            return $this->respondNotFound('Requested user was not found');

        }

        $games = $user->wishes;

        if ($games->isEmpty())
        {

            return $this->respondSuccess('There are no games');

        }

        $wishes_with_date = Wish::where('user_id', $id)
            ->join('games', 'wishes.game_id', '=' , 'games.id')
            ->select('games.*', 'wishes.id as wish', 'wishes.created_at as created')
            ->get();

        return WishResource::collection($wishes_with_date);

    }

}
