<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Screenshot;
use App\Publisher;
use App\Developer;
use App\Genre;
use App\Game;
use App\Http\Resources\GameResource;
use App\Http\Resources\GameCollection;

use Illuminate\Support\Facades\Auth;

use App\Http\Requests\StoreGame;

class GameController extends ApiController
{

    /**
     * Get all games
     */
    public function index()
    {

        $games = Game::all();

        return GameResource::collection($games);

    }

    /**
     * Store a newly created game
     */
    public function store(StoreGame $request)
    {

        // to do

    }


    /**
     * Get one game
     */
    public function show($id)
    {

        $game = Game::find($id);

        if (empty($game))
        {

            return $this->respondNotFound('Sorry, the requested game was not found');

        }

        return new GameResource($game);

    }

    /**
     * Update the specified game
     */
    public function update(Request $request, $id)
    {

        // to do

    }

    /**
     * Remove the specified game
     */
    public function destroy($id)
    {

        // to do

    }

    /**
     * Get the requested genre games
     */
    public function showGenreGames($id)
    {

        $genre = Genre::find($id);

        if (empty($genre))
        {

            return $this->respondNotFound('Requested genre not found');

        }

        $games = $genre->games;

        if ($games->isEmpty())
        {

            return $this->respondSuccess('There are no games');

        }

        return GameResource::collection($games);

    }

    /**
     * Get the requested developer's games
     */
    public function showDeveloperGames($id)
    {

        $developer = Developer::find($id);

        if (empty($developer))
        {

            return $this->respondNotFound('Requested developer not found');

        }

        $games = $developer->games;

        if ($games->isEmpty())
        {

            return $this->respondSuccess('There are no games');

        }

        return GameResource::collection($games);

    }

    /**
     * Get the requested publisher's games
     */
    public function showPublisherGames($id)
    {

        $publisher = Publisher::find($id);

        if (empty($publisher))
        {

            return $this->respondNotFound('Requested publisher not found');

        }

        $games = $publisher->games;

        if ($games->isEmpty())
        {

            return $this->respondSuccess('There are no games');

        }

        return GameResource::collection($games);

    }

    /**
     * Get the requested screenshot game
     */
    public function showScreenshotGame($id)
    {

        $screenshot = Screenshot::find($id);

        if (empty($screenshot))
        {

            return $this->respondNotFound('Requested screenshot not found');

        }

        $game = $screenshot->game;

        if (empty($game))
        {

            return $this->respondSuccess('There is no game');

        }

        return new GameResource($game);

    }

}
