<?php

namespace App\Http\Controllers;

use App\Models\DetailService;
use App\Models\DetailTransaction;
use App\Models\Product;
use App\Models\Transaction;
use App\Models\Service_price;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use RealRashid\SweetAlert\Facades\Alert;


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
        try {
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

            // Menampilkan SweetAlert success
            Alert::success('Success', 'Product added to cart');

            return redirect()->route('transaction.edit', $request->id);
        } catch (\Exception $e) {
            // Menampilkan SweetAlert error jika terjadi kesalahan
            Alert::error('Error', 'Failed to add product to cart');

            return redirect()->route('transaction.edit', $request->id);
        }
    }
    public function addServiceToCart(Request $request)
{
    try {
        $service = Service_price::find($request->service);
        $transaction = Transaction::find($request->transaction_id);

        if ($transaction) {
            $price = $service->price; // Mengambil nilai price dari layanan terkait
            $transaction->increment('total_price', $price);
            $transaction->save();
        }

        DetailService::create([
            'transaction_id' => $request->transaction_id,
            'service_id' => $request->service,
        ]);

        // Menampilkan SweetAlert success
        Alert::success('Success', 'Service added to cart');

        return redirect()->route('transaction.edit', $request->transaction_id);
    } catch (\Exception $e) {
        // Menampilkan SweetAlert error jika terjadi kesalahan
        Alert::error('Error', 'Failed to add service to cart');

        return redirect()->route('transaction.edit', $request->transaction_id);
    }
}


public function deleteItem($detailId)
{
    try {
        $detail = DetailService::find($detailId);

        if (!$detail) {
            // Item tidak ditemukan
            Alert::error('Error', 'Detail not found');
            return redirect()->back();
        }

        $transaction = Transaction::find($detail->transaction_id);

        if (!$transaction) {
            // Transaksi tidak ditemukan
            Alert::error('Error', 'Transaction not found');
            return redirect()->back();
        }

        if ($detail->product_id) {
            // Hanya lakukan ini jika yang dihapus adalah produk, bukan servis
            $product = Product::find($detail->product_id);

            if ($product) {
                // Kurangi total hanya jika produk ditemukan
                $transaction->decrement('total_price', $product->price);
            }
        }

        // Hapus detail transaksi dari database
        $detail->delete();

        // Sukses
        Alert::success('Success', 'Service / Product Deleted');
        return redirect()->back();
    } catch (\Exception $e) {
        // Kesalahan umum
        Alert::error('Error', 'Failed to delete service');
        return redirect()->back();
    }
}




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
    $details = DetailService::where('transaction_id', $transaction->id)
        ->with('product', 'service') // Eager load the related product and service
        ->get();

    $products = Product::all();
    $services = Service_price::all();

    return view('admin.pages.transaction.edit', [
        'title' => 'transaction',
        'data' => $transaction,
        'products' => $products,
        'services' => $services,
        'details' => $details,
    ]);
}




    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        if ($request->uang_cek) {
            Transaction::where('id', $id)->update([
                'status' => true,
            ]);
            return redirect()->route('transaction.edit', $id)->with('success', 'Success Payment');
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
