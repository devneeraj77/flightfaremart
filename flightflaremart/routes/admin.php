<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Admin\BlogController;

/*
|--------------------------------------------------------------------------
| Admin Routes
|--------------------------------------------------------------------------
|
| These routes are grouped with the 'admin' middleware and the 'admin' prefix.
| They are loaded by the RouteServiceProvider.
|
*/

// Middleware and prefix applied here will affect all routes in this file.
Route::middleware(['auth', 'verified', 'admin'])->prefix('admin')->name('admin.')->group(function () {
    
    // Admin Dashboard landing page (optional)
    Route::get('/', function () {
        return view('admin.dashboard'); 
    })->name('dashboard');

    // --- Blog Management Routes ---
    Route::controller(BlogController::class)->prefix('blog')->name('blog.')->group(function () {
        // The URL will be /admin/blog/all-posts
        // The route name will be admin.blog.allposts
        Route::get('all-posts', 'allPosts')->name('allposts');
        
        // Example of other routes you'd add:
        // Route::get('create', 'create')->name('create');
        // Route::post('store', 'store')->name('store');
        // Route::get('edit/{id}', 'edit')->name('edit');
        // Route::put('update/{id}', 'update')->name('update');
        // Route::delete('delete/{id}', 'delete')->name('delete');
    });

});