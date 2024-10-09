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
    Route::get('/admin/panne/show/{id}', [PanneController::class, 'show'])->name('show.panne');
    Route::get('/admin/panne/edit/{id}', [PanneController::class, 'edit'])->name('edit.panne');
    Route::put('/admin/panne/update/{id}', [PanneController::class, 'update'])->name('update.panne');
    Route::delete('/admin/panne/delete/{id}', [PanneController::class, 'destroy'])->name('delete.panne');


    Route::get('admin/user/index', [\App\Http\Controllers\Admin\AdminController::class, 'getAllUsers'])->name('admin.users');
    Route::get('/admin/technician/create', [\App\Http\Controllers\Admin\AdminController::class, 'create'])->name('technician.create');
    Route::post('/admin/technician/store', [\App\Http\Controllers\Admin\AdminController::class, 'store'])->name('technician.store');
    Route::get('/admin/lead-technician/create', [\App\Http\Controllers\Admin\AdminController::class, 'createLeadTech'])->name('lead.technician.create');
    Route::post('/admin/lead-technician/store', [\App\Http\Controllers\Admin\AdminController::class, 'storeLeadTechnician'])->name('lead.technician.store');

    Route::get('/admin/notifs', [\App\Http\Controllers\Admin\AdminController::class, 'indexNotifications'])->name('notif.index');
    Route::get('/admin/notifs/show/{id}', [\App\Http\Controllers\Admin\AdminController::class, 'showNotification'])->name('notif.show');
    Route::post('/panne/{panne}/assign', [PanneController::class, 'assignTechnician'])->name('panne.assignTechnician');

    Route::get('/stock/index', [\App\Http\Controllers\Stock\StockController::class, 'index'])->name('stock.index');
    Route::get('/stock/create', [\App\Http\Controllers\Stock\StockController::class, 'create'])->name('stock.create');
    Route::get('/stock/edit/{id}', [\App\Http\Controllers\Stock\StockController::class, 'edit'])->name('stock.edit');
    Route::put('/stock/update/{id}', [\App\Http\Controllers\Stock\StockController::class, 'update'])->name('stock.update');
    Route::post('/stock/store', [\App\Http\Controllers\Stock\StockController::class, 'store'])->name('stock.store');
    Route::get('/stock/show/{id}', [\App\Http\Controllers\Stock\StockController::class, 'index'])->name('stock.show');
    Route::delete('/stock/delete/{id}', [\App\Http\Controllers\Stock\StockController::class, 'destroy'])->name('stock.delete');

    // Route pour l'export PDF des stocks
    Route::get('stocks/export/pdf', [\App\Http\Controllers\Stock\StockController::class, 'exportPdf'])->name('stock.export.pdf');
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
