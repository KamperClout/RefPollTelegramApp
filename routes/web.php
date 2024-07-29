<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\TelegramController;
use App\Livewire\CreateAccount\CreateAccount;
use App\Livewire\Dashboard\Dashboard;
use App\Livewire\EntranceAccount\EntranceAccount;
use App\Livewire\MyClients\MyClients;
use App\Livewire\MyProfile\MyProfile;
use App\Livewire\RecoveryAccount\RecoveryAccount;
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
    Route::get('/',Dashboard::class)->name('dashboard');

    Route::post('/logout', [AuthController::class, 'logout'])->name('logout');

    Route::get('/my-clients', MyClients::class)->name('my-clients');

    Route::get('/my-profile', MyProfile::class)->name('my-profile');
});

Route::middleware(['guest'])->group(function () {
    Route::get('/register',CreateAccount::class)->name('register');

    Route::get('/login',EntranceAccount::class)->name('login');

    Route::get('/recovery',RecoveryAccount::class)->name('recovery');
});

Route::post('/telegram/webhook', [TelegramController::class, 'webhook']);
