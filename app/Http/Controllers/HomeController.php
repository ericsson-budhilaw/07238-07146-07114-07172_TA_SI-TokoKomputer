<?php

namespace App\Http\Controllers;

class HomeController extends Controller
{
    public function index()
    {
        return view("welcome");
    }

    public function toko()
    {
        return view("toko");
    }

    public function admin()
    {
        return view("admin");
    }
}
