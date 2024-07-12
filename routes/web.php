<?php

use App\Livewire\Dashboard\Dashboard;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

//Route::get('/', function () {
//    return view('dashboard');
//});

Route::get('/', function () {
    return view('livewire.dashboard.dashboard');
});

Route::get('/create-accaunt', function () {
    return view('livewire.create-accaunt.create-accaunt');
});

Route::get('/entrance-accaunt', function () {
    return view('livewire.entrance-accaunt.entrance-accaunt');
});
