<?php

use App\Http\Controllers\HomeController;
use App\Http\Controllers\PermissionController;
use App\Http\Controllers\PostController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\RoleController;
use App\Http\Controllers\UserController;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;

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

Route::get('/', function () {
    return view('welcome');
});


Route::middleware('auth')->group(function () {
    Route::get('dashboard', [HomeController::class, 'dashboard'])->name('dashboard');
    Route::get('roles', [RoleController::class, 'index'])->name('roles');
    Route::get('permissions', [PermissionController::class, 'index'])->name('permissions');
    Route::get('users', [UserController::class, 'index'])->name('users');
    Route::get('user/edit/{id}', [UserController::class, 'edit'])->name('edit.user');
    Route::post('user/edit/{id}', [UserController::class, 'update']);

    Route::get('users/{id}/impersonate', function ($id) {
        Auth::user()->setImpersonating($id);
        session(['imperson'=> 'yes']);
        return redirect()->back();
    })->name('login.impersonate');
    Route::get('users/stop-impersonate', function () {
        Auth::user()->stopImpersonating();
        session(['imperson'=> 'no']);
        return redirect()->back();
    })->name('stop-impersonate');


    Route::get('posts', [PostController::class, 'index'])->middleware('permission:posts')->name('posts');
    Route::get('post/add', [PostController::class, 'add'])->middleware('permission:add-post')->name('add.post');
    Route::post('post/add', [PostController::class, 'store'])->middleware('permission:add-post');
    Route::get('post/edit/{id}', [PostController::class, 'edit'])->middleware('permission:edit-post')->name('edit.post');
    Route::post('post/edit/{id}', [PostController::class, 'update'])->middleware('permission:edit-post');
    Route::get('post/view/{id}', [PostController::class, 'view'])->middleware('permission:view-post')->name('view.post');
    Route::get('post/delete/{id}', [PostController::class, 'delete'])->middleware('permission:delete-post')->name('delete.post');


    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__ . '/auth.php';
