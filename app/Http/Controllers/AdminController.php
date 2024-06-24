<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class AdminController extends Controller
{
    public function index()
    {
        // Logika untuk dashboard admin
        return view('backend.layouts.dashboard');
    }
}
