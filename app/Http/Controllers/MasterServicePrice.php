<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Service_price;
use App\Http\Controllers\Controller;
use RealRashid\SweetAlert\Facades\Alert;

class MasterServicePrice extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {

            return view('admin.pages.Price.Price', [
                'title' => 'Service price',

                'datas' => Service_price::all()
            ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('admin.pages.add.addprice', [
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

            Alert::success('Success', 'Price Added');
            return redirect('/admin/price');

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
        Alert::success('Success', 'Price Updated');
        return redirect('/admin/price');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $delete = Service_price::findorfail($id);

        $delete->delete();
        Alert::success('Success', 'Price Deleted');
        return redirect('/admin/price');
    }
}
