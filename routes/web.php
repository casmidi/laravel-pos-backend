<?php

use App\Http\Controllers\ProductController;
use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Storage;

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

// Route::get('/', function () {
//     return view('pages.auth.login');
// });


Route::get('/', function () {
    return view('pages.auth.login');
});

Route::middleware(['auth'])->group(function () {
    Route::get('home', function () {
        return view('pages.dashboard');
    });

    Route::resource('user',UserController::class);
    Route::resource('product',ProductController::class);

});


Route::get('storage/products/{filename}', function ($filename) {
    $path = storage_path('app/public/products/' . $filename);

    if (!Storage::exists('public/products/' . $filename)) {
        abort(404);
    }

    return response()->file($path);
})->where('filename', '.*');


// Route::get('/login', function () {
//     return view('pages.auth.login');
// })->name('login');

// Route::get('/register',function() {
//     return view('pages.auth.register');
// })->name('register');

// Route::get('/users',function () {
//     return view('pages.users.index');
// });
