<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Service_price;
use App\Http\Controllers\Controller;
use RealRashid\SweetAlert\Facades\Alert;

class MasterServicePrice extends Controller
{
    public function index()
    {
        $servicePrices = Service_price::all();

        return view('admin.pages.Price.Price', [
            'title' => 'Service Price',
            'datas' => $servicePrices
        ]);
    }

    public function create()
    {
        return view('admin.pages.add.addprice');
    }

    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'name' => 'required',
            'price' => 'required|numeric|min:0',
            // Add other validation rules as needed
        ]);

        Service_price::create($validatedData);

        Alert::success('Success', 'Price Added');
        return redirect('/admin/price');
    }

    public function edit(string $id)
    {
        $servicePrice = Service_price::findOrFail($id);

        return view("admin.pages.edit.editprice", [
            "title" => "Manage",
            "data" => $servicePrice,
        ]);
    }

    public function update(Request $request, string $id)
    {
        $validatedData = $request->validate([
            'name' => 'required',
            'price' => 'required|numeric|min:0',
            // Add other validation rules as needed
        ]);

        Service_price::where('id', $id)->update($validatedData);

        Alert::success('Success', 'Price Updated');
        return redirect('/admin/price');
    }

    public function destroy(string $id)
    {
        $servicePrice = Service_price::findOrFail($id);
        $servicePrice->delete();

        Alert::success('Success', 'Price Deleted');
        return redirect('/admin/price');
    }
}