<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{
    public function index()
    {
        $users = User::all();
        return view('users', compact('users'));
    }

    public function store(Request $request)
    {
        User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'role' => $request->role,
            
        ]);

        return redirect()->back()->with('success', 'User created');
    }

    public function destroy($id)
    {
        User::destroy($id);
        return redirect()->back()->with('success', 'User deleted');
    }
}