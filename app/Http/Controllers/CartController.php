<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\User;
use App\Cart;

use App\Http\Resources\GameResource;
use Illuminate\Support\Facades\Auth;

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

        $user_id = $request->user()->id;

        $validatedData = request()->validate([

            'game'=> 'required|integer|exists:games,id'

        ]);

        $cart = new Cart;

        $cart->user_id = $user_id;
        $cart->game_id = $validatedData['game'];

        $cart->save();

        return $this->respondCreated('Game successfully added to cart');

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {

        $cart = Cart::find($id);

        if (empty($cart))
        {

            return $this->respondConflict('Cannot remove resource because it does not exist');

        }

        if ($cart->user_id != Auth::id())
        {

            return $this->respondForbidden('Forbidden, you don not have the permission');

        }

        $cart->delete();

        return $this->respondSuccess('Game successfully removed from cart');

    }

    /**
     * Empty the cart's content
     */
    public function empty(Request $request)
    {

        $user_id = $request->user()->id;

        $content = User::find($user_id)->cart;

        if ($content->isEmpty())
        {

            return $this->respondConflict('Nothing to remove, your cart is empty');

        }

        Cart::where('user_id', $user_id)->delete();

        return $this->respondSuccess('Cart successfully emptied');

    }

}
