<?php

namespace App\Http\Controllers;

use App\Models\Checkout;
use App\Http\Requests\StoreCheckoutRequest;
use App\Http\Requests\UpdateCheckoutRequest;
use App\Services\CheckoutService;
use Illuminate\Http\Request;
use Throwable;

class CheckoutController extends Controller
{
    protected $checkoutService;

    public function __construct()
    {
        $this->checkoutService = new CheckoutService();
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create_transaction(StoreCheckoutRequest $request)
    {
        try{
            $result = $this->checkoutService->create_transaction($request);

            if(!$result['success']){
                return response()->json($result, $result['code']);
            }

            return response()->json([
                'success' => true,
                'message' => 'Process success',
                'data' => $result,
            ], 201);
        }catch(Throwable $e){
            dd($e->__toString());
            return response()->json([
                'success' => false,
                'message' => 'Internal server error',
            ], 500);
        }
    }

    /**
     * Display the specified resource.
     */
    public function show($checkout)
    {
        try{
            $result = $this->checkoutService->show($checkout);

            if(!$result){
                return response()->json([
                    'success' => false,
                    'message' => 'Data not found',
                ], 404);
            }

            return response()->json([
                'success' => true,
                'message' => 'Process success',
                'data' => $result,
            ], 200);
        }catch(Throwable $e){
            return response()->json([
                'success' => false,
                'message' => 'Internal server error',
            ], 500);
        }
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Checkout $checkout)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateCheckoutRequest $request, Checkout $checkout)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Checkout $checkout)
    {
        //
    }
}
