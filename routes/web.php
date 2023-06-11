<?php

use App\Http\Controllers\Admin\PertanyaanController;
use App\Http\Controllers\Admin\UserController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\ChatController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\Notification;
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




Route::middleware('tenant')->group(function() {
    Route::get('/test', function () {
        return view('welcome');
    });


});

// Auth
Route::get('/', [AuthController::class , 'login'])->name('login')->middleware('guest');
Route::post('/login-store', [AuthController::class , 'loginStore'])->name('loginStore');

Route::get('/register', [AuthController::class , 'register'])->name('register')->middleware('guest');
Route::post('/register-store', [AuthController::class , 'registerStore'])->name('registerStore');
Route::post('/logout', [AuthController::class , 'logout'])->name('logout');


Route::middleware(['auth'])->group(function () {
    Route::get('/dashboard', [HomeController::class , 'index'])->name('dashboard.index');


    Route::get('/pertanyaan', [PertanyaanController::class , 'index'])->name('admin.pertanyaan');
    Route::get('/tambah-pertanyaan', [PertanyaanController::class , 'tambahPertanyaan'])->name('admin.tambahPertanyaan');
    Route::post('/store-pertanyaan', [PertanyaanController::class , 'storePertanyaan'])->name('admin.storePertanyaan');
    Route::post('/submit-pertanyaan', [PertanyaanController::class , 'submitPertanyaan'])->name('admin.submitPertanyaan');
    Route::post('/delete-pertanyaan', [PertanyaanController::class , 'deletePertanyaan'])->name('admin.deletePertanyaan');
    
    
    Route::get('/user', [UserController::class , 'index'])->name('admin.userAll');
    Route::get('/detail-user/{id}', [UserController::class , 'detail'])->name('admin.detail');

    Route::post('/verify-user/{id}', [UserController::class , 'verifyUser'])->name('admin.verifyUser');


    Route::get('/chat', [ChatController::class , 'index'])->name('chat');
    Route::post('/store-chat', [ChatController::class , 'storeChat'])->name('storeChat');
    Route::get('/getmessages', [ChatController::class , 'getMessages'])->name('getMessages');

    Route::get('/notification', [Notification::class , 'index'])->name('notification');
    Route::get('/detail-notification/{id}', [Notification::class , 'detail'])->name('notification.detail');


});

