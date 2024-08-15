<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreCartRequest;
use App\Models\Cart;
use App\Services\CartService;
use Illuminate\Http\Request;

class CartController extends Controller
{
    protected $cartService;
    public function __construct()
    {
        $this->cartService = new CartService();
    }

    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        try {
            $result = $this->cartService->list($request);

            return response()->json([
                'success' => true,
                'message' => 'Data retrieved successfully',
                ...$result,
            ], 200);
        } catch (\Throwable $e) {
            return response()->json([
                'success' => false,
                'message' => 'Internal server error',
            ], 500);
        }
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreCartRequest $request)
    {
        try{

            $result = $this->cartService->addItemToCart($request);

            if(!$result){
                return response()->json([
                    'success' => false,
                    'message' => 'Stock is low',
                    'data' => null,
                ], 400);
            }

            return response()->json([
                'success' => true,
                'message' => 'Data retrieved successfully',
                'data' => $result,
            ], 200);
        } catch (\Throwable $e) {
            return response()->json([
                'success' => false,
                'message' => 'Internal server error',
            ], 500);
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(Cart $cart)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $cart)
    {
        try{

            $result = $this->cartService->updateItemInCart($request, $cart);

            if(!$result['success']){
                return response()->json($result, 400);
            }

            return response()->json($result, 200);
        } catch (\Throwable $e) {
            return response()->json([
                'success' => false,
                'message' => 'Internal server error',
            ], 500);
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($cart)
    {
        try{

            $result = $this->cartService->deleteItemInCart($cart);

            if(!$result['success']){
                return response()->json($result, 404);
            }

            return response()->json($result, 200);
        } catch (\Throwable $e) {
            return response()->json([
                'success' => false,
                'message' => 'Internal server error',
            ], 500);
        }
    }
}
