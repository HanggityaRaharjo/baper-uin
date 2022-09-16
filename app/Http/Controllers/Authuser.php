<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;


use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Http;

class Authuser extends Controller
{
    public function index()
    {
        return view('auths.login_user');
    }

    public function login(Request $request)
    {
        $this->validate($request, [
            'username' => 'required|numeric',
            'password' => 'required'
        ]);

        if ($request->level == 'mahasiswa') {

            $response = Http::withHeaders([
                'content-type' => 'application/json'
            ])->post('https://api.uinsgd.ac.id/salam/v2/auth/mahasiswa/login', [
                'username' => $request->username,
                'password' => $request->password
            ]);

            if ($response->successful()) {
                $data = $response->json();
                // dd($data);
                session([
                    'token' => $data['data']['token'],
                    'nim' => $data['data']['data'][0]['username'],
                    'name' => $data['data']['data'][0]['first_name'],
                    'level' => 'mahasiswa'
                ]);
                return redirect('user/dashboard');
            } else {
                return redirect('/loginuser');
            }
        } elseif ($request->level == 'dosen') {

            $response = Http::asForm()->post('https://sip.uinsgd.ac.id/sip_module/ws/login', [
                'token' => '2y10bJ09e9jzVxNjKe8wis8eIgIUSQi0rrgQGmck313jL0mNJK9G',
                'username' => $request->username,
                'password' => $request->password
            ]);
            $data = $response->json();
            // dd($data);
            if ($response->successful() && $response->status() == 200) {
                // dd($data);
                session([
                    'token' => '2y10bJ09e9jzVxNjKe8wis8eIgIUSQi0rrgQGmck313jL0mNJK9G',
                    'nip' => $data['profil']['nip'],
                    'name' => $data['profil']['nama'],
                    'user' => $data,
                    'level' => 'dosen'
                ]);
                return redirect('user/dashboard');
            } else {
                return redirect('/loginuser');
            }
        }
    }
    public function logout()
    {
        session()->forget(['token', 'nim']);
        return redirect()->route('loginuser');
    }
}
