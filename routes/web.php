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

// Routes pour la partie administration
Route::middleware(['auth', 'roles:Admin,Lead_Technician,Technician'])->group(function (){
    Route::get('/admin/index', [\App\Http\Controllers\Admin\AdminController::class, 'index'])->name('admin.dashboard');
    Route::get('/admin/panne/create', [PanneController::class, 'index'])->name('create.panne');
    Route::post('/admin/panne/create', [PanneController::class, 'createPanne'])->name('store.panne');
    Route::get('/admin/panne/index', [PanneController::class, 'listview'])->name('list.panne');

    Route::get('admin/user/index', [\App\Http\Controllers\Admin\AdminController::class, 'getAllUsers'])->name('admin.users');
    Route::get('/admin/technician/create', [\App\Http\Controllers\Admin\AdminController::class, 'create'])->name('technician.create');
    Route::post('/admin/technician/store', [\App\Http\Controllers\Admin\AdminController::class, 'store'])->name('technician.store');
    Route::get('/admin/lead-technician/create', [\App\Http\Controllers\Admin\AdminController::class, 'createLeadTech'])->name('lead.technician.create');
    Route::post('/admin/lead-technician/create', [\App\Http\Controllers\Admin\AdminController::class, 'storeLeadTech'])->name('lead.technician.store');
});

//Routes pour la partie employe
Route::middleware(['auth', 'roles:Employee'])->group(function (){
    Route::get('/employee/index', [\App\Http\Controllers\Employee\EmployeeController::class, 'index'])->name('employee.dashboard');
    Route::get('/employee/panne/index', [\App\Http\Controllers\Employee\EmployeeController::class, 'getAllPannes'])->name('panne.index');
    Route::get('/employee/panne/create', [\App\Http\Controllers\Employee\EmployeeController::class, 'create'])->name('panne.create');
    Route::post('/employee/panne/store', [\App\Http\Controllers\Employee\EmployeeController::class, 'store'])->name('panne.store');
    Route::get('/employee/panne/show/{id}', [\App\Http\Controllers\Employee\EmployeeController::class, 'show'])->name('panne.show');
    Route::get('/employee/panne/edit/{id}', [\App\Http\Controllers\Employee\EmployeeController::class, 'edit'])->name('panne.edit');
    Route::patch('/employee/panne/{id}', [\App\Http\Controllers\Employee\EmployeeController::class, 'update'])->name('panne.update');

});


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

});

require __DIR__.'/auth.php';
