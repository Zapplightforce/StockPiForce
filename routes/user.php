<?php


use App\Http\Controllers\ProfileController;
use App\Http\Controllers\User\UserController;
use Illuminate\Support\Facades\Route;


Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});


Route::middleware(['auth', 'verified'])->group(function () {
    Route::get('/dashboard', [UserController::class, 'dashboard'])->name('dashboard');
    Route::get('/news', [UserController::class, 'news'])->name('news');
    Route::get('/news/fetch-article-content', [UserController::class, 'fetchArticleContent']);
});
