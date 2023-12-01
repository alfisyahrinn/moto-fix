<?php

namespace App\Http\Controllers;

use App\Models\Supplier;
use Illuminate\Http\Request;
use RealRashid\SweetAlert\Facades\Alert;

class AdminSupplierController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $datas = Supplier::all();
        return view('admin.pages.supplier.index', [
            'title' => 'Supplier',
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
        Alert::success('Success', 'Supplier Added');
        

        Supplier::create($data);

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
    
        $supplier = Supplier::findOrFail($id);
        $supplier->update($data);
    
        // Display success alert
        Alert::success('Success', 'Data Supplier Updated');
    
        return redirect()->route('supplier.index');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $supplier = Supplier::findOrFail($id);
        $supplier->delete();

        // Display success alert
        Alert::success('Success', 'Data Supplier Deleted');

        return redirect()->route('supplier.index');
    }
}
