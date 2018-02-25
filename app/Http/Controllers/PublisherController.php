<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Game;
use App\Publisher;
use App\Http\Resources\PublisherResource;
use App\Http\Resources\PublisherCollection;
use App\Http\Resources\GameResource;
use Illuminate\Support\Facades\Auth;
use App\Http\Requests\StorePublisher;

class PublisherController extends ApiController
{
    public function __construct()
    {
        $this->middleware('auth:api')->only(['store', 'update', 'destroy']);
    }

    public function index()
    {
        $publishers = Publisher::all();

        return PublisherResource::collection($publishers);
    }

    public function store(StorePublisher $request)
    {
        if (Auth::user()->cant('store', 'App\Publisher'))
        {
            return $this->respondForbidden('You dont have the permissions');
        }

        $publisher = new Publisher;
        $publisher->publisher = $request->publisher;
        $publisher->save();

        return $this->respondCreated('Publisher successfully created');
    }

    public function show($id)
    {
        $publisher = Publisher::find($id);

        if (empty($publisher))
        {
            return $this->respondNotFound('Sorry, the requested publisher was not found');
        }

        return new PublisherResource($publisher);
    }

    public function update(StorePublisher $request, $id)
    {
        $publisher = Publisher::find($id);

        if (empty($publisher))
        {
            return $this->respondNotFound('Sorry, the requested publisher was not found');
        }

        if (Auth::user()->cant('update', $publisher))
        {
            return $this->respondForbidden('You dont have the permissions');
        }

        $publisher->publisher = $request->publisher;
        $publisher->save();

        return $this->respondSuccess('Publisher updated successfully');
    }

    public function destroy($id)
    {
        $publisher = Publisher::find($id);

        if (empty($publisher))
        {
            return $this->respondNotFound('Sorry, the requested publisher was not found');
        }

        if (Auth::user()->cant('delete', $publisher))
        {
            return $this->respondForbidden('You dont have the permissions');
        }

        $publisher->delete();

        return $this->respondSuccess('Publisher successfully deleted');
    }

    public function showGamePublisher($id)
    {
        $game = Game::find($id);

        if (empty($game))
        {
            return $this->respondNotFound('Requested game not found');
        }

        $publisher = $game->publisher;

        if (empty($publisher))
        {
            return $this->respondSuccess('There are no publishers');
        }

        return new PublisherResource($publisher);
    }

}
