<?php

namespace App\Http\Controllers;

use\App\Models\Transaction;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }
    
    public function index()
    {
        // query untuk penghasilan
        $income = Transaction::where('transaction_status','SUCCESS')->sum('transaction_total');

        // query untuk penjualan
        $sales = Transaction::count();

        // query list transaksi
        $items = Transaction::orderBy('id','DESC')->take(5)->get();

        // query untuk PIE diagram
        $pie = [
            'pending' => Transaction::where('transaction_status','PENDING')->count(),
            'failed' => Transaction::where('transaction_status','FAILED')->count(),
            'success' => Transaction::where('transaction_status','SUCCESS')->count(),
        ];

        return view ('pages.dashboard')->with([
            'income' => $income,
            'sales' => $sales,
            'items' => $items,
            'pie' => $pie
        ]);
    }
}
