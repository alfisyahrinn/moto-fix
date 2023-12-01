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

            if ($product && $product->stock > 0) {
                // Use a database transaction for atomic operations
                DB::beginTransaction();

                try {
                    $existingDetail = DetailService::where('transaction_id', $request->transaction_id)
                        ->where('product_id', $request->product)
                        ->first();

                    $quantity = 1; // Default quantity

                    if ($existingDetail) {
                        $quantity = $existingDetail->quantity + 1;
                        $existingDetail->increment('quantity');
                    } else {
                        DetailService::create([
                            'transaction_id' => $request->transaction_id,
                            'product_id' => $request->product,
                            'quantity' => $quantity,
                        ]);
                    }

                    $transaction->increment('total_price', $product->price);
                    $transaction->save();

                    // Decrease the stock of the product
                    $product->decrement('stock', 1);
                    $product->save();

                    DB::commit(); // Commit the transaction

                    Alert::success('Success', 'Product added to cart');
                    return redirect()->route('transaction.edit', $request->transaction_id);
                } catch (\Exception $e) {
                    DB::rollBack(); // Rollback the transaction in case of an exception
                    throw $e; // Re-throw the exception after rolling back
                }
            } else {
                Alert::error('Error', 'Product is out of stock');
            }
        }

        Alert::error('Error', 'Product is out of stock');
        return redirect()->route('transaction.edit', $request->transaction_id);
    } catch (\Exception $e) {
        // Handle exception if any
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

        // Menghitung selisih quantity baru dengan quantity lama
        $quantityDifference = $request->input('quantity') - $detail->quantity;

        // Mulai transaksi database
        DB::beginTransaction();

        // Update kuantitas pada atribut detail
        $detail->update(['quantity' => $request->input('quantity')]);

        // Kurangi stok produk sesuai selisih quantity
        $product = $detail->product;
        $newStock = $product->stock - $quantityDifference;

        // Check if the new stock would be negative
        if ($newStock < 0) {
            // Rollback transaksi database
            DB::rollBack();

            // Menampilkan SweetAlert error jika stok kurang dari 0
            Alert::error('Error', 'Stock cannot be less than 0.');

            return redirect()->back();
        }

        // Update stock in the product table
        $product->update(['stock' => $newStock]);

        // Panggil fungsi updateTotalPrice untuk menghitung dan memperbarui total harga
        $this->updateTotalPrice($detail->transaction);

        // Commit transaksi database
        DB::commit();

        // Menampilkan SweetAlert success
        Alert::success('Success', 'Quantity updated successfully.');

        // Redirect kembali atau ke halaman lain
        return redirect()->back();
    } catch (\Exception $e) {
        // Rollback transaksi database jika terjadi kesalahan
        DB::rollBack();

        // Tangani pengecualian jika ada
        // Menampilkan SweetAlert error jika terjadi kesalahan
        Alert::error('Error', 'Failed to update quantity.');

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

    public function deleteDetail(Request $request, $id)
    {
        try {
            // Find the detail associated with the ID
            $detail = DetailService::findOrFail($id);

            // Get the transaction associated with the detail
            $transaction = $detail->transaction;

            // Get the quantity to be returned to the stock (if applicable)
            $returnedQuantity = $detail->quantity;

            // Mulai transaksi database
            DB::beginTransaction();

            // Delete the detail
            $detail->delete();

            // If the detail is associated with a product, update the stock
            if ($detail->product_id) {
                // Get the product associated with the detail
                $product = $detail->product;

                // Return the quantity to the stock of the corresponding product
                $product->update(['stock' => $product->stock + $returnedQuantity]);
            }

            // Call the function to update the total price
            $this->updateTotalPrice($transaction);

            // Commit transaksi database
            DB::commit();

            // Display a success message
            Alert::success('Success', 'Detail deleted successfully.');

            // Redirect back or to another page
            return redirect()->back();
        } catch (\Exception $e) {
            // Rollback transaksi database jika terjadi kesalahan
            DB::rollBack();

            // Handle exceptions if any
            // Display an error message
            Alert::error('Error', 'Failed to delete detail.');

            // Redirect back
            return redirect()->back();
        }
    }


}