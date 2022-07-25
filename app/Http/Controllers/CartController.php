<?php

namespace App\Http\Controllers;

use App\Models\Cart;
use App\Models\Order;
use App\Models\Product;
use App\Models\CartItem;
use App\Models\UserOrder;
use App\Models\ProductOrder;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class CartController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */

    public function index()
    {
        $products = Product::all();

        $carts = Cart::where('user_id', auth()->user()->id)
            ->join('cart_items', 'carts.id', '=', 'cart_items.cart_id')
            ->join('products', 'cart_items.product_id', '=', 'products.id')
            ->get();

        $total = 0;
        foreach ($carts as $cart) {
            $total += $cart->price * $cart->quantity;
            }   

      

        return view('product.index', compact('products', 'carts', 'total'));
    }

    public function addToCart(Request $request, $user_id, $product_id)
    {
        $cart = Cart::where('user_id', $user_id)->first();
        if ($cart) {
            $cartItem = CartItem::where('cart_id', $cart->id)->where('product_id', $product_id)->first();
            if ($cartItem) {
                $cartItem->quantity += 1;
                $cart->total_product += 1;
                $cart->save();
                $cartItem->save();
            } else {
                CartItem::create([
                    'cart_id' => $cart->id,
                    'product_id' => $product_id,
                    'quantity' => 1,
                ]);
            }
        } else {
            $cart = Cart::create([
                'user_id' => $user_id,
                'total_product' => 1,
            ]);
            CartItem::create([
                'cart_id' => $cart->id,
                'product_id' => $product_id,
                'quantity' => 1,
            ]);
        }
        return redirect()->back();
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function subtractCartItemQuantity(Request $request, $user_id, $product_id)
    {
        $cart = Cart::where('user_id', $user_id)->first();

        if ($cart) {
            $cartItem = CartItem::where('cart_id', $cart->id)->where('product_id', $product_id)->first();
            if ($cartItem) {
                if ($cartItem->quantity > 1) {
                    $cartItem->quantity -= 1;
                    $cart->total_product -= 1;
                    $cart->save();
                    $cartItem->save();
                } else {
                    $cartItem->delete();
                    $cart->total_product -= 1;
                    $cart->save();
                }
            }
        }
        return redirect()->back();
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function addCartItemQuantity(Request $request, $user_id, $product_id)
    {
        $cart = Cart::where('user_id', $user_id)->first();
        if ($cart) {
            $cartItem = CartItem::where('cart_id', $cart->id)->where('product_id', $product_id)->first();
            if ($cartItem) {
                $cartItem->quantity += 1;
                $cart->total_product += 1;
                $cart->save();
                $cartItem->save();
            }
        }
        return redirect()->back();
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Cart  $cart
     * @return \Illuminate\Http\Response
     */
    public function show(Cart $cart)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Cart  $cart
     * @return \Illuminate\Http\Response
     */
    public function edit(Cart $cart)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Cart  $cart
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Cart $cart)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Cart  $cart
     * @return \Illuminate\Http\Response
     */
    public function destroy(Cart $cart)
    {
        //
    }

    public function order_index()
    {
        $carts = Cart::where('user_id', auth()->user()->id)
        ->join('cart_items', 'carts.id', '=', 'cart_items.cart_id')
        ->join('products', 'cart_items.product_id', '=', 'products.id')
        ->get();

    $userorders = UserOrder::where('user_id', auth()->user()->id)->get();

    $customerOrders = [];
    $orderdetails = [];

    foreach ($userorders as $key => $order) {
        $productOrders = ProductOrder::where('order_id', $order->order_id)
        ->join('products', 'product_orders.product_id', '=', 'products.id')
        ->get();

        $orders = Order::where('id', $order->order_id)->get();

        array_push($customerOrders, $productOrders);
        array_push($orderdetails, $orders);
    }
    


    // $userorders = UserOrder::where('user_id', auth()->user()->id)
    //     ->join('orders', 'user_orders.order_id', '=', 'orders.id')
    //     ->join('product_orders', 'orders.id', '=', 'product_orders.order_id')
    //     ->join('products', 'product_orders.product_id', '=', 'products.id')
    //     ->get();

    // $orders = Order::where('user_id', auth()->user()->id)
    //     ->join('product_orders', 'orders.id', '=', 'product_orders.order_id')
    //     ->join('products', 'product_orders.product_id', '=', 'products.id')
    //     ->get();

    return view('order.index', compact('carts','customerOrders', 'orderdetails'));
    }

}
