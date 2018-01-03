<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\User;

use App\Http\Resources\GameResource;

class CartController extends ApiController
{

    public function __construct(Request $request)
    {

        $this->middleware('auth:api');

    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {

        $user_id = $request->user()->id;

        $content = User::find($user_id)->cart;

        if ($content->isEmpty())
        {

            return $this->respondSuccess('Your cart is empty');

        }

        return GameResource::collection($content);

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
     * Empty the user's cart content
     */
    public function empty()
    {
        //
    }

}
