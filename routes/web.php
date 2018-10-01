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
//
//Route::get('/', function () {
//    return view('welcome');
//});
Route::get('/', 'HomeController@index');

Auth::routes();

//Route::get('/home', 'HomeController@index')->name('home');

Route::resource('category', 'CategoryController');
Route::resource('subcategory', 'SubCategoryController');
Route::resource('post', 'PostController');

//Route::get('/ajax-subcat', function (){
////    $cat_id = Input::get('cat_id');
//    $cat_id = $_GET["cat_id"];
//
//    $subcategories = \App\SubCategory::where('category_id', $cat_id)->get();
//    return Response::json($subcategories);
//});

Route::get('/ajax-subcat', function (){
    $cat_id = $_GET["cat_id"];

    $subcategories = \App\SubCategory::where('category_id', $cat_id)->get();
    return Response::json($subcategories);
});