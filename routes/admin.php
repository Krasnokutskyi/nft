<?php

use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| AdminPanel Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::middleware("guest:admin")->group(function() {
  Route::get('/admin/login/', [App\Http\Controllers\Admin\Auth\LoginController::class, 'login'])->name('login');
  Route::post('/admin/login/', [App\Http\Controllers\Admin\Auth\LoginController::class, 'loginAction'])->name('loginAction');
});

Route::middleware("auth:admin")->group(function() {

  // Logout
  Route::get('/admin/logout/', [\App\Http\Controllers\Admin\Auth\LogoutController::class, 'logout'])->name('logout');

  // Home
  Route::get('/admin/', [App\Http\Controllers\Admin\HomeController::class, 'index'])->name('home');

  // Blog categories
  Route::get('/admin/content/blog/categories/', [App\Http\Controllers\Admin\Blog\СategoriesController::class, 'categories'])->name('blog.categories');
  Route::get('/admin/content/blog/categories/create/', [App\Http\Controllers\Admin\Blog\СategoriesController::class, 'create'])->name('blog.createCategory');
  Route::post('/admin/content/blog/categories/create/', [App\Http\Controllers\Admin\Blog\СategoriesController::class, 'createAction'])->name('blog.cteateCategoryAction');
  Route::get('/admin/content/blog/categories/edit/{category_id}/', [App\Http\Controllers\Admin\Blog\СategoriesController::class, 'update'])->name('blog.updateCategory');
  Route::post('/admin/content/blog/categories/edit/{category_id}/', [App\Http\Controllers\Admin\Blog\СategoriesController::class, 'updateAction'])->name('blog.updateCategoryAction');
  Route::post('/admin/content/blog/categories/delete/{category_id}/', [App\Http\Controllers\Admin\Blog\СategoriesController::class, 'deleteAction'])->name('blog.deleteCategoryAction');

  // Blog Posts
  Route::get('/admin/content/blog/posts', [App\Http\Controllers\Admin\Blog\PostsController::class, 'posts'])->name('blog.posts');
  Route::get('/admin/content/blog/posts/create/', [App\Http\Controllers\Admin\Blog\PostsController::class, 'create'])->name('blog.createPost');
  Route::post('/admin/content/blog/posts/create/', [App\Http\Controllers\Admin\Blog\PostsController::class, 'createAction'])->name('blog.createPostAction');
  Route::get('/admin/content/blog/posts/edit/{post_id}/', [App\Http\Controllers\Admin\Blog\PostsController::class, 'update'])->name('blog.updatePost');
  Route::post('/admin/content/blog/posts/edit/{post_id}/', [App\Http\Controllers\Admin\Blog\PostsController::class, 'updateAction'])->name('blog.updatePostAction');
  Route::post('/admin/content/blog/posts/delete/{post_id}/', [App\Http\Controllers\Admin\Blog\PostsController::class, 'deleteAction'])->name('blog.deletePostAction');

  // Video categories
  Route::get('/admin/content/videos/categories/', [App\Http\Controllers\Admin\Video\СategoriesController::class, 'categories'])->name('video.categories');
  Route::get('/admin/content/videos/categories/create/', [App\Http\Controllers\Admin\Video\СategoriesController::class, 'create'])->name('video.createCategory');
  Route::post('/admin/content/videos/categories/create/', [App\Http\Controllers\Admin\Video\СategoriesController::class, 'createAction'])->name('video.cteateCategoryAction');
  Route::get('/admin/content/videos/categories/edit/{category_id}/', [App\Http\Controllers\Admin\Video\СategoriesController::class, 'update'])->name('video.updateCategory');
  Route::post('/admin/content/videos/categories/edit/{category_id}/', [App\Http\Controllers\Admin\Video\СategoriesController::class, 'updateAction'])->name('video.updateCategoryAction');
  Route::post('/admin/content/videos/categories/delete/{category_id}/', [App\Http\Controllers\Admin\Video\СategoriesController::class, 'deleteAction'])->name('video.deleteCategoryAction');

  // Video posts
  Route::get('/admin/content/videos/', [App\Http\Controllers\Admin\Video\PostsController::class, 'posts'])->name('video.posts');
  Route::get('/admin/content/videos/create/', [App\Http\Controllers\Admin\Video\PostsController::class, 'create'])->name('video.createPost');
  Route::post('/admin/content/videos/create/', [App\Http\Controllers\Admin\Video\PostsController::class, 'createAction'])->name('video.createPostAction');
  Route::get('/admin/content/videos/edit/{post_id}/', [App\Http\Controllers\Admin\Video\PostsController::class, 'update'])->name('video.updatePost');
  Route::post('/admin/content/videos/edit/{post_id}/', [App\Http\Controllers\Admin\Video\PostsController::class, 'updateAction'])->name('video.updatePostAction');
  Route::post('/admin/content/videos/posts/delete/{post_id}/', [App\Http\Controllers\Admin\Video\PostsController::class, 'deleteAction'])->name('video.deletePostAction');

  // Downloads
  Route::get('/admin/content/downloads/files/', [App\Http\Controllers\Admin\Downloads\FilesController::class, 'files'])->name('downloads.files');
  Route::get('/admin/content/downloads/files/upload/', [App\Http\Controllers\Admin\Downloads\FilesController::class, 'uploadFile'])->name('downloads.files.upload');
  Route::post('/admin/content/downloads/files/upload/', [App\Http\Controllers\Admin\Downloads\FilesController::class, 'uploadFileAction'])->name('downloads.files.uploadAction');
  Route::get('/admin/content/downloads/files/edit/{file_id}', [App\Http\Controllers\Admin\Downloads\FilesController::class, 'edit'])->name('downloads.files.edit');
  Route::post('/admin/content/downloads/files/edit/{file_id}', [App\Http\Controllers\Admin\Downloads\FilesController::class, 'editAction'])->name('downloads.files.editAction');
  Route::post('/admin/content/downloads/files/delete/{file_id}/', [App\Http\Controllers\Admin\Downloads\FilesController::class, 'deleteAction'])->name('downloads.files.deleteAction');

  // Calendar
  Route::get('/admin/content/calendar/', [App\Http\Controllers\Admin\Calendar\CalendarController::class, 'index'])->name('calendar.show');

  // Packages
  Route::get('/admin/packages/', [App\Http\Controllers\Admin\PackagesController::class, 'packages'])->name('packages');
  Route::get('/admin/packages/create/', [App\Http\Controllers\Admin\PackagesController::class, 'create'])->name('packages.create');
  Route::post('/admin/packages/create/', [App\Http\Controllers\Admin\PackagesController::class, 'createAction'])->name('packages.createAction');
  Route::get('/admin/packages/edit/{package_id}', [App\Http\Controllers\Admin\PackagesController::class, 'edit'])->name('packages.edit');
  Route::post('/admin/packages/edit/{package_id}', [App\Http\Controllers\Admin\PackagesController::class, 'editAction'])->name('packages.editAction');
  Route::post('/admin/packages/sortable/', [App\Http\Controllers\Admin\PackagesController::class, 'sortableAction'])->name('packages.sortableAction');
  Route::post('/admin/packages/delete/{package_id}', [App\Http\Controllers\Admin\PackagesController::class, 'deleteAction'])->name('packages.deleteAction');


  // Users
  Route::get('/admin/users/', [App\Http\Controllers\Admin\UsersController::class, 'users'])->name('users');
  Route::get('/admin/users/register/', [App\Http\Controllers\Admin\UsersController::class, 'register'])->name('users.register');
  Route::post('/admin/users/register/', [App\Http\Controllers\Admin\UsersController::class, 'registerAction'])->name('users.registerAction');
  Route::get('/admin/users/edit/{user_id}/', [App\Http\Controllers\Admin\UsersController::class, 'edit'])->name('users.edit');
  Route::post('/admin/users/edit/{user_id}/', [App\Http\Controllers\Admin\UsersController::class, 'editAction'])->name('users.editAction');
  Route::post('/admin/users/delete/{user_id}', [App\Http\Controllers\Admin\UsersController::class, 'deleteAction'])->name('users.deleteAction');
});