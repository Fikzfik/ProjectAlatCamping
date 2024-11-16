<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\View\View;

class ViewController extends Controller
{
    public function loginview(): view
    {
        return view('pages.login');
    }
    public function registerview(): view
    {
        return view('pages.register');
    }
    public function homeview(): view
    {
        return view('pages.auth.home');
    }
    public function locationview(): view
    {
        return view('pages.auth.location');
    }
    public function blogview(): view
    {
        return view('pages.auth.blog');
    }
}
