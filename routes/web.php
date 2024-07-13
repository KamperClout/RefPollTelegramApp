<?php

use App\Http\Controllers\AuthController;
use App\Livewire\CreateAccount\CreateAccount;
use App\Livewire\EntranceAccount\EntranceAccount;
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

Route::middleware(['auth'])->group(function () {
    Route::get('/', function () {
        return view('dashboard');
    })->name('dashboard');

    Route::post('/logout', [AuthController::class, 'logout'])->name('logout');
});

Route::middleware(['guest'])->group(function () {
//    Route::get('/create-account', function () {
//        return view('livewire.create-account.create-account');
//    });
    Route::get('/register',CreateAccount::class)->name('register');

    Route::get('/login', function () {
        return view('livewire.entrance-account.entrance-account');
    })->name('login');
});
