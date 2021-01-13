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
    return view('welcome');
});

Auth::routes();

//Route::get('/home', 'HomeController@index')->name('home');

Auth::routes();

//Route::get('/home', 'HomeController@index')->name('home');

//Admin panal
Route::get('/home', 'AdminController@index')->name('home');
Route::get('/addcatagory', 'catagoryController@create');
Route::post('/addcatagory','catagoryController@store');
Route::get('/managecatagory', 'catagoryController@show');
Route::get('catagory/edit/{id}','catagoryController@edit');
Route::post('/updateCatagory','catagoryController@edit1');
Route::get('catagory/delete/{id}','catagoryController@delete');



Route::get('/addproduct', 'productController@create');
Route::post('/addproduct','productController@store');
Route::get('/manageproductadmin', 'productController@show');
Route::get('/manageproductuser', 'productController@user');
Route::get('product/edit/{id}','productController@edit');
Route::post('/updateproduct','productController@edit1');
Route::get('product/delete/{id}','productController@delete');

Route::get('/user','UserController@index');
//Admin panal


//Cart system
Route::get('/single/cart/{id}','cartController@singlecart');
Route::get('/viewcart/','cartController@viewcart');
Route::get('/viewcart/{id}','cartController@viewcart');
Route::post('/updatecart','cartController@updatecart')->name('updatecart');



