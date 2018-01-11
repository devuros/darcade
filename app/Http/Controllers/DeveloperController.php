<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Developer;
use App\Http\Resources\DeveloperResource;
use App\Http\Resources\DeveloperCollection;

use App\Http\Resources\GameResource;
use Illuminate\Support\Facades\Auth;

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
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {

        if (Auth::user()->cant('store', 'App\Developer'))
        {

            return $this->respondForbidden('You dont have the permissions');

        }

        $validatedData = $request->validate([

            'developer'=> 'required|string'

        ]);

        $developer = new Developer;

        $developer->developer = $validatedData['developer'];

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
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
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

        $validatedData = $request->validate([

            'developer'=> 'required|string'

        ]);

        $developer->developer = $validatedData['developer'];

        $developer->save();

        return $this->respondSuccess('Developer updated successfully');

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
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

}
