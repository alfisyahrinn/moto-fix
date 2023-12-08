<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Product;
use App\Models\Supplier;
use App\Models\Category;
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
        // Implement your logic for creating a new product form
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
                'image' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:1024',
                'stock' => 'required|numeric',
                'price' => 'required|numeric',
            ]);

            if ($request->hasFile('image')) {
                $imageName = uniqid().'.'.$request->image->extension();
                $request->file('image')->move(public_path('images'), $imageName);
                $data['image'] = 'images/' . $imageName;
            }

            Product::create($data);

            Alert::success('Success', 'Product Added');

            return back()->with('success', 'Product added successfully.');
        } catch (\Exception $e) {
            return back()->with('error', 'Failed to add product. Please try again.');
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        // Implement your logic for displaying a specific product
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        // Implement your logic for editing a specific product
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        try {
            $data = $request->validate([
                'name' => 'required|max:100',
                'category_id' => 'required',
                'supplier_id' => 'required',
                'description' => 'required',
                'stock' => 'required|numeric',
                'price' => 'required|numeric',
            ]);

            $product = Product::findOrFail($id);

            if ($request->hasFile('image')) {
                // Remove old image file if it exists
                if ($product->image) {
                    $oldImagePath = public_path($product->image);
                    if (file_exists($oldImagePath)) {
                        unlink($oldImagePath);
                    }
                }

                // Upload and save the new image
                $imageName = uniqid().'.'.$request->image->extension();
                $request->file('image')->move(public_path('images'), $imageName);
                $data['image'] = 'images/' . $imageName;
            }

            $product->update($data);

            Alert::success('Success', 'Product Updated');

            return back()->with('success', 'Product updated successfully.');
        } catch (\Exception $e) {
            return back()->with('error', 'Failed to update product. Please try again.');
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