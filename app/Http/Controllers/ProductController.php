<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\Category;
use App\Models\Supplier;

class ProductController extends Controller
{
    public function index(){
        return view('user.pages.product')->with([
            'products' => Product::latest()->filter()->get(),
            'suppliers' => Supplier::all(),
            'categories' => Category::all()
        ]);
    }

    public function show($id){
        $product = Product::findOrFail($id);

        return view('user.pages.detailProduct', compact('product'));
    }

    public function filterSupplier(Supplier $supplier){
        $suppliers = Supplier::all();
        $categories = Category::all();

        $products = Product::where('supplier_id', $supplier->id)->get();

        return view('user.pages.product', compact('products', 'suppliers', 'categories'));
    }

    public function filterCategory(Category $category){
        $suppliers = Supplier::all();
        $categories = Category::all();

        $products = Product::where('category_id', $category->id)->get();

        return view('user.pages.product', compact('products', 'suppliers','categories'));
    }

}
