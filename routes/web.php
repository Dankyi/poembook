<?php

use App\Http\Controllers\Auth\GithubController;
use App\Http\Controllers\Auth\GoogleController;
use App\Http\Controllers\MailController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PoemController;

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

Auth::routes();

Route::get('/auth/google/redirect', [GoogleController::class, 'redirect'])->name('google.redirect');
Route::get('/auth/google/callback', [GoogleController::class, 'callback'])->name('google.callback');

Route::get('/auth/github/redirect', [GithubController::class, 'redirect'])->name('github.redirect');
Route::get('/auth/github/callback', [GithubController::class, 'callback'])->name('github.callback');

Route::middleware (['auth', 'verified']) -> group (function () {

    Route::get('/', [PoemController::class, 'index'])->name('index');

    Route::get('/poem/', [PoemController::class, 'create'])->name('poem.create');
    Route::post('/poem/', [PoemController::class, 'store'])->name('poem.store');

    Route::get('/poem/{poem}/edit', [PoemController::class, 'edit'])->name('poem.edit');
    Route::patch('/poem/{poem}/', [PoemController::class, 'update'])->name('poem.update');

    Route::delete('/poem/{poem}/', [PoemController::class, 'destroy'])->name('poem.destroy');

    Route::get('/poem/{poem}/', [PoemController::class, 'show'])->name('poem.show');

    Route::get('/poem/{poem}/email', [MailController::class, 'sendPoemDetails']);

    Route::post('/poem/{poem}/like', [PoemController::class, 'like'])->name('poem.like');
    Route::post('/poem/{poem}/dislike', [PoemController::class, 'dislike'])->name('poem.dislike');

    Route::post('/poem/{poem}/favorite', [PoemController::class, 'favorite'])->name('poem.favorite');
    Route::get('/myfavorites/', [PoemController::class, 'myfavorites'])->name('poem.myfavorites');

    Route::get('/search/', [PoemController::class, 'search'])->name('search');

    Route::post('/poem/{poem}/comment', [PoemController::class, 'comment'])->name('poem.comment');

    Route::view('/profile/edit', 'profile.edit')->name('profile');

    Route::view('/profile/password', 'profile.password')->name('profile.password');

});
