<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class ProfilePengembangController extends Controller
{
    public function index()
    {
        return view('pages.profilepengembang');
    }
}

