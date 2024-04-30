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

use App\Http\Controllers\NotificationsController;
use App\Livewire\AllNotifications;


Route::get('/dashboard', function () {
    return view('welcome');
});
Route::get('/import', function () {
    return view('welcome');
});
// Route::get('/index',AllNotifications::class);
Route::get('/store',[NotificationsController::class, 'store']);
Route::get('/send',[NotificationsController::class, 'send']);
Route::post('/import',[NotificationsController::class, 'import']);

