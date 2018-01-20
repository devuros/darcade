<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Wish;
use App\Library;
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
     *
     */
    public function show($id)
    {
        // route disabled
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

        \DB::transaction(function () use ($user_id, $content) {

            // insert a new order without total amount

            $order = new Order;

            $order->user_id = $user_id;
            $order->total = 0;

            $order->save();

            // get the inserted id

            $order_id = $order->id;

            // calculate the sum of all games

            $total = 0;

            foreach ($content as $game)
            {

                $actual_price = $game->base_price;

                if ($game->is_on_sale)
                {

                    $actual_price = $game->sale_price;

                }

                $total += $actual_price;

                // insert each game into purchases

                $purchase = new Purchase;

                $purchase->game_id = $game->id;
                $purchase->order_id = $order_id;
                $purchase->actual_price = $actual_price;

                $purchase->save();

                // insert each game into library

                $library = new Library;

                $library->game_id = $game->id;
                $library->user_id = $user_id;

                $library->save();

                // remove the purchased game if it is in wishlist

                $wish_exists = Wish::where([

                    ['user_id', '=', $user_id],
                    ['game_id', '=', $game->id]

                ])->exists();

                if ($wish_exists)
                {

                    Wish::where([

                        ['user_id', '=', $user_id],
                        ['game_id', '=', $game->id]

                    ])->delete();

                }

            }

            // update total amount

            $order->total = $total;

            $order->save();

            // empty the cart

            Cart::where('user_id', $user_id)->delete();

        }, 2);

        // everything was successful

        return $this->respondSuccess('Purchase successful, enjoy!');

    }

}
