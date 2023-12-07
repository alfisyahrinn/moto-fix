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
        $category = Category::all();
        $supplier = Supplier::all();
        return view ('admin.pages.product.index')->with([
            'title' => 'Product',
            'products' => $products,
            'categories' => $category,
            'suppliers' => $supplier,
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
            'image' => 'required|image|file|max:1024',
            'stock' => 'required',
            'price' => 'required'
        ]);

        if ($request->file('image')) {

            $imageName = uniqid().'.'.$request->image->extension();
            $request->file('image')->move(public_path('images'), $imageName);
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
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
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



            'stock' => 'required',
            'price' => 'required'
        ]);




        $product = Product::findOrFail($id);

        // Check if there is a new image file
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
        // Handle the exception, you can log it or show an error message
        return back()->with('error', 'Failed to update product. Please try again.');
    }

}




    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Product $product)
    {
        if($product->image){
            Storage::delete($product->image);
        }

        Product::destroy($product->id);

        // Display success alert
        Alert::success('Success', 'Product Deleted');

        return redirect()->route('product.index');
    }
}
