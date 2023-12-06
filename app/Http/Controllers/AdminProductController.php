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
        $data = $request->validate([
            'name' => 'required|max:100',
            'category_id' => 'required',
            'supplier_id' => 'required',
            'description' => 'required',
            'image' => 'required|image|file|max:1024',
            'stock' => 'required',
            'price' => 'required'
        ]);

        if($request->file('image')){
            $data['image'] = $request->file('image')->store('data-image');
        }

        Alert::success('Success', 'Product Added');

		Product::create($data);

        return back()->with('i');
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
    public function update(Request $request, string $id)
    {
        $data = $request->validate([
            'name' => 'required|max:100',
            'category_id' => 'required',
            'supplier_id' => 'required',
            'description' => 'required',
            'image' => 'required|image|file|max:1024',
            'stock' => 'required',
            'price' => 'required'
        ]);

        if($request->file('image')){
            if($request->imageOld){
                Storage::delete($request->imageOld);
            }
            $data['image'] = $request->file('image')->store('data-image');
        }

        $product = Product::findOrFail($id);
        $product -> update($data);
    
        // Display success alert
        Alert::success('Success', 'Product Updated');
    
        return redirect()->route('product.index');
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
