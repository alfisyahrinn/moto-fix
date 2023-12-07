<?php

namespace App\Http\Controllers;

use App\Models\Category;
use Illuminate\Http\Request;
use RealRashid\SweetAlert\Facades\Alert;

class AdminCategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $datas = Category::all();
        return view('admin.pages.Category.index', [
            'title' => 'Category',
            'datas' => $datas,

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
            'name' => 'required'
        ]);

        $data['name'] = ($data['name']);

        // Display success alert
        Alert::success('Success', 'Category Added');


        Category::create($data);

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
            'name' => 'required',
        ]);

        $category = Category::findOrFail($id);
        $category->update($data);

        // Display success alert
        Alert::success('Success', 'Category Updated');

        return redirect()->route('category.index');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $category = Category::findOrFail($id);
            $category->delete();

            // Display success alert
            Alert::success('Success', 'Category Deleted');

            return redirect()->route('category.index');
    }
}
