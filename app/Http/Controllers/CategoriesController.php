<?php

namespace App\Http\Controllers;

use App\Category;
use Illuminate\Http\Request;

class CategoriesController extends Controller
{
    // Fetch all Categories
    public function index()
    {
        return Category::all();
    }

    /*
    * Store new Category
    *
    *   @returns Updates List of Categories
    */
    public function store(Request $request)
    {
        $this->validate($request, [
            'categoryValue' => 'required'
        ]);

        $id = Category::create([
            'category_name' => $request->input('categoryValue')
        ]);
        
        return $id; 
    }
}
