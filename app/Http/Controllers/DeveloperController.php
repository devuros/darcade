<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Developer;
use App\Http\Resources\DeveloperResource;
use App\Http\Resources\DeveloperCollection;

class DeveloperController extends ApiController
{

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
        //
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
