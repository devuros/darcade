<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Game;
use App\Screenshot;
use App\Http\Resources\ScreenshotResource;
use App\Http\Resources\ScreenshotCollection;

class ScreenshotController extends ApiController
{

    /**
     * Get all screenshots
     */
    public function index()
    {

        $screenshots = Screenshot::all();

        return ScreenshotResource::collection($screenshots);

    }

    /**
     * Store a newly created screenshot
     */
    public function store(Request $request)
    {

        //

    }

    /**
     * Get one screenshot
     */
    public function show($id)
    {

        $screenshot = Screenshot::find($id);

        if (empty($screenshot))
        {

            return $this->respondNotFound('Sorry, the requested screenshot was not found');

        }

        return new ScreenshotResource($screenshot);

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
        // route disabled
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
     * Get the requested game's screenshots
     */
    public function showGameScreenshots($id)
    {

        $game = Game::find($id);

        if (empty($game))
        {

            return $this->respondNotFound('Requested game not found');

        }

        $screenshots = $game->screenshots;

        if ($screenshots->isEmpty())
        {

            return $this->respondSuccess('There are no screenshots');

        }

        return ScreenshotResource::collection($screenshots);

    }

}
