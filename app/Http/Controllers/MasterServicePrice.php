<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Service_price;
class MasterServicePrice extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        
            return view('admin.pages.price.price', [
                'title' => 'master',
                'datas' => Service_price::all()
            ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('admin.pages.add.addprice', [
            'title' => 'master',
        ]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
    
        {
            // dd($request->all());
            Service_price::create($request->all());

            return redirect('/admin/price')->with('success', 'News added siccesfully'); 
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
        return view("admin.pages.edit.editprice",[
            "title" => "manage",                                                        
            "datas" => Service_price::find($id),          
        ]);    
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $validatedData = $request->validate([
            "name" => "required",
            "price" => "required"

        ]);
        Service_price::where('id', $id)->update($validatedData);
        return redirect('/admin/price');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $delete = Service_price::findorfail($id);

        $delete->delete(); 

        return redirect('/admin/price');
    }
}
