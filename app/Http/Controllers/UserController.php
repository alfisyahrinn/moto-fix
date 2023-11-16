<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class UserController extends Controller
{
    public function __construct()
    {
        $this->middleware(['auth', 'verified', 'checkRole:user']);
    }

    public function index()
    {
        return view('user.pages.index');
    }
}
