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
use Illuminate\Support\Facades\Storage;

use App\Http\Requests\StoreGame;
use App\Http\Requests\UpdateGame;

class GameController extends ApiController
{

    public function __construct()
    {

        $this->middleware('auth:api')->only(['store', 'update', 'destroy']);

    }

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

        if (Auth::user()->cant('create', 'App\Game'))
        {

            return $this->respondForbidden('You dont have the permissions');

        }

        if (!$request->hasFile('image'))
        {

            return $this->respondInternalError('No image uploaded');

        }

        if (!$request->file('image')->isValid())
        {

            return $this->respondInternalError('Selected image is not valid');

        }

        \DB::beginTransaction();

        try
        {

            $path = $request->image->store('games', 'public');

            $game = new Game;

            $game->title = $request->title;
            $game->image = $path;
            $game->release_date = $request->release_date;
            $game->description = $request->description;
            $game->about = $request->about;
            $game->developer_id = $request->developer;
            $game->publisher_id = $request->publisher;
            $game->base_price = $request->base_price;
            $game->sale_price = $request->sale_price;
            $game->is_on_sale = $request->is_on_sale;

            $game->save();

            \DB::commit();

            return $this->respondCreated('Game successfully created');

        }
        catch (\Throwable $e)
        {

            \DB::rollback();

            return $this->respondInternalError('Something went wrong, action could not be completed');

        }

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
    public function update(UpdateGame $request, $id)
    {

        $game = Game::find($id);

        if (empty($game))
        {

            return $this->respondNotFound('Sorry, the requested game was not found');

        }

        if (Auth::user()->cant('update', $game))
        {

            return $this->respondForbidden('You dont have the permissions');

        }

        \DB::beginTransaction();

        try
        {

            // check if user wants to change the game's image

            $action = '';

            if ($request->has('image'))
            {

                if ($request->hasFile('image'))
                {

                    if ($request->file('image')->isValid())
                    {

                        if (Storage::disk('public')->exists($game->image))
                        {

                            Storage::disk('public')->delete($game->image);

                            $path = $request->image->store('games', 'public');

                            $action = 'new image uploaded';

                        }
                        else
                        {

                            return $this->respondConflict('File could not be found on disk');

                        }

                    }
                    else
                    {

                        return $this->respondInternalError('Selected image is not valid');

                    }

                }
                else
                {

                    $path = $game->image;

                    $action = 'image field is present but empty';

                }

            }
            else
            {

                $path = $game->image;

                $action = 'image field is not present';

            }

            $game->title = $request->title;
            $game->image = $path;
            $game->release_date = $request->release_date;
            $game->description = $request->description;
            $game->about = $request->about;
            $game->developer_id = $request->developer;
            $game->publisher_id = $request->publisher;
            $game->base_price = $request->base_price;
            $game->sale_price = $request->sale_price;

            $game->save();

            \DB::commit();

            return $this->respondCreated('Game successfully updated: '.$action);

        }
        catch (\Throwable $e)
        {

            \DB::rollback();

            return $this->respondInternalError('Something went wrong, action could not be completed');

        }

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
