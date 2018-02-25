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

    public function index(Request $request)
    {
        $user_id = $request->user()->id;
        $purchases = User::find($user_id)->userPurchases()->get();

        if ($purchases->isEmpty())
        {
            return $this->respondSuccess('You have no purchase history');
        }

        return PurchaseResource::collection($purchases);
    }

    public function store(Request $request)
    {
        // route disabled
    }

    public function show($id)
    {
        $user_id = Auth::id();
        $purchase = User::find($user_id)->userPurchases()->where('purchases.id', $id)->first();

        if (empty($purchase))
        {
            return $this->respondNotFound('Purchase not found');
        }

        return new PurchaseResource($purchase);
    }

}
