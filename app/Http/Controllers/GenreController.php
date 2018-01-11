<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Genre;
use App\Http\Resources\GenreResource;
use App\Http\Resources\GenreCollection;
use Illuminate\Support\Facades\Auth;

class GenreController extends ApiController
{

    public function __construct()
    {

        $this->middleware('auth:api')->only(['store', 'update', 'destroy']);

    }

    /**
     * Get all genres
     */
    public function index()
    {

        $genres = Genre::all();

        return GenreResource::collection($genres);

    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {

        if (Auth::user()->cant('store', 'App\Genre'))
        {

            return $this->respondForbidden('You dont have the permissions');

        }

        $validatedData = $request->validate([

            'genre'=> 'required|string'

        ]);

        $genre = new Genre;

        $genre->genre = $validatedData['genre'];

        $genre->save();

        return $this->respondCreated('Genre successfully created');

    }

    /**
     * Get one genre
     */
    public function show($id)
    {

        $genre = Genre::find($id);

        if (empty($genre))
        {

            return $this->respondNotFound('Sorry, the requested genre was not found');

        }

        return new GenreResource($genre);

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
}
