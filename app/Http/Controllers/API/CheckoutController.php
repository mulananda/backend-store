<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Http\Requests\API\CheckoutRequest;
use App\Models\Product;
use App\Models\Transaction;
use App\Models\TransactionDetail;
use Illuminate\Http\Request;

class CheckoutController extends Controller
{
    public function checkout(CheckoutRequest $request)
    {
        $data = $request->except('transaction_details');
        $data['uuid'] = 'TRX' . mt_rand(10000,99999) . mt_rand(100,999); // Format uuid , hasil format TRX12323948
        
        $transaction = Transaction::create($data); // membuat transaksi baru

        // membuat array untuk membuat transaksi detail
        foreach ($request->transaction_details as $product) {
            $details[] = new TransactionDetail([
                'transactions_id' => $transaction->id,
                'products_id' => $product
            ]);

            Product::find($product)->decrement('quantity'); // mengurangi data quantity pada saat ada pembelian
        }

        $transaction->details()->saveMany($details); // menyimpan detail transaksinya

        return ResponseFormatter::success($transaction);

    }
}
