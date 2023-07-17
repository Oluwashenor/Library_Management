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
use App\Http\Controllers\BookController;
use App\Http\Controllers\BookRequestController;
use App\Http\Controllers\LendController;


// Route::get('/', function () {
//     return view('welcome');
// })->middleware('auth');
Route::get('/', [BookController::class, 'index'])->middleware('auth');


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
Route::get('/forgotpassword', [UsersController::class, 'forgotpassword']);
Route::post('/forgot_password', [UsersController::class, 'forgot_password']);
Route::get('/passwordReset/{token}', [UsersController::class, 'passwordReset'])->name('passwordReset');

Route::post('/updatePassword', [UsersController::class, 'updatePassword'])->name('updatePassword');


//Books
Route::get('/books', [BookController::class, 'index'])->middleware('auth');
Route::post('/deleteBook/{id}', [BookController::class, 'delete'])->name('passwordReset');

// Route::get('/booksadmin', [BookController::class, 'indexAdmin'])->name('booksAdmin');;
Route::post('/createBook', [BookController::class, 'create'])->middleware('auth');
Route::post('/editBook', [BookController::class, 'edit'])->middleware('auth');

Route::get('/booksRequest', [BookRequestController::class, 'index'])->middleware('auth');
Route::post('/requestBook', [BookRequestController::class, 'create'])->middleware('auth');

Route::post('/lendBook', [LendController::class, 'create'])->middleware('auth');
