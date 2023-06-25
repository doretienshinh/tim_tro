<?php

use Illuminate\Support\Facades\Route;

use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\HostelController;
use App\Http\Controllers\TimeController;
use App\Http\Controllers\TagController;
use App\Http\Controllers\NotificationController;
use App\Http\Controllers\AttributeController;
use App\Http\Controllers\AttributeHostelController;


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

Route::get('/', [App\Http\Controllers\HomeController::class, 'index'])->middleware('verified');


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
            Route::get('/detail/{id}', [UserController::class, 'show'])->name('admin.user.detail');
            Route::get('/create', [UserController::class, 'create'])->name('admin.user.create');
            Route::post('/create', [UserController::class, 'store'])->name('admin.user.store');
            Route::get('/edit/{id}', [UserController::class, 'edit'])->name('admin.user.edit');
            Route::post('/edit/{id}', [UserController::class, 'update'])->name('admin.user.update');

            // Route::get('list', [MenuController::class, 'index'])->name('admin.menus.list');
            // Route::get('edit/{menu}', [MenuController::class, 'show'])->name('admin.menus.show');
            // Route::post('edit/{menu}', [MenuController::class, 'update'])->name('admin.menus.update');
            // Route::DELETE('destroy', [MenuController::class, 'destroy'])->name('admin.menus.destroy');
        });

        #Hostel
        Route::prefix('hostel')->group(function (){
            Route::get('/', [HostelController::class, 'index'])->name('admin.hostel.index');
            Route::get('/detail/{hostel}', [HostelController::class, 'show'])->name('admin.hostel.detail');
            Route::get('/create', [HostelController::class, 'create'])->name('admin.hostel.create');
            Route::post('/create', [HostelController::class, 'store'])->name('admin.hostel.store');
            Route::get('/edit/{hostel}', [HostelController::class, 'edit'])->name('admin.hostel.edit');
            Route::post('/edit/{hostel}', [HostelController::class, 'update'])->name('admin.hostel.update');
            Route::delete('/destroy/{hostel}', [HostelController::class, 'destroy'])->name('admin.hostel.destroy');
        });

        #Tag
        Route::prefix('tag')->group(function (){
            Route::get('/', [TagController::class, 'index'])->name('admin.tag.index');
            Route::get('/create', [TagController::class, 'create'])->name('admin.tag.create');
            Route::post('/create', [TagController::class, 'store'])->name('admin.tag.store');
            Route::get('/edit/{tag}', [TagController::class, 'edit'])->name('admin.tag.edit');
            Route::post('/edit/{tag}', [TagController::class, 'update'])->name('admin.tag.update');
            Route::get('/delete/{tag}', [TagController::class, 'destroy'])->name('admin.tag.delete');
        });

        #Notification
        Route::prefix('notification')->group(function (){
            Route::get('/', [NotificationController::class, 'index'])->name('admin.notification.index');
            // Route::get('/detail/{id}', [NotificationController::class, 'show'])->name('admin.notification.detail');
            // Route::get('/create', [NotificationController::class, 'create'])->name('admin.notification.create');
            // Route::post('/create', [NotificationController::class, 'store'])->name('admin.notification.store');
            // Route::get('/edit/{id}', [HostelController::class, 'edit'])->name('admin.notification.edit');
            // Route::post('/edit/{id}', [HostelController::class, 'update'])->name('admin.notification.update');
        });

        #Time
        Route::prefix('time')->group(function (){
            Route::get('/', [TimeController::class, 'index'])->name('admin.time.index');
            Route::get('/create', [TimeController::class, 'create'])->name('admin.time.create');
            Route::post('/create', [TimeController::class, 'store'])->name('admin.time.store');
            Route::get('/edit/{time}', [TimeController::class, 'edit'])->name('admin.time.edit');
            Route::post('/edit/{time}', [TimeController::class, 'update'])->name('admin.time.update');
            Route::get('/delete/{time}', [TimeController::class, 'destroy'])->name('admin.time.delete');
        });
    });
    //route for user
    Route::prefix('')->group(function (){
        // Route::get('/', [MainController::class,'index'])->name('admin');

        // #User
        // Route::prefix('user')->group(function (){
        //     Route::get('/', [UserController::class, 'index'])->name('admin.user.index');
        //     Route::get('/detail/{id}', [UserController::class, 'show'])->name('admin.user.detail');
        //     Route::get('/create', [UserController::class, 'create'])->name('admin.user.create');
        //     Route::post('/create', [UserController::class, 'store'])->name('admin.user.store');
        //     Route::get('/edit/{id}', [UserController::class, 'edit'])->name('admin.user.edit');
        //     Route::post('/edit/{id}', [UserController::class, 'update'])->name('admin.user.update');

        //     // Route::get('list', [MenuController::class, 'index'])->name('admin.menus.list');
        //     // Route::get('edit/{menu}', [MenuController::class, 'show'])->name('admin.menus.show');
        //     // Route::post('edit/{menu}', [MenuController::class, 'update'])->name('admin.menus.update');
        //     // Route::DELETE('destroy', [MenuController::class, 'destroy'])->name('admin.menus.destroy');
        // });

        // #Hostel
        // Route::prefix('hostel')->group(function (){
        //     Route::get('/', [HostelController::class, 'index'])->name('admin.hostel.index');
        //     Route::get('/detail/{hostel}', [HostelController::class, 'show'])->name('admin.hostel.detail');
        //     Route::get('/create', [HostelController::class, 'create'])->name('admin.hostel.create');
        //     Route::post('/create', [HostelController::class, 'store'])->name('admin.hostel.store');
        //     Route::get('/edit/{hostel}', [HostelController::class, 'edit'])->name('admin.hostel.edit');
        //     Route::post('/edit/{hostel}', [HostelController::class, 'update'])->name('admin.hostel.update');
        //     Route::delete('/destroy/{hostel}', [HostelController::class, 'destroy'])->name('admin.hostel.destroy');
        // });

        // #Notification
        // Route::prefix('notification')->group(function (){
        //     Route::get('/', [NotificationController::class, 'index'])->name('admin.notification.index');
        //     Route::get('/detail/{id}', [NotificationController::class, 'show'])->name('admin.notification.detail');
        //     Route::get('/create', [NotificationController::class, 'create'])->name('admin.notification.create');
        //     Route::post('/create', [NotificationController::class, 'store'])->name('admin.notification.store');
        //     Route::get('/edit/{id}', [HostelController::class, 'edit'])->name('admin.notification.edit');
        //     Route::post('/edit/{id}', [HostelController::class, 'update'])->name('admin.notification.update');
        // });

    });
});
