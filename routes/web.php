<?php

use App\Http\Controllers\Auth\AuthenticatedSessionController;
use App\Http\Controllers\PanneController;
use App\Http\Controllers\ProfileController;
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

// Route pour la partie administration
Route::get('/admin', [\App\Http\Controllers\Admin\AdminController::class, 'index']);
Route::get('/admin/create', [\App\Http\Controllers\Admin\AdminController::class, 'create']);


Route::get('/', [AuthenticatedSessionController::class, 'create'])
    ->name('login');

Route::get('/dashboard', function () {
    return view('admin.dashboard.admin');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

//route for manage pannes
Route::prefix('panne')->group(function () {
    //create test user
    // Route::post('/user', [PanneController::class, 'createUser'])->name('panne.user');
    Route::get('/create', [PanneController::class, 'index'])->name('panne.create');
    Route::post('/create', [PanneController::class, 'createPanne'])->name('panne.store');
    Route::get('/list', [PanneController::class, 'listview'])->name('panne.list');
});

require __DIR__.'/auth.php';
