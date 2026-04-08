<?php

namespace App\Http\Controllers;

use App\Models\Admin;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class AdminAuthController extends Controller
{
    public function showLogin()
    {
        return view('admin.login');
    }

    public function login(Request $request)
    {
        $credentials = $request->validate([
            'username' => 'required|string',
            'password' => 'required|string',
        ]);

        $admin = Admin::where('username', $credentials['username'])->first();

        if ($admin && Hash::check($credentials['password'], $admin->password)) {
            $request->session()->put('admin_id', $admin->id);
            $request->session()->put('admin_username', $admin->username);

            return redirect()->route('admin.dashboard');
        }

        return back()->withErrors(['username' => 'Username atau password salah'])->withInput();
    }

    public function logout(Request $request)
    {
        $request->session()->forget(['admin_id', 'admin_username']);
        $request->session()->regenerateToken();

        return redirect()->route('admin.login');
    }
}
