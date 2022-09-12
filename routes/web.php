<?php

use App\Http\Controllers\BlogController;
use App\Http\Controllers\UserController;
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
Route::middleware('auth')->group(function() {
    Route::prefix('blog')->group(function() {
        Route::get('/create', [BlogController::class, 'create'])->name('blogs.create');
        Route::post('store', [BlogController::class, 'store'])->name('blogs.store');
        Route::get('/edit/{blog}', [BlogController::class, 'edit'])->name('blogs.edit');
        Route::patch('/update/{blog}', [BlogController::class, 'update'])->name('blogs.update');
        Route::get('/detail/{blog}', [BlogController::class, 'show'])->name('blogs.show');
        Route::delete('/delete/{blog}', [BlogController::class, 'delete'])->name('blogs.delete');
    });

    Route::prefix('users')->group(function() {
        Route::get('/{user}', [UserController::class, 'show'])->name('profile');
    });

    Route::get('/dashboard', [UserController::class, 'home'])->name('dashboard');

});

Route::get('/', function () {
    // return view('welcome');
    return redirect(route('dashboard'));
});

require __DIR__.'/auth.php';
