<?php

namespace App\Http\Controllers;

use App\Item;
use App\ItemSupplier;
use Illuminate\Http\Request;

class RoutesController extends Controller
{

    /**
     * Only Authenticated Users are allowed
     *
     *
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        if (auth()->user()->canAdd == 1) {
            return view('home');
        }
        return view('approval');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function search()
    {
        if (auth()->user()->admin == 0) {
            if (auth()->user()->canSearch == 1) {
                return view('search');
            }
            return view('approval');
        }
        return view('search');
    }
}
