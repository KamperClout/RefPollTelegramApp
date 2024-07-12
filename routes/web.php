<?php

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

Route::get('/', function () {
    return view('livewire.dashboard.dashboard');
});

Route::get('/create-account', function () {
    return view('livewire.create-account.create-account');
});

Route::get('/entrance-account', function () {
    return view('livewire.entrance-account.entrance-account');
});
