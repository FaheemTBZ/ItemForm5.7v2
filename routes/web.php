<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return view('/welcome');
});

Auth::routes();

Route::middleware(['auth'])->group(function () {
    Route::get('/approval', 'HomeController@approval')->name('approval');

    Route::middleware(['approved'])->group(function () {
        Route::get('/home', 'HomeController@index')->name('home');
        Route::get('/search', 'RoutesController@search')->name('search');
    });
    

    Route::middleware(['admin'])->group(function () {
        Route::get('/users', 'UserController@index')->name('admin.users.index');
        Route::post('/approve', 'UserController@approve')->name('admin.users.approve');
    });
});

Route::post('/storeitem', 'ItemsController@store');

Route::get('/populateCategories', 'CategoriesController@index')->middleware('auth');
Route::post('/addnewcategory', 'CategoriesController@store');

Route::get('/populateSuppliers', 'SuppliersController@index')->middleware('auth');
Route::post('/addsupplier', 'SuppliersController@store');

Route::post('/searchitemdata', 'SearchController@search');
Route::post('/editItem', 'ItemsController@edit');
Route::post('/updateitem', 'ItemsController@update');
Route::post('/samepiccategories', 'SearchController@samePicCategories');

Route::post('/addmoreprice', 'ItemSupplierController@store');

Route::post('/editItemPics', 'PicturesController@edit');

Route::post('/deletesupplier', 'ItemSupplierController@deletePriceRow'); // Delete Supplier Row from Item Form
Route::post('/updatesupplier', 'ItemSupplierController@updatePriceRow'); // Update Supplier Row From Item Form

Route::post('/viewdoc', 'ItemSupplierController@getDoc');
Route::post('/actiondoc', 'ItemSupplierController@actionDoc');

Route::get('/getAllUsers', 'UserController@getAllUsers');