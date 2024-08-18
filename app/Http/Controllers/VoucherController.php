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
    public function show_active($voucher)
    {
        try{
            $result = $this->voucherService->show_active($voucher);

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
    public function show($voucher)
    {
        try{
            $result = $this->voucherService->show($voucher);

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
            ], 201);
        }catch(Throwable $e){
            return response()->json([
                'success' => false,
                'message' => 'Internal server error',
            ], 500);
        }
    }

    public function check_apply_voucher(Request $request)
    {
        try{
            $result = $this->voucherService->show($request->code);

            if(!$result['success']){
                return response()->json($result, 404);
            }

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
     * Update the specified resource in storage.
     */
    public function update(UpdateVoucherRequest $request, $voucher)
    {
        try{
            $result = $this->voucherService->update($request, $voucher);

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
     * Remove the specified resource from storage.
     */
    public function destroy($voucher)
    {
        try{
            $result = $this->voucherService->destroy($voucher);

            return response()->json([
                'success' => true,
                'message' => 'Process success',
            ], 201);
        }catch(Throwable $e){
            return response()->json([
                'success' => false,
                'message' => 'Internal server error',
            ], 500);
        }
    }
}
