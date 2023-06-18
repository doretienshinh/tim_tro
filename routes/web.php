<?php

use Illuminate\Support\Facades\Route;

use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\HostelController;
use App\Http\Controllers\NotificationController;
use App\Http\Controllers\WardController;
use App\Http\Controllers\DistrictController;
use App\Http\Controllers\CityController;


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
            Route::get('/detail/{id}', [HostelController::class, 'show'])->name('admin.hostel.detail');
            Route::get('/create', [HostelController::class, 'create'])->name('admin.hostel.create');
            Route::post('/create', [HostelController::class, 'store'])->name('admin.hostel.store');
            Route::get('/edit/{id}', [HostelController::class, 'edit'])->name('admin.hostel.edit');
            Route::post('/edit/{id}', [HostelController::class, 'update'])->name('admin.hostel.update');
        });

        #Notification
        Route::prefix('notification')->group(function (){
            Route::get('/', [NotificationController::class, 'index'])->name('admin.notification.index');
            Route::get('/detail/{id}', [NotificationController::class, 'show'])->name('admin.notification.detail');
            Route::get('/create', [NotificationController::class, 'create'])->name('admin.notification.create');
            Route::post('/create', [NotificationController::class, 'store'])->name('admin.notification.store');
            // Route::get('/edit/{id}', [HostelController::class, 'edit'])->name('admin.notification.edit');
            // Route::post('/edit/{id}', [HostelController::class, 'update'])->name('admin.notification.update');
        });

        #Ward
        Route::prefix('ward')->group(function (){
            Route::get('/', [WardController::class, 'index'])->name('admin.ward.index');
            Route::get('/detail/{id}', [WardController::class, 'show'])->name('admin.ward.detail');
            Route::get('/create', [WardController::class, 'create'])->name('admin.ward.create');
            Route::post('/create', [WardController::class, 'store'])->name('admin.ward.store');
            // Route::get('/edit/{id}', [WardController::class, 'edit'])->name('admin.ward.edit');
            // Route::post('/edit/{id}', [WardController::class, 'update'])->name('admin.ward.update');
            Route::get('/findWardByDistrict/{id}', [WardController::class, 'findWardByDistrict'])->name('admin.district.findWardByDistrict');
        });

        #District
        Route::prefix('district')->group(function (){
            Route::get('/', [DistrictController::class, 'index'])->name('admin.district.index');
            Route::get('/detail/{id}', [DistrictController::class, 'show'])->name('admin.district.detail');
            Route::get('/create', [DistrictController::class, 'create'])->name('admin.district.create');
            Route::post('/create', [DistrictController::class, 'store'])->name('admin.district.store');
            Route::get('/edit/{id}', [DistrictController::class, 'edit'])->name('admin.district.edit');
            Route::post('/edit/{id}', [DistrictController::class, 'update'])->name('admin.district.update');
            Route::get('/findDistrictByCity/{id}', [DistrictController::class, 'findDistrictByCity'])->name('admin.district.findDistrictByCity');
        });

        #City
        Route::prefix('city')->group(function (){
            Route::get('/', [CityController::class, 'index'])->name('admin.city.index');
            Route::get('/detail/{id}', [CityController::class, 'show'])->name('admin.city.detail');
            Route::get('/create', [CityController::class, 'create'])->name('admin.city.create');
            Route::post('/create', [CityController::class, 'store'])->name('admin.city.store');
            Route::get('/edit/{id}', [CityController::class, 'edit'])->name('admin.city.edit');
            Route::post('/edit/{id}', [CityController::class, 'update'])->name('admin.city.update');
        });
    });

});
