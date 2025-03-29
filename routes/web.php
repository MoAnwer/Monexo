<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\TransactionController;
use App\Http\Controllers\GoalController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\LogController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\AssistantController;
use App\Http\Controllers\SettingController;
use App\Http\Controllers\SavingController;
use App\Http\Controllers\BooksController;
use App\Http\Controllers\VideosController;

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
    if (Auth::check()) {
        return to_route('dashboard');
    }
    return to_route('login');
});

Route::get('helper', function() {

    // return (string) \Str::orderedUuid(); // 9de7421e-f3bf-44ac-83de-229de70ffe6c
    return (string) \Str::orderedUuid();
    
});

Route::controller(AuthController::class)->group(function () {
    Route::get('login',  'loginPage')->name('login')->middleware('guest');
    Route::post('login',  'login')->name('login.action');
    Route::get('register', 'registerPage')->name('registerPage');
    Route::post('register', 'register')->name('register');
    Route::get('forget-password', 'forgetPassword')->name('auth.forget-password');
});


Route::middleware('auth')->group(function () {
    Route::controller(HomeController::class)->group(function() {
        Route::get('dashboard', 'dashboard')->name('dashboard');
    });
    // Transactions
    Route::controller(TransactionController::class)->prefix('transactions')->group(function () {
        Route::get('', 'index')->name('transactions.index');
        Route::get('show/{id}', 'show')->name('transactions.show');
        Route::get('edit/{id}', 'edit')->name('transactions.edit');
        Route::post('create', 'create')->name('transactions.create');
        Route::put('update/{id}', 'update')->name('transactions.update');
        Route::delete('delete/{id}', 'delete')->name('transactions.delete');
        Route::get('type/{type}', 'transactionsByType');
        Route::get('date/{date}', 'transactionsByDate')->name('transactions.transactionsByDate');
        Route::get('date/get/{date}', 'findTransactionByDate')->name('transactions.findTransactionByDate');
        Route::get('/week-expenses', 'weeklyExpensesAmounts');
        Route::get('delete/{id}', 'deletePage')->name('transactions.deletePage');
    });

    // goals
    Route::controller(GoalController::class)->prefix('goals')->group(function () {
        Route::get('', 'index')->name('goals.index');
        Route::get('{id}', 'show')->name('goals.show');
        Route::post('create', 'create')->name('goals.create');
        Route::get('edit/{id}', 'edit')->name('goals.edit');
        Route::put('update/{id}', 'update')->name('goals.update');
        Route::delete('delete/{id}', 'delete')->name('goals.delete');
        Route::get('delete/{id}', 'deletePage')->name('goals.deletePage');
        Route::get('search?{name}', 'search')->name('goals.search');
    });

    // Profile
    Route::controller(ProfileController::class)->prefix('profile')->group(function () {
        Route::get('', 'profile')->name('profile');
        Route::put('update', 'updateProfile')->name('profile.update');
        Route::put('reset-password', 'resetPassword');
        Route::delete('deleteAccount', 'deleteAccount')->name('profile.delete');
    });

    // Logs and notifications

    Route::controller(LogController::class)->prefix('notifications')->group(function () {
        Route::get('', 'notifications')->name('notifications');
    });

    // MonexoAi
    Route::controller(AssistantController::class)->prefix('ai-assistant')->group(function() {
        Route::get('', 'chat')->name('ai-chat');
        Route::post('/chat/qwen', 'sendMessageToQwen')->name('chat.send');
    });

    // Settings
    Route::controller(SettingController::class)->prefix('settings')->group(function() {
        Route::get('', 'index')->name('settings.index');
    });

    // Saving boxs

    Route::controller(SavingController::class)->prefix('saving')->group(function ()
    {
        Route::get('', 'index')->name('saving.index');
        Route::post('create', 'create')->name('saving.create');
        Route::get('edit/{id}', 'edit')->name('saving.edit');
        Route::put('update/{id}', 'update')->name('saving.update');
        Route::get('delete/{id}', 'deletePage')->name('saving.deletePage');
        Route::delete('delete/{id}', 'delete')->name('saving.delete');
    });

    // Video

    Route::prefix('finances-content')->group(function() {
        Route::get('videos', [VideosController::class, 'videos'])->name('videos');
        Route::get('books', [BooksController::class, 'books'])->name('books');
    });

});

Route::get('/logout', [AuthController::class, 'logout'])->name('logout');

Route::get('/send', function () {
    Mail::to('test@mail.com')->send(new App\Mail\DemoMail);
});