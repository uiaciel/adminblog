<?php

use Illuminate\Support\Facades\Route;
use Uiaciel\Adminblog\Controllers\AdminBlogController;
use Uiaciel\Adminblog\Controllers\PostController;
use Uiaciel\Adminblog\Controllers\CategoryController;
use Uiaciel\Adminblog\Controllers\ImageController;

Route::get('demo', function () {
    echo 'Hello from the demo package!';
});

Route::post('/admincp/upload', [AdmincpController::class, 'tinymce'])->name('upload');

Route::resource('admincp', AdminBlogController::class);
Route::resource('/admincp/category', CategoryController::class)->except('create', 'edit');
Route::resource('/admincp/posts', PostController::class);
Route::resource('/admincp/images', ImageController::class);
