<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Publisher;
use App\Http\Resources\PublisherResource;
use App\Http\Resources\PublisherCollection;

use App\Http\Resources\GameResource;

class PublisherController extends ApiController
{

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
        //
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

}
