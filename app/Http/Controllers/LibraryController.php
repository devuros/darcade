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

    public function showCurrentUserLibrary()
    {
        $library = User::find(Auth::id())->library;

        if ($library->isEmpty())
        {
            return $this->respondSuccess('You dont own any games');
        }

        return GameResource::collection($library);
    }

    public function index()
    {
        // route disabled
    }

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
