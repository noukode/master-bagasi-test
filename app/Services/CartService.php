<?php

namespace App\Services;

use App\Http\Resources\CartResource;
use App\Models\Cart;
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

        $query = Cart::select()->with('product_detail');

        if($request->direction){
            $query = $query->orderBy('created_at', $request->direction);
        }

        $totalCount = $query->count();

        $result = $query->skip($skip)->take($take)->get();

        return [
            'totalCount' => $totalCount,
            'data' => CartResource::collection($result),
        ];

    }
}
