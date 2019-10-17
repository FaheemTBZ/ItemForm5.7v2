<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class HomeController extends Controller
{
    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        if (auth()->user()->admin == 0) {
            if (auth()->user()->canAdd == 1) {
                return view('home');
            }
            return view('approval');
        }
        return view('home');
    }

    /*
    *
    *   Redirect to waiting page for newly registered user!
    *
    */

    public function approval()
    {
        return view('approval');
    }
}
