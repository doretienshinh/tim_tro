<?php

use Illuminate\Support\Facades\Route;

use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\UserController;

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

Route::get('/', function () {
    return view('welcome');
});

Auth::routes(['verify' => true]);

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->middleware('verified')->name('home');
// Route::get('/login', 'LoginController@showLoginForm')->middleware('login')->name('login');

//admin
Route::middleware(['auth'])->group(function(){

    Route::prefix('admin')->group(function (){
        // Route::get('/', [MainController::class,'index'])->name('admin');

        #User
        Route::prefix('user')->group(function (){
            Route::get('/', [UserController::class, 'index'])->name('admin.user.index');
            // Route::post('add', [MenuController::class, 'store'])->name('admin.menus.store');
            // Route::get('list', [MenuController::class, 'index'])->name('admin.menus.list');
            // Route::get('edit/{menu}', [MenuController::class, 'show'])->name('admin.menus.show');
            // Route::post('edit/{menu}', [MenuController::class, 'update'])->name('admin.menus.update');
            // Route::DELETE('destroy', [MenuController::class, 'destroy'])->name('admin.menus.destroy');
        });
    });

});
