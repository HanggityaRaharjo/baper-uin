<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\BackgroundImage;
use App\Models\repository;

class home extends Controller
{
    public function home()
    {
        $repositoris = repository::latest()->limit(3)->get();
        // dd($repositoris);
        $background_image = BackgroundImage::latest()->first();
        return view('welcome1',compact('background_image','repositoris'));
    }
}
