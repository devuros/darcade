<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\User;
use App\Http\Resources\GameResource;

use Illuminate\Support\Facades\Auth;

class LibraryController extends ApiController
{

    public function __construct()
    {

        $this->middleware('auth:api')->only('index');

    }

    /**
     * Get current user's games
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {

        $library = User::find(Auth::id())->library;

        if ($library->isEmpty())
        {

            return $this->respondSuccess('You dont own any games');

        }

        return GameResource::collection($library);

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
     * Get the requested user's games
     */
    public function showUserGames($id)
    {

        $user = User::find($id);

        if (empty($user))
        {

            return $this->respondNotFound('Requested user not found');

        }

        $games = $user->library;

        if ($games->isEmpty())
        {

            return $this->respondSuccess('There are no games');

        }

        return GameResource::collection($games);

    }

}
