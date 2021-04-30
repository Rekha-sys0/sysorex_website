<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ContactController;
use App\Http\Controllers\Admin\AuthController;
use App\Http\Controllers\Admin\AdminController;
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
    return view('index');
});

Route::get('/aboutus',function(){
    return view('about_us');
});

Route::get('/contactus',function(){
    return view('contactus');
});
Route::post('/sentmessage',[ContactController::class,'addContact']);

Route::get('/event-details',function(){
    return view('event_details');
});

Route::get('/events',function(){
    return view('events');
});

Route::get('/products',function(){
    return view('products');
});

Route::get('/registration',function(){
    return view('workshop-registration');
});


// Admin Routes
Route::get('/admin',[AuthController::class,'login']);

Route::post('/admin/checkLogin',[AuthController::class,'checkLogin']);

Route::get('/admin/dashboard',[AdminController::class,'dashboard']);
