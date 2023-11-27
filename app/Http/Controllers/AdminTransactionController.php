<?php

namespace App\Http\Controllers;

use App\Models\DetailService;
use App\Models\DetailTransaction;
use App\Models\Product;
use App\Models\Transaction;
use Illuminate\Http\Request;

class AdminTransactionController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $datas = Transaction::all();
        return view('admin.pages.transaction.index', [
            'title' => 'transaction',
            'datas' => $datas,
        ]);
    }

    public function addToCard(Request $request)
    {
        $harga = Product::find($request->product);
        $transaction = Transaction::find($request->transaction_id);
        
        if ($transaction) {
            $price = $harga->price; // Mengambil nilai price dari produk terkait
            $transaction->increment('total_price', $price);
            $transaction->save();
        }
        DetailService::create([
            'transaction_id' => $request->transaction_id,
            'product_id' => $request->product,
        ]);

        return redirect()->route('transaction.edit', $request->id)->with('success', 'Success add Product');
    }
    // $transaction = Product::find($request->id);
    // if ($transaction) {
    //     // Mendapatkan produk terkait dari transaksi
    //     $product = $transaction->Product; // Asumsi relasi bernama 'product' ada di model Transaction

    //     if ($product) {
    //         $price = $product->price; // Mengambil nilai price dari produk terkait
    //         $transaction->increment('total_price', $price);
    //         $transaction->save();
    //     }
    // }
    // DetailService::create([
    //     'transaction_id' => $request->id,
    //     'product_id' => $request->id,
    // ]);

    // return redirect()->route('transaction.edit', $request->id)->with('success', 'Success add Product');
    // }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        dd($request);
    }

    /**
     * Display the specified resource.
\     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Transaction $transaction)
    {
        $details = DetailService::where('transaction_id', $transaction->id)->get();
        $produts = Product::all();
        return view('admin.pages.transaction.edit', [
            'title' => 'transaction',
            'data' => $transaction,
            'products' => $produts,
            'details' => $details,
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        dd($request, $id);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
