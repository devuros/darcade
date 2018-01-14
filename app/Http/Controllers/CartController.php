<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\User;
use App\Cart;
use App\Order;
use App\Purchase;

use App\Http\Resources\GameResource;
use Illuminate\Support\Facades\Auth;

use App\Http\Requests\StoreCart;

class CartController extends ApiController
{

    public function __construct()
    {

        $this->middleware('auth:api');

    }

    /**
     * Get the authenticated user's cart content
     */
    public function index(Request $request)
    {

        $cart_content = User::find(Auth::id())->cart;

        if ($cart_content->isEmpty())
        {

            return $this->respondSuccess('Your cart is empty');

        }

        return GameResource::collection($cart_content);

    }

    /**
     * Add an item to the authenticated user's cart
     */
    public function store(StoreCart $request)
    {

        $cart = new Cart;

        $cart->user_id = Auth::id();
        $cart->game_id = $request->game;

        $cart->save();

        return $this->respondCreated('Game successfully added to cart');

    }

    /**
     * Remove an item from the authenticated user's cart
     */
    public function destroy($id)
    {

        $cart_item = Cart::find($id);

        if (empty($cart_item))
        {

            return $this->respondConflict('Cannot remove resource because it does not exist');

        }

        if (Auth::user()->cant('delete', $cart_item))
        {

            return $this->respondForbidden('Forbidden, you don not have the permission');

        }

        $cart_item->delete();

        return $this->respondSuccess('Game successfully removed from cart');

    }

    /**
     * Empty the authenticated user's cart
     */
    public function empty(Request $request)
    {

        $cart_content = User::find(Auth::id())->cart;

        if ($cart_content->isEmpty())
        {

            return $this->respondConflict('Nothing to remove, your cart is empty');

        }

        if (Cart::where('user_id', Auth::id())->delete())
        {

            return $this->respondSuccess('Cart successfully emptied');

        }

        return $this->respondInternalError('Something went wrong, action could not be completed');

    }

    /**
     * Checkout the authenticated user's cart content
     */
    public function checkout(Request $request)
    {

        $user_id = Auth::id();

        $content = User::find($user_id)->cart;

        if ($content->isEmpty())
        {

            return $this->respondConflict('Nothing to checkout, your cart is empty');

        }

        $order = new Order;

        $order->user_id = $user_id;
        $order->total = 0;

        $order->save();

        $order_id = $order->id;

        $total = 0;

        $time = \Carbon\Carbon::now();

        foreach ($content as $item)
        {
            $actual_price = $item->base_price;

            if ($item->is_on_sale)
            {
                $actual_price = $item->sale_price;
            }

            $total += $actual_price;

            $purchase = new Purchase;

            $purchase->game_id = $item->id;
            $purchase->order_id = $order_id;
            $purchase->actual_price = $actual_price;

            $purchase->save();

            \DB::table('game_user')->insert([

                'game_id'=> $item->id,
                'user_id'=> $user_id,
                'created_at'=> $time,
                'updated_at'=> $time

            ]);

        }

        $order->total = $total;

        $order->save();

        Cart::where('user_id', $user_id)->delete();

        return $this->respondSuccess('Items successfully purchased, enjoy!');

    }

}
