<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\User;
use App\Cart;
use App\Order;
use App\Purchase;

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
     * Empty cart content
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

    /**
     * Checkout cart content
     */
    public function checkout(Request $request)
    {

        $user_id = $request->user()->id;

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

    }

}
