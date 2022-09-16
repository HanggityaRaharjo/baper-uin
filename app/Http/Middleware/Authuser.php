<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;

class Authuser
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure(\Illuminate\Http\Request): (\Illuminate\Http\Response|\Illuminate\Http\RedirectResponse)  $next
     * @return \Illuminate\Http\Response|\Illuminate\Http\RedirectResponse
     */

    public function handle($request, Closure $next)
    {
        $salam = 'https://api.uinsgd.ac.id/salam/v2/';
        if ($request->session()->get('level') == 'mahasiswa') {
            if ($request->session()->has('token') && $request->session()->has('nim')) {
                $token = $request->session()->get('token', '');
                $nim = $request->session()->get('nim', '1');
                $response = Http::withToken($token)
                    ->get($salam . 'mahasiswa/profile', [
                        'nim' => $nim
                    ]);

                if ($response->failed()) {
                    if ($response->status() == 401) {

                        session()->forget(['token', 'nim']);
                        return redirect()->route('loginuser');
                    } else {

                        return redirect()->route('user');
                    }
                } else {
                    $data = $response->json();
                    $request->attributes->set('user', $data);
                }
            } else {
                return redirect()->route('loginuser');
            }
        }
        // elseif ($request->session()->get('level') == 'dosen') {
        // }
        return $next($request);
    }
}
