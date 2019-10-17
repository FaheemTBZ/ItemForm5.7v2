<?php

namespace App\Http\Controllers;

use App\Item;
use App\Supplier;
use Illuminate\Http\Request;

class SearchController extends Controller
{
    public function search(Request $request)
    {
        $searchUnit = $request->input('itemUnit');

        if ($searchUnit === 'itemCode') {
            $request->validate([
                'itemCode' => 'required'
            ]);
            $result = Item::where('item_code', 'LIKE', '%'.$request->input('itemCode').'%')->first();
            return isset($result) ? view('/search', ['resultCode' => $result]) : view('/search')->with('SearchError', 'No Items Found!');
        } else if ($searchUnit === 'searchCategory') {
            $request->validate([
                'searchCategory' => 'required'
            ]);
            $result = Item::where('item_category', $request->input('searchCategory'))->get()->all();
            return count($result) > 0 ? view('/search')->with('resultCategory', $result) : view('/search')->with('SearchError', 'No Items Found with the specified category!');
        } else if ($searchUnit === 'itemName') {
            $request->validate([
                'itemName' => 'required'
            ]);
            $result = Item::where('item_name', 'LIKE', '%'.$request->input('itemName').'%')->get()->all();
            return count($result) > 0 ? view('/search')->with('resultName', $result) : view('/search')->with('SearchError', 'No Items Found!');
        } else if ($searchUnit === 'itemDescription') {
            $request->validate([
                'itemDescription' => 'required'
            ]);
            $result = Item::where('item_description', 'LIKE', '%'.$request->input('itemDescription').'%')->get()->all();
            return count($result) > 0 ? view('/search')->with('resultDescription', $result) : view('/search')->with('SearchError', 'No Items Found!');
        } else if ($searchUnit === 'itemPicture') {
            $allData = Item::select('item_images', 'item_category')->get()->all();
            $maxLength = count($allData);
            $allPictures = [];

            for ($i = 0; $i < $maxLength; $i++) {

                $images = $allData[$i]['item_images'];
                $category = $allData[$i]['item_category'];

                if (strpos($images, '|') !== false) {
                    $images = explode('|', $images);
                    foreach ($images as $image) {
                        $arr = array(
                            'category' => $category,
                            'pic' => $image
                        );
                        array_push($allPictures, $arr);
                    }
                } else {
                    $arr = array(
                        'category' => $category,
                        'pic' => $images
                    );
                    array_push($allPictures, $arr);
                }
            }
            return count($allPictures) > 0 ? view('/search')->with('resultPictures', $allPictures) : view('/search')->with('SearchError', 'No Pictures Found!');
        }

        return view('/search');
    }


    public function samePicCategories(Request $request)
    {
        $this->validate($request, [
            'picItemCategory' => 'required'
        ]);

        $allCat = Item::where('item_category', $request->input('picItemCategory'))->get()->all();

        return count($allCat) > 0 ? view('/search')->with('resultCategory', $allCat) : view('/search')->with('SearchError', 'No Items Found with the specified category!');
    }
}
