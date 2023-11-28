<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\Queue;
use Illuminate\Http\Request;
use RealRashid\SweetAlert\Facades\Alert;


class AdminQueueController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function addToCard(Request $request)
    {
        dd($request->product_id);
    }
    public function index()
    {
        $datas = Queue::all();
        return view('admin.pages.queue.index', [
            'title' => 'queue',
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
        dd('kjk');
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
    public function edit(Queue $queue)
    {
        $produts = Product::all();
        return view('admin.pages.queue.edit', [
            'title' => 'queue',
            'data' => $queue,
            'products' => $produts,
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $request->validate([
            'status' => 'required|in:0,1', // Validate that status is either 0 or 1
        ]);

        $status = (bool) $request->input('status');

        Queue::where('id', $id)->update([
            'status' => $status,
        ]);

        // Display success alert
        Alert::success('Success', 'Service Update Done');

        return redirect()->route('queue.index');
    }

    public function destroy(string $id)
    {
        $queue = Queue::findOrFail($id);
        $queue->delete();

        // Display success alert
        Alert::success('Success', 'Service Deleted');

        return redirect()->route('queue.index');
    }

}