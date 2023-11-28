<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class AdminController extends Controller
{
    public function __construct()
    {
        $this->middleware(['auth', 'verified', 'checkRole:admin']);
    }

    public function index()
    {
        return view('admin.pages.dashboard');
    }
    public function addToCard($id)
    {
        dd('sau');
    }
}