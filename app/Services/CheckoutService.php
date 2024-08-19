<?php

namespace App\Services;

use App\Models\Cart;
use App\Models\Checkout;
use App\Models\Product;
use App\Models\TransactionItem;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

class CheckoutService
{
    public function create_transaction(Request $request)
    {
        DB::beginTransaction();
        $voucherService = new VoucherService();
        //check voucher

        $valid_voucher = [];
        $invalid_voucher = [];
        foreach ($request->vouchers as $voucher) {
            $result = $voucherService->check_apply_voucher($voucher);

            if(isset($result['success']) && !$result['success']){
                $invalid_voucher[$voucher] = $result['message'];
                continue;
            }

            $valid_voucher[] = $result;
        }

        if(count($invalid_voucher) > 0){
            return [
                'success' => false,
                'message' => 'Invalid Voucher',
                'errors' => $invalid_voucher,
                'code' => 400,
            ];
        }

        $cart_ids = [];

        foreach($request->items as $key => $item){
            $cart_ids[] = $item['cart_id'];
        }

        $carts = Cart::whereIn('id', $cart_ids)->with('product_detail')->get();

        $total_price = 0;
        $invalid_stock = [];
        foreach($carts as $cart_item){
            if($cart_item->qty > $cart_item->product_detail->stock){
                $invalid_stock[] = $cart_item->product_detail->name;
                continue;
            }
            $total_price += $cart_item->product_detail->price * $cart_item->qty;
        }

        if(count($invalid_stock) > 0){
            return [
                'success' => false,
                'message' => 'Invalid Stock',
                'errors' => $invalid_stock,
                'code' => 400,
            ];
        }

        $total_purchase = $total_price;
        foreach($valid_voucher as $voucher){
            if($voucher->type == 'discount_percentage'){
                $total_purchase -= $total_price * ($voucher->total / 100);
                continue;
            }

            $total_purchase -= $voucher->total;
        }

        $res = Checkout::create([
            'transaction_code' => Str::random(10),
            'user_id' => auth()->user()->id,
            'status' => 0,
            'applied_vouchers' => json_encode(array_map(fn($item) => $item->code, $valid_voucher)),
            'shipping_address' => json_encode($request->shipping_address),
            'expired_purchase_date' => Carbon::now()->addDay(1),
        ]);

        foreach($carts as $cart_item){
            TransactionItem::create([
                'checkout_id' => $res->id,
                'product_id' => $cart_item->product_id,
                'product_detail' => json_encode($cart_item->product_detail),
                'price' => $cart_item->product_detail->price,
                'qty' => $cart_item->qty,
            ]);

            $product = Product::where('id', $cart_item->product_id)->first();
            $product->stock -= $cart_item->qty;
            $product->save();

            Cart::where('id', $cart_item->id)->delete();
        }

        DB::commit();

        return [
            'success' => true,
            'message' => 'Checkout success',
            'data' => $res,
        ];
    }

    public function show($id)
    {
        return Checkout::where('id', $id)->with('items')->first();
    }
}
