<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\ValidationException;
use App\Models\User;

class AuthController extends Controller
{
    public function index()
    {
        return view('auths.login');
    }

    public function login(Request $request)
    {
        if (Auth::attempt($request->only('name', 'password'))) {
            $auth = Auth::user();

            if ($auth->level == 'admin') {
                return redirect('admin/dashboard');
            }
            return redirect('/login');
        }
    }
    public function logout()
    {
        Auth::logout();
        return redirect('/login');
    }

    public function editpassword()
    {
        return view('admin.password');
    }
    public function updatepassword(Request $request)
    {
        $request->validate([
            'current_password' => ['required'],
            'password' => ['required', 'confirmed'],
        ]);
        if (Hash::check($request->current_password, auth()->user()->password)) {
            auth()->user()->update(['password' => Hash::make($request->password)]);
            return redirect('/admin/editpassword/edit');
        }
        throw ValidationException::withMessages([
            'current_password' => 'your current password does not mact with our record',
        ]);
    }
}
