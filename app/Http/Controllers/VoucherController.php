<?php

namespace App\Http\Controllers;

use App\Models\Voucher;
use App\Http\Requests\StoreVoucherRequest;
use App\Http\Requests\UpdateVoucherRequest;
use App\Services\VoucherService;
use Illuminate\Http\Request;
use Throwable;

class VoucherController extends Controller
{
    protected $voucherService;
    public function __construct()
    {
        $this->voucherService = new VoucherService();
    }

    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        try {
            $result = $this->voucherService->list($request);

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
    public function store(StoreVoucherRequest $request)
    {
        try{
            $result = $this->voucherService->store($request);

            return response()->json([
                'success' => true,
                'message' => 'Process success',
                'data' => $result,
            ], 201);
        }catch(Throwable $e){
            return response()->json([
                'success' => false,
                'message' => 'Internal server error',
            ], 500);
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(Voucher $voucher)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateVoucherRequest $request, Voucher $voucher)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Voucher $voucher)
    {
        //
    }
}
