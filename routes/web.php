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

use App\Http\Controllers\UsersController;


Route::get('/', function () {
    return view('welcome');
})->middleware('auth');

//AUTH
Route::post('/loginAction', [UsersController::class, 'login']);
Route::get('/logout', [UsersController::class, 'logout']);
Route::get('/register', function () {
    return view('register');
});
Route::get('/login', function () {
    return view('login');
})->name('login');
Route::post('/registerAction', [UsersController::class, 'register']);
