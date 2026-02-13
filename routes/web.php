<?php

use App\Http\Controllers\AdminController;
use App\Http\Controllers\ConnectionController;
use App\Http\Controllers\HouseController;
use App\Http\Controllers\MessageController;
use App\Http\Controllers\PersonnelController;
use App\Http\Controllers\ProfileController;
use App\Models\User;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
})->name('home');

Route::get('/dashboard', function () {
    $user = request()->user();

    if (! $user) {
        return redirect()->route('login');
    }

    return match ($user->role) {
        User::ROLE_ADMIN => redirect()->route('admin.dashboard'),
        User::ROLE_PERSONNEL => redirect()->route('personnel.dashboard'),
        User::ROLE_HOUSE => redirect()->route('house.dashboard'),
        default => abort(403),
    };
})->middleware(['auth'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

    Route::middleware('role:admin')->prefix('admin')->name('admin.')->group(function () {
        Route::get('/dashboard', [AdminController::class, 'dashboard'])->name('dashboard');
        Route::get('/personnels', [AdminController::class, 'personnels'])->name('personnels');
        Route::put('/personnels/{personnel}/approve', [AdminController::class, 'approvePersonnel'])->name('personnels.approve');
        Route::put('/personnels/{personnel}/reject', [AdminController::class, 'rejectPersonnel'])->name('personnels.reject');

        Route::get('/connections', [AdminController::class, 'connections'])->name('connections');
        Route::put('/connections/{connection}/approve', [AdminController::class, 'approveConnection'])->name('connections.approve');
        Route::put('/connections/{connection}/reject', [AdminController::class, 'rejectConnection'])->name('connections.reject');
    });

    Route::middleware('role:personnel')->prefix('personnel')->name('personnel.')->group(function () {
        Route::get('/dashboard', [PersonnelController::class, 'dashboard'])->name('dashboard');
        Route::get('/profile', [PersonnelController::class, 'editProfile'])->name('profile.edit');
        Route::put('/profile', [PersonnelController::class, 'updateProfile'])->name('profile.update');
    });

    Route::middleware('role:house')->prefix('house')->name('house.')->group(function () {
        Route::get('/dashboard', [HouseController::class, 'dashboard'])->name('dashboard');
        Route::get('/profiles', [HouseController::class, 'profiles'])->name('profiles');
        Route::get('/profiles/{personnel}', [HouseController::class, 'showProfile'])->name('profiles.show');
        Route::post('/profiles/{personnel}/connect', [ConnectionController::class, 'request'])->name('profiles.connect');
        Route::get('/connections', [ConnectionController::class, 'indexHouse'])->name('connections');
    });

    Route::get('/chat', [MessageController::class, 'index'])->name('chat.index');
    Route::get('/chat/{connection}', [MessageController::class, 'show'])->name('chat.show');
    Route::post('/chat/{connection}/messages', [MessageController::class, 'store'])->name('chat.messages.store');
});

require __DIR__.'/auth.php';
