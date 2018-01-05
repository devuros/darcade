<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\User;
use App\Http\Resources\GameResource;

use Illuminate\Support\Facades\Auth;

class WishController extends ApiController
{

    public function __construct()
    {

        $this->middleware('auth:api')->only('index');

    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {

        $wishes = User::find(Auth::id())->wishes;

        if ($wishes->isEmpty())
        {

            return $this->respondSuccess('You dont have any games in wishlist');

        }

        return GameResource::collection($wishes);

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
     * Get the requested user's wishes
     */
    public function showUserWishes($id)
    {

        $user = User::find($id);

        if (empty($user))
        {

            return $this->respondNotFound('Requested user not found');

        }

        $games = $user->wishes;

        if ($games->isEmpty())
        {

            return $this->respondSuccess('There are no games');

        }

        return GameResource::collection($games);

    }

}
