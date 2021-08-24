<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PagesController;
use App\Http\Controllers\ArticleController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\CommentController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\PlaylistController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\ReplyController;
use App\Http\Controllers\TagController;
use App\Http\Controllers\VideoController;

// pages Controller
Route::get('/', [PagesController::class, 'index']);
Route::get('/video', [PagesController::class, 'video']);
Route::get('/about', [PagesController::class, 'about']);
Route::get('/contact', [PagesController::class, 'contact']);
Route::get('/blog', [PagesController::class, 'blog']);
Route::get('/playlist', [PagesController::class, 'playlist'])->name('playlist');
Route::get('/profil/{email}', [ProfileController::class, 'show'])->name('profile.public');

Route::middleware(['verified', 'auth'])->group(function () {
    // article controller
    Route::post('/article/create', [ArticleController::class, 'store'])->name('article.create');
    Route::get('/article/create', [ArticleController::class, 'create']);
    Route::get('/article/{slug}', [ArticleController::class, 'show'])->withoutMiddleware('auth');
    Route::delete('/article/destroy/{Article:slug}', [ArticleController::class, 'destroy'])->name('article.destroy');

    // Comment Controller
    Route::post('/comment/create/{article:slug}', [CommentController::class, 'store'])->name('add.comment');
    Route::get('/comment/create/{article:slug}', [CommentController::class, 'createAbort']); //biar ngak ada yang ngakses methodnya pake url
    Route::post('/comment/reply', [ReplyController::class, 'store'])->name('add.reply');


    Route::get('/profile/edit', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile/edit', [ProfileController::class, 'update'])->name('profile.edit');
    Route::get('/profile', [ProfileController::class, 'index'])->name('profile');
    Route::post('/profile/add/{sosial}', [ProfileController::class, 'addSosialMedia'])->name('addSosialMedia');
});

// Pages Dashboard 
Route::prefix('dashboard')->middleware(['auth', 'verified'])->group(function () {
    Route::get('articles', [DashboardController::class, 'articles'])->name('article.index');
    Route::resource('category', CategoryController::class);
    Route::resource('videos', VideoController::class);

    Route::get('videos/{slug}/{playlist}', [VideoController::class, 'showVideoPlaylist'])->name('videos.show.playlist');
    Route::get('users', [DashboardController::class, 'users'])->middleware('role:admin')->name('users.index');

    Route::resource('playlists', PlaylistController::class);
    Route::post('playlists/addVideo/{slug}', [PlaylistController::class, 'addVideo'])->name('playlists.addVideo');
    Route::delete('playlists/removeVideo/{video_id}/{slug}', [PlaylistController::class, 'removeVideo'])->name('playlists.removeVideo');
});
// category Controller
Route::get('/category/{category:slug}', [CategoryController::class, 'get'])->name('category.show');

Auth::routes(['verify' => true]);
