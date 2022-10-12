<?php

use Illuminate\Support\Facades\Auth;
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

Route::get('/', function () {
    return view('welcome');
});

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home')->middleware('2fa');

Route::get('/todos', [App\Http\Controllers\TodoController::class, 'show'])->name('todos.show')->middleware('2fa');
Route::post('/todos', [App\Http\Controllers\TodoController::class, 'create'])->name('todos.create')->middleware('2fa');
Route::delete('/todos/delete/{id}', [App\Http\Controllers\TodoController::class, 'delete'])->name('todos.delete')->middleware('2fa');
Route::get('/todos/{id}', [App\Http\Controllers\TodoController::class, 'showid'])->name('todos.showid')->middleware('2fa');

Route::get('2fa', [App\Http\Controllers\TwoFAController::class, 'index'])->name('2fa.index');
Route::post('2fa', [App\Http\Controllers\TwoFAController::class, 'store'])->name('2fa.post');
Route::get('2fa/reset', [App\Http\Controllers\TwoFAController::class, 'resend'])->name('2fa.resend');

Route::get('code', [App\Http\Controllers\SmsController::class, 'generateCode'])->name('code.generateCode');
Route::get('code/send', [App\Http\Controllers\SmsController::class, 'sendSMS'])->name('code.sendSMS');

