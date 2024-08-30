<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ShipmentController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\InternationalCompanyController;
use App\Http\Controllers\DomesticCompanyController;
use App\Http\Controllers\SurveyorController;
use App\Http\Controllers\ExportController;
use App\Http\Controllers\ActivityController;
use App\Http\Controllers\RoaController;
use App\Http\Controllers\CoaController;
use App\Http\Controllers\AshanlsController;
use App\Models\Ashanls;

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

// Home route
Route::get('/', function () {
    return view('welcome');
});

// Dashboard routes
Route::get('/dashboards', [DashboardController::class, 'index'])->name('dashboard.index');

// Shipment routes
Route::resource('shipments', ShipmentController::class)->except(['show']);
Route::get('/shipments/create', [ShipmentController::class, 'create'])->name('shipments.create');
Route::get('shipments/{activity}/edit', [ShipmentController::class, 'edit'])->name('shipments.edit');
Route::put('shipments/{activity}', [ShipmentController::class, 'update'])->name('shipments.update');
Route::delete('/shipments/{shipment}', [ShipmentController::class, 'destroy'])->name('shipments.destroy');
Route::get('/get-companies', [ShipmentController::class, 'getCompanies'])->name('shipments.getCompanies');
Route::get('activities/{activity}/shipments/create', [ShipmentController::class, 'create'])->name('shipments.create');
Route::post('activities/{activity}/shipments', [ShipmentController::class, 'store'])->name('shipments.store');


// Domestic Company routes
Route::resource('domestic_companies', DomesticCompanyController::class);
Route::get('/domestic-companies', [DomesticCompanyController::class, 'index'])->name('domestic_companies.index');
Route::get('/domestic-companies/create', [DomesticCompanyController::class, 'create'])->name('domestic_companies.create');
Route::post('/domestic-companies', [DomesticCompanyController::class, 'store'])->name('domestic_companies.store');
Route::get('/domestic-companies/{id}', [DomesticCompanyController::class, 'show'])->name('domestic_companies.show');

// International Company routes
Route::resource('international_companies', InternationalCompanyController::class);
Route::get('/international-companies', [InternationalCompanyController::class, 'index'])->name('international_companies.index');
Route::get('/international-companies/create', [InternationalCompanyController::class, 'create'])->name('international_companies.create');
Route::post('/international-companies', [InternationalCompanyController::class, 'store'])->name('international_companies.store');
Route::get('/international-companies/{id}', [InternationalCompanyController::class, 'show'])->name('international_companies.show');


// Route surveyor\
Route::resource('surveyors', SurveyorController::class);
Route::get('/surveyors', [SurveyorController::class, 'index'])->name('surveyors.index');
Route::get('/surveyors/create', [SurveyorController::class, 'create'])->name('surveyors.create');
Route::post('/surveyors', [SurveyorController::class, 'store'])->name('surveyors.store');

// Export routes
Route::get('/index', [ExportController::class, 'index'])->name('index');
Route::get('/export', [ExportController::class, 'export'])->name('export');
Route::get('/export/{id}', [ExportController::class, 'export'])->name('export');

// Activity routes
Route::resource('activities', ActivityController::class);
// web.php
Route::delete('/activities/{id}', [ActivityController::class, 'destroy'])->name('activities.destroy');
Route::get('activities/{id}', [ActivityController::class, 'show'])->name('activities.show');

// Menampilkan form untuk membuat ROA baru terkait dengan activity tertentu
Route::get('activities/{activity}/roas/create', [RoaController::class, 'create'])->name('roa.create');

// Menyimpan ROA baru yang terkait dengan activity tertentu
Route::post('activities/{activity}/roas', [RoaController::class, 'store'])->name('roa.store');


Route::resource('coas', CoaController::class);
Route::get('activities/{activity}/coas/create', [CoaController::class, 'create'])->name('coas.create');
Route::post('activities/{activity}/coas', [CoaController::class, 'store'])->name('coas.store');

Route::resource('ashanls', AshanlsController::class);
Route::get('activities/{activity}/ashanls/create', [AshanlsController::class, 'create'])->name('ashanls.create');
Route::post('activities/{activity}/ashanls', [AshanlsController::class, 'store'])->name('ashanls.store');
