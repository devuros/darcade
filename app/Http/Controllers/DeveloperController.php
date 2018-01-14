<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Game;
use App\Developer;
use App\Http\Resources\DeveloperResource;
use App\Http\Resources\DeveloperCollection;

use App\Http\Resources\GameResource;
use Illuminate\Support\Facades\Auth;

use App\Http\Requests\StoreDeveloper;

class DeveloperController extends ApiController
{

    public function __construct()
    {

        $this->middleware('auth:api')->only(['store', 'update', 'destroy']);

    }

    /**
     * Get all developers
     */
    public function index()
    {

        $developers = Developer::all();

        return DeveloperResource::collection($developers);

    }

    /**
     * Store a newly created developer
     */
    public function store(StoreDeveloper $request)
    {

        if (Auth::user()->cant('store', 'App\Developer'))
        {

            return $this->respondForbidden('You dont have the permissions');

        }

        $developer = new Developer;

        $developer->developer = $request->developer;

        $developer->save();

        return $this->respondCreated('Developer successfully created');

    }

    /**
     * Get a single developer
     */
    public function show($id)
    {

        $developer = Developer::find($id);

        if (empty($developer))
        {

            return $this->respondNotFound('Sorry, the requested developer was not found');

        }

        return new DeveloperResource($developer);

    }

    /**
     * Update the specified developer
     */
    public function update(StoreDeveloper $request, $id)
    {

        $developer = Developer::find($id);

        if (empty($developer))
        {

            return $this->respondNotFound('Sorry, the requested developer was not found');

        }

        if (Auth::user()->cant('update', $developer))
        {

            return $this->respondForbidden('You dont have the permissions');

        }

        $developer->developer = $request->developer;

        $developer->save();

        return $this->respondSuccess('Developer updated successfully');

    }

    /**
     * Remove the specified developer
     */
    public function destroy($id)
    {

        $developer = Developer::find($id);

        if (empty($developer))
        {

            return $this->respondNotFound('Sorry, the requested developer was not found');

        }

        if (Auth::user()->cant('delete', $developer))
        {

            return $this->respondForbidden('You dont have the permissions');

        }

        $developer->delete();

        return $this->respondSuccess('Developer successfully deleted');

    }

    /**
     * Get the requested game's developer
     */
    public function showGameDeveloper($id)
    {

        $game = Game::find($id);

        if (empty($game))
        {

            return $this->respondNotFound('Requested game not found');

        }

        $developer = $game->developer;

        if (empty($developer))
        {

            return $this->respondSuccess('There are no developers');

        }

        return new DeveloperResource($developer);

    }

}
