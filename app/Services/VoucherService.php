<?php

namespace App\Services;

use App\Http\Resources\VoucherResource;
use App\Models\Voucher;
use Carbon\Carbon;
use Illuminate\Http\Request;

class VoucherService
{
    public function list(Request $request)
    {
        $skip = 0;
        $take = 10;

        if($request->page && $request->perPage){
            $skip = $request->perPage * ($request->page - 1);
            $take = $request->perPage;
        }

        $query = Voucher::select()->where('is_active', 1);

        $totalCount = $query->count();

        $result = $query->skip($skip)->take($take)->get();

        return [
            'totalCount' => $totalCount,
            'data' => VoucherResource::collection($result),
        ];

    }

    public function show_active($id)
    {
        return Voucher::where('id', $id)->where('is_active', 1)->first();
    }

    public function show($id)
    {
        return Voucher::where('id', $id)->first();
    }

    public function check_apply_voucher($code)
    {
        $voucher = Voucher::where('code', $code)->where('is_active', 1)->first();

        if(!$voucher){
            return [
                'success' => false,
                'message' => 'Voucher not found',
            ];
        }

        if(Carbon::now()->gt($voucher->tgl_akhir_berlaku)){
            return [
                'success' => false,
                'message' => 'Voucher expired',
            ];
        }

        return $voucher;
    }

    public function store(Request $request)
    {
        return Voucher::create([
            'name' => $request->name,
            'desc' => $request->desc,
            'type' => $request->type,
            'total' => $request->total,
            'code' => $request->code,
            'tgl_mulai_berlaku' => $request->tgl_mulai_berlaku,
            'tgl_akhir_berlaku' => $request->tgl_akhir_berlaku,
        ]);
    }

    public function update(Request $request, $id)
    {
        return Voucher::where('id', $id)->update($request->only([
            'name',
            'desc',
            'type',
            'total',
            'code',
            'tgl_mulai_berlaku',
            'tgl_akhir_berlaku',
        ]));
    }

    public function destroy($id)
    {
        $voucher = Voucher::where('id', $id)->delete();

        return $voucher;
    }
}
