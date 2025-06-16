<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\TelegramController;
use App\Livewire\CreateAccount\CreateAccount;
use App\Livewire\Dashboard\Dashboard;
use App\Livewire\EntranceAccount\EntranceAccount;
use App\Livewire\MyClients\MyClients;
use App\Livewire\MyFriends;
use App\Livewire\MyPayments\MyPayments;
use App\Livewire\MyProfile\MyProfile;
use App\Livewire\RecoveryAccount\RecoveryAccount;
use App\Livewire\Survey;
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
});

Route::middleware(['guest'])->group(function () {
    Route::get('/register',CreateAccount::class)->name('register');

    Route::get('/login',EntranceAccount::class)->name('login');

    Route::get('/recovery',RecoveryAccount::class)->name('recovery');
});

Route::post('/telegram/webhook', [TelegramController::class, 'webhook']);

Route::get('/test',\App\Livewire\Test::class)->name('test');

Route::get('/', \App\Livewire\ChooseLogin::class)->name('choose-login');

Route::get('/tg-login', \App\Livewire\TgLogin::class)->name('tg-login');

Route::get('/main-page', \App\Livewire\MainPage::class)->name('main-page');

Route::post('/tgUsername', [TelegramController::class, 'getTgUsername'])->name('get-tg-username');
Route::post('/check-consent', [TelegramController::class, 'checkConsent'])->name('check-consent');
Route::post('/save-consent', [TelegramController::class, 'saveConsent'])->name('save-consent');

Route::get('/my-earnings', \App\Livewire\MyEarnings::class)->name('my-earnings');

Route::get('/my-clients', \App\Livewire\MyClients\MyClients::class)->name('my-clients');
Route::get('/my-profile', \App\Livewire\MyProfile\MyProfile::class)->name('my-profile');

Route::get('/my-payments', \App\Livewire\MyPayments\MyPayments::class)->name('my-payments');
Route::get('/survey', Survey::class)->name('survey');
Route::get('my-friends', MyFriends::class)->name('my-friends');
Route::get('/test-survey', \App\Livewire\TestSurvey::class)->name('test-survey');
Route::get('/learning', \App\Livewire\Learning::class)->name('learning');
Route::get('/blocked', \App\Livewire\BlockedUserPage::class)->name('blocked');
