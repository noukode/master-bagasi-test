<?php

namespace App\Services;

use App\Http\Resources\CartResource;
use App\Models\Cart;
use App\Models\Product;
use Illuminate\Http\Request;

class CartService
{
    public function list(Request $request)
    {
        $skip = 0;
        $take = 10;

        if($request->page && $request->perPage){
            $skip = $request->perPage * ($request->page - 1);
            $take = $request->perPage;
        }

        $query = Cart::select()->with('product_detail')->where('user_id', auth()->user()->id);

        if($request->direction){
            $query = $query->orderBy('created_at', $request->direction);
        }

        $totalCount = $query->count();

        $result = $query->skip($skip)->take($take)->get();

        return [
            'totalCount' => $totalCount,
            'data' => $result,
        ];

    }

    public function addItemToCart(Request $request)
    {
        $cart = Cart::where('product_id', $request->product_id)->first();
        $product = Product::where('id', $request->product_id)->first();

        if(!$cart){
            if($product->stock >= $request->qty){
                return Cart::create([
                    'product_id' => $request->product_id,
                    'user_id' => auth()->user()->id,
                    'qty' => $request->qty,
                ]);
            }
            return false;
        }

        if($product->stock >= ($cart->qty + $request->qty)){
            $cart->qty += $request->qty;
            $cart->save();
            return $cart;
        }

        return false;
    }

    public function updateItemInCart(Request $request, $id)
    {
        $cart = Cart::where('id', $id)->first();

        if(!$cart){
            return [
                'success' => false,
                'message' => 'Item not found!',
            ];
        }

        $product = Product::where('id', $cart->product_id)->where('is_published', 1)->first();

        if(!$product){
            return [
                'success' => false,
                'message' => 'Product is not available',
            ];
        }

        if($product->stock >= ($request->qty)){
            $cart->qty = $request->qty;
            $cart->save();

            return [
                'success' => true,
                'message' => 'Process success',
                'data' => $cart,
            ];
        }

        return [
            'success' => false,
            'message' => 'Stock is not available',
        ];
    }

    public function deleteItemInCart($id)
    {
        $cart = Cart::where('id', $id)->first();

        if(!$cart){
            return [
                'success' => false,
                'message' => 'Data not found',
            ];
        }

        $cart->delete();

        return [
            'success' => true,
            'message' => 'Delete success',
        ];
    }
}
