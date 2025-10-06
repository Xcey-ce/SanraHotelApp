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
    return view('layouts.app');
});

Route::get('/dashboard', function () {
    return view('layouts.dashboard');
})->name('dashboard');


Route::get('/reservation', function () {
    return view('layouts.reservation');
})->name('reservation');

Route::get('/guest', function () {
    return view('layouts.guest');
})->name('guest');

Route::get('/rooms', [App\Http\Controllers\RoomController::class, 'roomIndex'])->name('rooms.index');
Route::post('/rooms/store', [App\Http\Controllers\RoomController::class, 'storeRoom'])->name('rooms.store');
Route::put('/rooms/update/{id}', [App\Http\Controllers\RoomController::class, 'updateRoom'])->name('rooms.update');
Route::delete('/rooms/delete/{id}', [App\Http\Controllers\RoomController::class, 'deleteRoom'])->name('rooms.delete');

