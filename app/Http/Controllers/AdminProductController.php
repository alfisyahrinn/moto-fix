<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Product;
use App\Models\Supplier;
use App\Models\Category;
use App\Models\User;
use Illuminate\Support\Facades\Storage;
use RealRashid\SweetAlert\Facades\Alert;

class AdminProductController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $products = Product::all();
        $categories = Category::all();
        $suppliers = Supplier::all();
        return view('admin.pages.product.index')->with([
            'title' => 'Product',
            'products' => $products,
            'categories' => $categories,
            'suppliers' => $suppliers,
        ]);
    }

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
        try {
            $data = $request->validate([
                'name' => 'required|max:100',
                'category_id' => 'required',
                'supplier_id' => 'required',
                'description' => 'required',
                'image' => 'required|image|max:1024',
                'stock' => 'required',
                'price' => 'required'
            ]);

            if ($request->hasFile('image')) {
                $imageName = uniqid().'.'.$request->file('image')->extension();
                $request->file('image')->storeAs('public/images', $imageName);
                $data['image'] = 'images/' . $imageName;
            }

            Product::create($data);

            Alert::success('Success', 'Product Added');

            return back()->with('success', 'Product added successfully.');
        } catch (\Exception $e) {
            // Handle the exception, you can log it or show an error message
            return back()->with('error', 'Failed to add product. Please try again.');
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Product $product)
{
    if ($product->image) {
        Storage::delete($product->image);
    }

    // Delete related records in detail_services table
    $product->detailServices()->delete();

    // Delete the Product record
    $product->delete();

    // Display success alert
    Alert::success('Success', 'Product Deleted');

    return redirect()->route('product.index');
}

}