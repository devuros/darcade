<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Genre;
use App\Game;
use App\Http\Resources\GameResource;
use App\Http\Resources\GameCollection;

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
     * Get games for the requested genre
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

}
