<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use App\Screenshot;
use App\Publisher;
use App\Developer;
use App\Genre;
use App\Game;
use App\GameGenre;
use App\Http\Resources\SimpleGameResource;
use App\Http\Resources\SimplestGameResource;
use App\Http\Resources\GameResource;
use App\Http\Resources\GameCollection;
use App\Http\Resources\DeveloperResource;
use App\Http\Resources\PublisherResource;
use App\Http\Requests\StoreGame;
use App\Http\Requests\UpdateGame;
use App\Http\Requests\StoreGameGenre;
use App\Http\Requests\UpdateGameIsOnSale;

class GameController extends ApiController
{
    public function __construct()
    {
        $this->middleware('auth:api')->only(['store', 'update', 'destroy', 'updateGameIsOnSale', 'attachGenre']);
    }

    public function index()
    {
        $games = Game::all();

        return GameResource::collection($games);
    }

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
            $game->is_featured = false;
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

    public function show($id)
    {
        $game = Game::find($id);

        if (empty($game))
        {
            return $this->respondNotFound('Sorry, the requested game was not found');
        }

        return new GameResource($game);
    }

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
            // check whether the user wants to change the game's image
            $action = '';

            if ($request->has('image'))
            {
                if ($request->hasFile('image'))
                {
                    $action = 'image field is present';

                    if ($request->file('image')->isValid())
                    {
                        $action = 'image field is present and valid';

                        if (Storage::disk('public')->exists($game->image))
                        {
                            Storage::disk('public')->delete($game->image);

                            $path = $request->image->store('games', 'public');
                            $action = 'old image was deleted, new one is uploaded';
                        }
                        else
                        {
                            return $this->respondConflict('old image could not be found on disk');
                        }
                    }
                    else
                    {
                        return $this->respondInternalError('Selected image is not valid');
                    }
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

    public function destroy($id)
    {
        $game = Game::find($id);

        if (empty($game))
        {
            return $this->respondNotFound('Sorry, the requested game was not found');
        }

        if (Auth::user()->cant('delete', $game))
        {
            return $this->respondForbidden('You dont have the permissions');
        }

        \DB::beginTransaction();

        try
        {
            $game->delete();

            \DB::commit();

            return $this->respondSuccess('Game successfully removed');
        }
        catch (\Throwable $e)
        {
            \DB::rollback();

            return $this->respondInternalError('Something went wrong, action could not be completed');
        }
    }

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
            return new DeveloperResource($developer);
        }

        return GameResource::collection($games);
    }

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
            return new PublisherResource($publisher);
        }

        return GameResource::collection($games);
    }

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

    public function updateGameIsOnSale(UpdateGameIsOnSale $request, $id)
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

        $game->is_on_sale = $request->is_on_sale;
        $game->save();

        return $this->respondSuccess('Game\'s sale status successfully changed');
    }

    public function attachGenre(StoreGameGenre $request)
    {
        if (Auth::user()->cant('create', 'App\Game'))
        {
            return $this->respondForbidden('You dont have the permissions');
        }

        $game_genre = new GameGenre;
        $game_genre->game_id = $request->game;
        $game_genre->genre_id = $request->genre;
        $game_genre->save();

        return $this->respondCreated('Genre successfully attached to the game');
    }

    public function showGamesUT($limit = 12)
    {
        $games = Game::UnderTen()
            ->limit($limit)
            ->get();

        return SimpleGameResource::collection($games);
    }

    public function showGamesUTF($limit = 12)
    {
        $games = Game::UnderTwentyFive()
            ->limit($limit)
            ->orderBy('base_price', 'desc')
            ->get();

        return SimpleGameResource::collection($games);
    }

    public function specials($limit = 15)
    {
        $games = Game::OnSale()
            ->limit($limit)
            ->inRandomOrder()
            ->get();

        return SimpleGameResource::collection($games);
    }

    public function featured()
    {
        $games = Game::Featured()->get();

        if (count($games) < 1)
        {
            return $this->respondNotFound('Sorry, no featured games found');
        }

        return GameResource::collection($games);
    }

    public function newReleases()
    {
        $games = Game::NewRelease()->get();

        return GameResource::collection($games);
    }

    public function topSellers()
    {
        $top_sellers = \DB::table('purchases')
            ->select('game_id', \DB::raw('count(game_id) as count'), 'games.*')
            ->join('games', 'games.id', '=', 'purchases.game_id')
            ->groupBy('game_id')
            ->orderBy('count', 'desc')
            ->limit(12)
            ->get();

        return SimplestGameResource::collection($top_sellers);
    }

}
