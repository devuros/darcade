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

        $this->middleware('auth:api')->except('showUserLibrary');

    }

    /**
     * Get authenticated user's library
     */
    public function showCurrentUserLibrary()
    {

        $library = User::find(Auth::id())->library;

        if ($library->isEmpty())
        {

            return $this->respondSuccess('You dont own any games');

        }

        return GameResource::collection($library);

    }

    /**
     */
    public function index()
    {
        // route disabled
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        // ?
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
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        // route disabled
    }

    /**
     * Get the requested user's library
     */
    public function showUserLibrary($id)
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
