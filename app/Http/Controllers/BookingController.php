<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class BookingController extends Controller
{
    // Display the booking form
    public function index()
    {
        return view('user.pages.booking');
    }

    // Display the jadwal page
    public function showJadwal()
    {
        return view('user.pages.jadwal');
    }
}
