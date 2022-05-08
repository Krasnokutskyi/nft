<?php

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


Route::middleware("guest:web")->group(function() {

  // Home
  Route::get('/', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

  // Auth
  Route::post('/login/', [\App\Http\Controllers\Auth\LoginController::class, 'loginAction'])->name('loginAction');
  Route::post('/register/', [\App\Http\Controllers\Auth\RegisterController::class, 'registerAction'])->name('registerAction');
  Route::post('/register/pay/', [\App\Http\Controllers\Auth\RegisterController::class, 'registerActionPay'])->name('registerAction.pay');
});

Route::middleware(["auth:web"])->group(function() {

  // Logout
  Route::get('/logout/', [\App\Http\Controllers\Auth\LogoutController::class, 'logout'])->name('logout');

  // Blog
  Route::get('/blog/', [App\Http\Controllers\Blog\PostsController::class, 'posts'])->name('blog.posts');
  Route::get('/blog/{alias}/', [App\Http\Controllers\Blog\PostsController::class, 'posts'])->name('blog.postsByCategory');
  Route::get('/blog/posts/{alias}/', [App\Http\Controllers\Blog\PostsController::class, 'post'])->name('blog.post');
  Route::get('/storage/content/blog/preview/{image}', [App\Http\Controllers\Blog\PostsController::class, 'showPostPreview'])->name('storage.content.blog.preview');

  // Video
  Route::get('/videos/', [App\Http\Controllers\Video\PostsController::class, 'posts'])->name('videos.posts');
  Route::get('/videos/{alias}/', [App\Http\Controllers\Video\PostsController::class, 'posts'])->name('videos.postsByCategory');
  Route::get('/storage/content/video/{video}/', [App\Http\Controllers\Video\PostsController::class, 'showVideo'])->name('storage.content.video');
  Route::get('/storage/content/video/preview/{image}/', [App\Http\Controllers\Video\PostsController::class, 'showVideoPreview'])->name('storage.content.video.preview');

  // Downloads
  Route::get('/downloads/', [App\Http\Controllers\Downloads\FilesController::class, 'files'])->name('downloads.files');
  Route::get('/storage/content/downloads/preview/{image}/', [App\Http\Controllers\Downloads\FilesController::class, 'showFilePreview'])->name('storage.content.downloads.preview');
  Route::get('/storage/content/downloads/files/', [App\Http\Controllers\Downloads\FilesController::class, 'downloadAllFiles'])->name('storage.content.downloads.allFiles');
  Route::get('/storage/content/downloads/files/{file}/', [App\Http\Controllers\Downloads\FilesController::class, 'downloadFile'])->name('storage.content.downloads.file');

  // Calendar
  Route::get('/calendar/', [App\Http\Controllers\Calendar\CalendarController::class, 'calendar'])->name('calendar');
  
  // Market Activity
  Route::get('/market-activity/', [App\Http\Controllers\MarketActivity\MarketActivityController::class, 'index'])->name('marketActivity');
});