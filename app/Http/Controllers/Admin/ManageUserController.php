<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;

class ManageUserController extends Controller
{
    public function index()
    {
        $users = User::all();
        return view('admin.users-index', compact('users'));
    }

    public function create()
    {
        return view('admin.manage_users.create');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'nama' => 'required|string|max:255',
            'nik' => 'required|string|max:255',
            'password' => 'required|string|min:8|confirmed',
            'no_telp' => 'required|string|max:15',
            'alamat' => 'required|string|max:255',
            'role' => 'required|string|in:user,admin',
        ]);

        User::create($validated);

        return redirect()->route('admin.manage_users.index')->with('success', 'User created successfully.');
    }
}
