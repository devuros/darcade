<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\User;
use App\Purchase;
use App\Http\Resources\PurchaseResource;
use App\Http\Resources\PurchaseCollection;

use Illuminate\Support\Facades\Auth;

class PurchaseController extends ApiController
{

    public function __construct()
    {

        $this->middleware('auth:api');

    }

    /**
     * Get the authenticated user's purchase history
     */
    public function index(Request $request)
    {

        $user_id = $request->user()->id;

        $purchases = User::find($user_id)->purchases;

        if ($purchases->isEmpty())
        {

            return $this->respondSuccess('You have no purchase history');

        }

        return PurchaseResource::collection($purchases);

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
     * Get the authenticated user's purchase details
     */
    public function show($id)
    {

        $user_id = Auth::id();

        $purchase = User::find($user_id)->purchases()->where('purchases.id', $id)->first();

        if (empty($purchase))
        {

            return $this->respondNotFound('Purchase not found');

        }

        return new PurchaseResource($purchase);

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
