<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\HotelController;
use App\Http\Controllers\AccommodationController;
use App\Http\Controllers\RoomTypeController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Aquí puedes registrar rutas web para tu aplicación.
| Estas rutas son cargadas por el RouteServiceProvider dentro del grupo
| que contiene el middleware "web". ¡Ahora crea algo increíble!
|
*/

// Ruta de inicio (Página principal)
Route::get('/', [HomeController::class, 'index'])->name('home');

// Rutas protegidas para usuarios autenticados
Route::middleware(['auth'])->group(function () {
    // Dashboard para usuarios autenticados
    Route::get('/dashboard', [HomeController::class, 'dashboard'])->name('dashboard');

    // Gestión de hoteles
    Route::resource('hotels', HotelController::class);

    // Gestión de acomodaciones
    Route::resource('accommodations', AccommodationController::class);

    // Gestión de tipos de habitación para un hotel
    Route::prefix('hotels/{hotel}')->group(function () {
        Route::get('room-types', [RoomTypeController::class, 'index'])->name('room-types.index');
        Route::get('room-types/create', [RoomTypeController::class, 'create'])->name('room-types.create');
        Route::post('room-types', [RoomTypeController::class, 'store'])->name('room-types.store');
        Route::delete('room-types/{roomType}', [RoomTypeController::class, 'destroy'])->name('room-types.destroy');
    });
});

// Rutas de autenticación (Laravel Breeze)
require __DIR__.'/auth.php';
