<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

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

    public function showProfile()
    {
        return view('user.pages.profile');
    }

    public function editProfile()
    {
        return view('user.pages.profile_edit');
    }

    public function updateProfile(Request $request)
    {
        $user = Auth::user();

        // Validate the form data
        $request->validate([
            'password' => 'nullable|string|min:8|confirmed',
            'email' => 'required|string|email|max:255|unique:users,email,' . $user->id,
            'address' => 'nullable|string|max:255',
            'phone' => 'nullable|string|max:15',
        ]);

        // Update password if provided
        if ($request->filled('password')) {
            $user->password = Hash::make($request->password);
            $user->save();
        }

        // Update other profile information
        $user->email = $request->email;
        $user->address = $request->address;
        $user->phone = $request->phone; // Updated column name
        $user->save();

        return redirect()->route('user.profile')->with('success', 'Profile updated successfully!');
    }
}