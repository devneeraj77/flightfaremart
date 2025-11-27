<?php

use App\Http\Controllers\Admin\Blog\CategoryController;
use App\Http\Controllers\Admin\Blog\PostController as BlogPostController;
use App\Http\Controllers\Admin\BlogController;
use App\Http\Controllers\Admin\blog\PostController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\ContactController;
use App\Http\Controllers\UserAuthController;
use Illuminate\Support\Facades\Session;
use App\Http\Controllers\FlightController;
use Illuminate\Support\Facades\DB;

Route::get('/', function () {
    return view('welcome');
});

// Route to show the form
Route::get('/flights', function () {
    return view('flights.index');
});
Route::get('/', [\App\Http\Controllers\TestimonialController::class, 'index']);


Route::get('scripts.db-check', function () {
    try {
        DB::connection()->getPdo();
        return response()->json(['status' => 'ok', 'message' => 'Database connected']);
    } catch (Exception $e) {
        return response()->json(['status' => 'error', 'message' => $e->getMessage()], 500);
    }
});

// Route to handle the search (POST request)
Route::post('/flights/search', [FlightController::class, 'search'])->name('flights.search');


Route::view('/privacy-policy', 'privacy-policy')->name('privacy');
Route::view('/terms', 'terms')->name('terms');
Route::view('/about', 'about')->name('about');
Route::view('/faqs', 'faqs')->name('faqs');
Route::view('/blog', 'blog')->name('blog');
Route::get('/contact', [ContactController::class, 'create'])->name('contact.create');

// Route to handle the form submission and save data
Route::post('/contact', [ContactController::class, 'store'])->name('contact.store');





// User Auth Routes
Route::get('/login', [UserAuthController::class, 'showLoginForm'])->name('login');
Route::post('/login', [UserAuthController::class, 'login'])->name('login.post');

Route::get('/register', [UserAuthController::class, 'showRegisterForm'])->name('register');
Route::post('/register', [UserAuthController::class, 'register'])->name('register.post');

Route::get('/logout', [UserAuthController::class, 'logout'])->name('logout');


// Home redirect for /admin
Route::get('/admin', [AdminController::class, 'adminHome'])->name('admin.welcome');

// Admin login
Route::get('/admin/login', [AdminController::class, 'showLoginForm'])->name('admin.login');
Route::post('/admin/login', [AdminController::class, 'login'])->name('admin.login.post');

// Admin dashboard (protected)
Route::get('/admin/dashboard', [AdminController::class, 'dashboard'])->name('admin.dashboard');
Route::get('/admin/blog/allposts', [BlogController::class, 'allposts'])->name('blog.allposts');
Route::get('/admin/blog/posts/index', [BlogPostController::class, 'index'])
    ->name('admin.blog.posts.index');
Route::post('/admin/blog/posts/create', [BlogPostController::class, 'create'])
    ->name('posts.create');
Route::get('/admin/blog/posts/store', [BlogPostController::class, 'store'])
    ->name('posts.store');
Route::post('/admin/blog/AddNewPost', [BlogPostController::class, 'AddNewPost'])->name('blog.AddNewPost');
Route::get('/admin/messages', [ContactController::class, 'index'])->name('admin.messages.index');

// routes/web.php
// Route::view('/admin/layouts/sidebar', 'sidebar')->name('admin.layouts.sidebar');
Route::view('/amdin/layouts/sidebar', 'sidebar')->name('sidebar');

// Admin logout
Route::get('/admin/logout', [AdminController::class, 'logout'])->name('admin.logout');

// Redirect /admin to appropriate location
Route::get('/admin', function () {
    if (Session::has('admin_id')) {
        return redirect()->route('admin.dashboard');
    }
    return redirect()->route('admin.login');
});



    // Blog Posts CRUD
    Route::resource('/admin/blog/posts', PostController::class)->except(['show']);
    
    // Categories CRUD <-- New Resource Definition
    // Defines routes for admin/blog/categories/...
    Route::resource('/admin/blog/categories', CategoryController::class)->except(['show']);

    