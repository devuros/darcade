<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Game;
use App\Publisher;
use App\Http\Resources\PublisherResource;
use App\Http\Resources\PublisherCollection;

use App\Http\Resources\GameResource;
use Illuminate\Support\Facades\Auth;

class PublisherController extends ApiController
{

    public function __construct()
    {

        $this->middleware('auth:api')->only(['store', 'update', 'destroy']);

    }

    /**
     * Get all publishers
     */
    public function index()
    {

        $publishers = Publisher::all();

        return PublisherResource::collection($publishers);

    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {

        if (Auth::user()->cant('store', 'App\Publisher'))
        {

            return $this->respondForbidden('You dont have the permissions');

        }

        $validatedData = $request->validate([

            'publisher'=> 'required|string'

        ]);

        $publisher = new Publisher;

        $publisher->publisher = $validatedData['publisher'];

        $publisher->save();

        return $this->respondCreated('Publisher successfully created');

    }

    /**
     * Get one publisher
     */
    public function show($id)
    {

        $publisher = Publisher::find($id);

        if (empty($publisher))
        {

            return $this->respondNotFound('Sorry, the requested publisher was not found');

        }

        return new PublisherResource($publisher);

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

        $publisher = Publisher::find($id);

        if (empty($publisher))
        {

            return $this->respondNotFound('Sorry, the requested publisher was not found');

        }

        if (Auth::user()->cant('update', $publisher))
        {

            return $this->respondForbidden('You dont have the permissions');

        }

        $validatedData = $request->validate([

            'publisher'=> 'required|string'

        ]);

        $publisher->publisher = $validatedData['publisher'];

        $publisher->save();

        return $this->respondSuccess('Publisher updated successfully');

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
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

    /**
     * Get the requested game's publisher
     */
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
