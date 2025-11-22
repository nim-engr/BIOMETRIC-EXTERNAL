<?php

namespace App\Http\Controllers;

class DtrController extends Controller
{
    public function index()
    {
        return view('dtr.generate');
    }
}
