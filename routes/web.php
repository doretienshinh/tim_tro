<?php

use Illuminate\Support\Facades\Route;

use App\Http\Controllers\UserController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\HostelController;
use App\Http\Controllers\TimeController;
use App\Http\Controllers\TagController;
use App\Http\Controllers\SearchController;
use App\Http\Controllers\NotificationController;
use App\Http\Controllers\FavoriteController;

use App\Http\Controllers\Host\HostHostelController;
use App\Http\Controllers\Host\HostHostelUserController;
use App\Http\Controllers\Host\HostTimeController;
use App\Http\Controllers\Host\HostUserController;
use App\Http\Controllers\Host\HostBookingController;

use App\Http\Controllers\User\UserHostelController;
use App\Http\Controllers\User\UserUserController;
use App\Http\Controllers\User\UserBookingController;
use App\Http\Controllers\User\UserChatController;
use App\Http\Controllers\User\UserFavoriteController;
use App\Http\Controllers\User\UserFeedbackController;


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

// Route::get('/', [App\Http\Controllers\HomeController::class, 'index'])->middleware('verified');


Auth::routes(['verify' => true]);

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->middleware('verified')->name('home');
Route::get('/', [HomeController::class,'index']);
Route::get('/search', [SearchController::class,'index'])->name('search.index');
Route::get('/filter_template', [SearchController::class,'filter_template'])->name('filter_template.index');
Route::post('/filter', [SearchController::class,'filter'])->name('filter.index');

//admin
Route::middleware(['auth'])->group(function(){
    Route::get('/push-notificaiton', [NotificationController::class, 'index'])->name('push-notificaiton');
    Route::post('/store-token', [NotificationController::class, 'storeToken'])->name('store.token');
    Route::post('/auto-store-token', [NotificationController::class, 'autoStoreToken'])->name('auto.store.token');
    Route::post('/send-web-notification', [NotificationController::class, 'sendNotification'])->name('send.web-notification');
    Route::put('notification/read/{id}', [NotificationController::class, 'read'])->name('notification.read');

    Route::prefix('admin')->group(function (){
        Route::get('/', [HomeController::class,'index'])->name('admin.home');
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
            Route::get('/create', [NotificationController::class, 'create'])->name('admin.notification.create');
            Route::post('/create', [NotificationController::class, 'store'])->name('admin.notification.store');
            Route::get('/detail/{notification}', [NotificationController::class, 'show'])->name('admin.notification.detail');

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
    Route::prefix('user')->group(function (){
        Route::get('/', [HomeController::class,'user_index'])->name('user.home');

        #User
        Route::prefix('user')->group(function (){
            Route::get('/detail', [UserUserController::class, 'show'])->name('user.user.detail');
            Route::get('/edit', [UserUserController::class, 'edit'])->name('user.user.edit');
            Route::post('/edit', [UserUserController::class, 'update'])->name('user.user.update');
            Route::get('/find/{id}', [UserUserController::class, 'find'])->name('user.user.find');
        });

        #Hostel
        Route::prefix('hostel')->group(function (){
            Route::get('/detail/{hostel}', [UserHostelController::class, 'show'])->name('user.hostel.detail');
        });

        #Booking
        Route::prefix('booking')->group(function (){
            Route::post('/store/{time_id}/{hostel_id}', [UserBookingController::class, 'booking'])->name('user.booking.store');
            Route::get('/', [UserBookingController::class, 'index'])->name('user.booking.index');
            Route::get('/delete/{booking}', [UserBookingController::class, 'destroy'])->name('user.booking.destroy');
        });

        #Chat
        Route::prefix('chat')->group(function (){
            Route::get('/', [UserChatController::class, 'index'])->name('user.chat.index');
        });

        #Favorite
        Route::prefix('favorite')->group(function (){
            Route::get('/', [UserFavoriteController::class, 'index'])->name('user.favorite.index');
            Route::get('/create/{hostel}', [UserFavoriteController::class, 'store'])->name('user.favorite.store');
            Route::get('/delete/{hostel}', [UserFavoriteController::class, 'destroy'])->name('user.favorite.destroy');
        });

        #Register_hostel
        Route::prefix('register-hostel')->group(function (){
            // Route::get('/', [UserHostelController::class, 'index'])->name('user.register-hostel.index');
            Route::get('/register/{hostel}', [UserHostelController::class, 'register'])->name('user.register-hostel.store');
            Route::get('/register-detail', [UserHostelController::class, 'registerDetail'])->name('user.register-hostel.detail');
        });

        #Leave_hostel
        Route::prefix('register-hostel')->group(function (){
            Route::get('/Leave_hostel', [UserHostelController::class, 'leave'])->name('user.register-hostel');
        });

        #Feedback
        Route::prefix('feedback')->group(function (){
            Route::post('/feedback/{id}', [UserFeedbackController::class, 'feedback'])->name('user.feedback.store');
        });
    });
    //route for host
    Route::prefix('host')->group(function (){
        Route::get('/', [HomeController::class,'host_index'])->name('host.home');

        #User
        Route::prefix('user')->group(function (){
            Route::get('/detail', [HostUserController::class, 'show'])->name('host.user.detail');
            Route::get('/edit', [HostUserController::class, 'edit'])->name('host.user.edit');
            Route::post('/edit', [HostUserController::class, 'update'])->name('host.user.update');
        });

        #Hostel
        Route::prefix('hostel')->group(function (){
            Route::get('/', [HostHostelController::class, 'index'])->name('host.hostel.index');
            Route::get('/leased', [HostHostelController::class, 'leased'])->name('host.hostel.leased');
            Route::get('/detail/{hostel}', [HostHostelController::class, 'show'])->name('host.hostel.detail');
            Route::get('/create', [HostHostelController::class, 'create'])->name('host.hostel.create');
            Route::post('/create', [HostHostelController::class, 'store'])->name('host.hostel.store');
            Route::get('/edit/{hostel}', [HostHostelController::class, 'edit'])->name('host.hostel.edit');
            Route::post('/edit/{hostel}', [HostHostelController::class, 'update'])->name('host.hostel.update');
            Route::delete('/destroy/{hostel}', [HostHostelController::class, 'destroy'])->name('host.hostel.destroy');
        });

        #Time
        Route::prefix('time')->group(function (){
            Route::get('/', [HostTimeController::class, 'index'])->name('host.time.index');
            Route::get('/create', [HostTimeController::class, 'create'])->name('host.time.create');
            Route::post('/create', [HostTimeController::class, 'store'])->name('host.time.store');
            Route::get('/edit/{time}', [HostTimeController::class, 'edit'])->name('host.time.edit');
            Route::post('/edit/{time}', [HostTimeController::class, 'update'])->name('host.time.update');
            Route::get('/delete/{time}', [HostTimeController::class, 'destroy'])->name('host.time.delete');
        });

        #Booking
        Route::prefix('booking')->group(function (){
            Route::get('/', [HostBookingController::class, 'index'])->name('host.booking.index');
            Route::get('/edit/{booking}', [HostBookingController::class, 'edit'])->name('host.booking.edit');
            Route::post('/edit/{booking}', [HostBookingController::class, 'update'])->name('host.booking.update');
            // Route::get('/delete/{time}', [HostTimeController::class, 'destroy'])->name('host.time.delete');
        });

        #Request 
        Route::prefix('request')->group(function (){
            Route::get('/', [HostHostelUserController::class, 'index'])->name('host.request.index');
            Route::get('/edit/{id}', [HostHostelUserController::class, 'edit'])->name('host.request.edit');
            Route::post('/edit/{Hostel_user}', [HostHostelUserController::class, 'update'])->name('host.request.update');
            // Route::get('/delete/{time}', [HostTimeController::class, 'destroy'])->name('host.time.delete');

            #Request_leave
            Route::get('/leave', [HostHostelUserController::class, 'index_leave'])->name('host.request.index_leave');
            Route::get('/edit_leave/{id}', [HostHostelUserController::class, 'edit_leave'])->name('host.request.edit_leave');
            Route::post('/edit_leave/{Hostel_user}', [HostHostelUserController::class, 'update_leave'])->name('host.request.update_leave');
        });
    });
});
