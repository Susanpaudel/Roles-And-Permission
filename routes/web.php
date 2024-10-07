<?php

use Illuminate\Support\Facades\Route;

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
Route::namespace('App\Http\Controllers')->group(function(){
Route::get('/','WelcomeController@index')->name('welcome');
Route::post('/change_language','WelcomeController@change_language')->name('chnage_language');
});

Auth::routes();

//Route::get('/home', 'App\Http\Controllers\HomeController::class, 'index'])->name('home');
Route::namespace('App\Http\Controllers')->name('admin.')->prefix("admin")->middleware('auth')->group(function(){
  Route::get('/dashboard','DashboardController@index')->name('dashboard');
  Route::prefix('product-management')->name('products.')->group(function(){
    Route::get('/','ProductController@index')->name('index');
    Route::get('/create','ProductController@create')->name('create');
    Route::post('/store','ProductController@store')->name('store');
    Route::get('/show/{id}','ProductController@show')->name('show');
    Route::get('/edit/{id}','ProductController@edit')->name('edit');
    Route::post('/update/{id}','ProductController@update')->name('update');
    Route::get('/delete/{id}','ProductController@destroy')->name('delete');
  });
  Route::prefix('blog-management')->name('blogs.')->group(function(){
    Route::get('/','BlogController@index')->name('index');
    Route::get('/create','BlogController@create')->name('create');
    Route::get('/show/{id}','BlogController@show')->name('show');
    Route::post('/store','BlogController@store')->name('store');
    Route::get('/edit/{id}','BlogController@edit')->name('edit');
    Route::post('/update/{id}','BlogController@update')->name('update');
    Route::get('/delete/{id}','BlogController@destroy')->name('delete');
  });

  Route::prefix('role-permission-management')->name('roles-and-permission.')->group(function(){
    Route::get('/','RolePermissionController@index')->name('index');
    Route::get('/create','RolePermissionController@create')->name('create');
    Route::get('/show/{id}','RolePermissionController@show')->name('show');
    Route::post('/store','RolePermissionController@store')->name('store');
    Route::get('/edit/{id}','RolePermissionController@edit')->name('edit');
    Route::post('/update/{id}','RolePermissionController@update')->name('update');
    Route::get('/delete/{id}','RolePermissionController@destroy')->name('delete');
  });

  Route::name("users.")->prefix("user-management")->group(function(){
    Route::get('/','UserController@index')->name('index');
    Route::get('/create','UserController@create')->name('create');
    Route::post('/store','UserController@store')->name('store');
    Route::get('/show/{id}','UserController@show')->name('show');
    Route::get('/edit/{id}','UserController@edit')->name('edit');
    Route::post('/update/{id}','UserController@update')->name('update');
    Route::get('/delete/{id}','UserController@destroy')->name('delete');
  });

 
});

