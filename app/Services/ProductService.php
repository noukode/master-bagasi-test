<?php

namespace App\Services;

use App\Http\Resources\ProductResource;
use App\Models\Product;
use Illuminate\Http\Request;

class ProductService
{

    public function list(Request $request)
    {
        $skip = 0;
        $take = 10;

        if($request->page && $request->perPage){
            $skip = $request->perPage * ($request->page - 1);
            $take = $request->perPage;
        }

        $query = Product::select();

        if(isset($request->search)){
            $query = $query->where('name', 'LIKE', '%' . $request->search . '%');
        }

        if($request->orderBy && $request->direction){
            $query = $query->orderBy($request->orderBy, $request->direction);
        }

        $totalCount = $query->count();

        $result = $query->skip($skip)->take($take)->get();

        return [
            'totalCount' => $totalCount,
            'data' => ProductResource::collection($result),
        ];

    }

    public function show($id)
    {
        return Product::where('id', $id)->first();
    }

}
