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
            $transaction = Transaction::find($request->transaction_id);

            if ($transaction) {
                $product = Product::find($request->product);

                if ($product) {
                    // Check if a detail for the selected product already exists
                    $existingDetail = DetailService::where('transaction_id', $request->transaction_id)
                        ->where('product_id', $request->product)
                        ->first();

                    $quantity = 1; // Default quantity

                    if ($existingDetail) {
                        // If the product already exists, increment the quantity
                        $quantity = $existingDetail->quantity + 1;
                        $existingDetail->increment('quantity');
                    } else {
                        // If the product is added for the first time, create a new row
                        DetailService::create([
                            'transaction_id' => $request->transaction_id,
                            'product_id' => $request->product,
                            'quantity' => $quantity,
                        ]);
                    }

                    // Update the total_price attribute on the transaction model
                    $transaction->increment('total_price', $product->price);
                    $transaction->save();

                    // Menampilkan SweetAlert success
                    Alert::success('Success', 'Product added to cart');

                    return redirect()->route('transaction.edit', $request->transaction_id);
                }
            }

            // Menampilkan SweetAlert error jika terjadi kesalahan
            Alert::error('Error', 'Failed to add product to cart');

            return redirect()->route('transaction.edit', $request->transaction_id);
        } catch (\Exception $e) {
            // Handle exception if any
            // Menampilkan SweetAlert error jika terjadi kesalahan
            Alert::error('Error', 'Failed to add product to cart');

            return redirect()->route('transaction.edit', $request->transaction_id);
        }
    }

public function addServiceToCart(Request $request)
{
    try {
        $transaction = Transaction::find($request->transaction_id);

        if ($transaction) {
            $service = Service_price::find($request->service);

            if ($service) {
                // Check if a detail for the selected service already exists
                $existingDetail = DetailService::where('transaction_id', $request->transaction_id)
                    ->where('service_id', $request->service)
                    ->first();

                $quantity = 1; // Default quantity

                if ($existingDetail) {
                    // If the service already exists, increment the quantity
                    $quantity = $existingDetail->quantity + 1;
                    $existingDetail->increment('quantity');
                } else {
                    // If the service is added for the first time, create a new row
                    DetailService::create([
                        'transaction_id' => $request->transaction_id,
                        'service_id' => $request->service,
                        'quantity' => $quantity,
                    ]);
                }

                // Update the total_price attribute on the transaction model
                $transaction->increment('total_price', $service->price);
                $transaction->save();

                // Menampilkan SweetAlert success
                Alert::success('Success', 'Service added to cart');

                return redirect()->route('transaction.edit', $request->transaction_id);
            }
        }

        // Menampilkan SweetAlert error jika terjadi kesalahan
        Alert::error('Error', 'Failed to add service to cart');

        return redirect()->route('transaction.edit', $request->transaction_id);
    } catch (\Exception $e) {
        // Handle exception if any
        // Menampilkan SweetAlert error jika terjadi kesalahan
        Alert::error('Error', 'Failed to add service to cart');

        return redirect()->route('transaction.edit', $request->transaction_id);
    }
}
// AdminTransactionController.php

public function updateQuantity(Request $request, $id)
{
    try {
        // Temukan detail yang terkait dengan ID yang diberikan
        $detail = DetailService::findOrFail($id);

        // Validasi input quantity
        $request->validate([
            'quantity' => 'required|integer|min:1',
        ]);

        // Update kuantitas pada atribut detail
        $detail->update(['quantity' => $request->input('quantity')]);

        // Panggil fungsi updateTotalPrice untuk menghitung dan memperbarui total harga
        $this->updateTotalPrice($detail->transaction);

        // Menampilkan SweetAlert success
        Alert::success('Success', 'Quantity updated successfully.');

        // Redirect kembali atau ke halaman lain
        return redirect()->back();
    } catch (\Exception $e) {
        // Tangani pengecualian jika ada
        // Menampilkan SweetAlert error jika terjadi kesalahan
        Alert::error('Error', 'Failed to update quantity.');

        return redirect()->back();
    }
}


private function updateTotalPrice(Transaction $transaction)
{
    // Retrieve details for the given transaction associated with products and services
    $details = DetailService::where('transaction_id', $transaction->id)->get();

    // Calculate the total price based on product and service prices and quantities
    $totalPrice = $details->sum(function ($detail) {
        if ($detail->product_id) {
            return optional($detail->product)->price * $detail->quantity;
        } elseif ($detail->service_id) {
            return optional($detail->service)->price * $detail->quantity;
        }

        return 0; // Default value, modify as needed
    });

    // Update the total_price attribute on the transaction model
    $transaction->update(['total_price' => $totalPrice]);
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

        // Ambil total harga dari model transaksi
        $totalPrice = $transaction->total_price;

        return view('admin.pages.transaction.edit', [
            'title' => 'transaction',
            'data' => $transaction,
            'products' => $products,
            'services' => $services,
            'details' => $details,
            'totalPrice' => $totalPrice,
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


    public function deleteDetail(Request $request, $id)
{
    try {
        // Find the detail associated with the ID
        $detail = DetailService::findOrFail($id);

        // Get the transaction associated with the detail
        $transaction = $detail->transaction;

        // Delete the detail
        $detail->delete();

        // Call the function to update the total price
        $this->updateTotalPrice($transaction);

        // Display a success message
        Alert::success('Success', 'Detail deleted successfully.');

        // Redirect back or to another page
        return redirect()->back();
    } catch (\Exception $e) {
        // Handle exceptions if any
        // Display an error message
        Alert::error('Error', 'Failed to delete detail.');

        // Redirect back
        return redirect()->back();
    }
}




}
