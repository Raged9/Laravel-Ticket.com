<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class HomeController extends Controller
{
    public function index()
    {
        // Langsung menampilkan view 'home.blade.php'
        return view('home');
    }
}
