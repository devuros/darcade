<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Screenshot;
use App\Http\Resources\ScreenshotResource;
use App\Http\Resources\ScreenshotCollection;

class ScreenshotController extends ApiController
{

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {

        $screenshots = Screenshot::all();

        return ScreenshotResource::collection($screenshots);

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
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
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
