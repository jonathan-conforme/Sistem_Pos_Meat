<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PdfController;
use App\Http\Controllers\EmpresaController;
use App\Http\Controllers\FacElectronivaController;
use App\Http\Controllers\CustomerController;
use App\Http\Controllers\CategoriesController;
use App\Http\Controllers\ProductsController;
use App\Http\Controllers\SuppliersController;
use App\Http\Controllers\RoleController;
use App\Http\Controllers\PermissionController;
use App\Http\Controllers\Auth\RegisteredUserController;
use App\Http\Controllers\PosController;
use App\Http\Controllers\SalesController;
use App\Http\Controllers\InvoiceController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\SaleItemsController;
use App\Http\Controllers\CashClosureController;
use App\Http\Controllers\CreditPaymentController;

// ==================== RUTAS PÚBLICAS ====================
Route::get('/', function () {
    return view('welcome');
})->name('welcome');

// Landing pages públicas
Route::prefix('landing')->group(function () {
    Route::get('about', function () {
        return view('landing.about');
    })->name('landing.about');

    Route::get('projects', function () {
        return view('landing.projects');
    })->name('landing.projects');

    Route::get('services', function () {
        return view('landing.services');
    })->name('landing.services');
});

// ==================== RUTAS DE AUTENTICACIÓN ====================
require __DIR__ . '/auth.php';

// ==================== RUTAS PROTEGIDAS (AUTH) ====================
Route::middleware('auth')->group(function () {

    // Dashboard principal
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');
    Route::get('/dashboard/stats', [DashboardController::class, 'getStats'])->name('dashboard.stats');
    Route::get('/dashboard/chart-data', [DashboardController::class, 'getChartData'])->name('dashboard.chart-data');

    // Perfil de usuario
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

    // ==================== RUTAS DE POS Y VENTAS ====================
    Route::prefix('pos')->name('pos.')->group(function () {
        Route::get('/', [SalesController::class, 'index'])->name('index');
        Route::post('/', [SalesController::class, 'store'])->name('store');
        Route::get('/create', [SalesController::class, 'create'])->name('create');
    });

    // Rutas de ventas
    Route::resource('sales', SalesController::class);
    Route::resource('sale-items', SaleItemsController::class);

    // ==================== RUTAS DE CIERRE DE CAJA ====================
    Route::prefix('cash-closures')->name('cash-closures.')->group(function () {
        // Ruta para el resumen (DEBE IR PRIMERO)
        Route::get('/today-summary', [CashClosureController::class, 'getTodaySummary'])->name('get-today-summary');
        
        // Rutas de apertura
        Route::get('/open', [CashClosureController::class, 'open'])->name('open');
        Route::post('/store-open', [CashClosureController::class, 'storeOpen'])->name('store-open');
        
        // Rutas resource (estándar)
        Route::get('/', [CashClosureController::class, 'index'])->name('index');
        Route::get('/create', [CashClosureController::class, 'create'])->name('create');
        Route::post('/', [CashClosureController::class, 'store'])->name('store');
        Route::get('/{cashClosure}', [CashClosureController::class, 'show'])->name('show');
    });

    // ==================== RUTAS DE FACTURACIÓN Y PDF ====================
    Route::prefix('pdf')->name('pdf.')->group(function () {
        Route::get('/ticket/{saleId}', [PdfController::class, 'generarTicket'])->name('ticket');
        Route::get('/descargar/{saleId}', [PdfController::class, 'descargarTicket'])->name('descargar');
    });

    // Facturas
    Route::prefix('invoices')->name('invoices.')->group(function () {
        Route::get('/', [InvoiceController::class, 'index'])->name('index');
        Route::get('/{id}', [InvoiceController::class, 'show'])->name('show');
        Route::get('/{id}/pdf', [InvoiceController::class, 'generatePDF'])->name('pdf');
        Route::get('/{id}/print', [InvoiceController::class, 'print'])->name('print');
    });

    // ==================== RUTAS DE CLIENTES Y PRODUCTOS ====================
    Route::resource('customer', CustomerController::class);
    Route::get('/categories/stats', [CategoriesController::class, 'stats'])->name('categories.stats');
    Route::resource('categories', CategoriesController::class);

    Route::resource('suppliers', SuppliersController::class);
    
    // Búsqueda de clientes
    Route::get('/customer/search', [CustomerController::class, 'search'])->name('customer.search');
    Route::get('/clientes/buscar/{cedula}', [CustomerController::class, 'buscar'])->name('clientes.buscar');
    
    Route::get('factura', function () {
        return view('factura.index');
    })->name('factura.index');

    // ==================== RUTAS DE CRÉDITOS ====================
    Route::prefix('creditos')->name('credit.')->group(function () {
        Route::get('/', [CreditPaymentController::class, 'index'])->name('index');
        Route::get('/{sale}', [CreditPaymentController::class, 'show'])->name('show');
        Route::post('/{sale}/pagar', [CreditPaymentController::class, 'store'])->name('pay');
    });

    // ==================== RUTAS DE ADMINISTRACIÓN ====================
    Route::middleware(['auth', 'role:administrador'])->prefix('admin')->name('admin.')->group(function () {
        // Gestión de usuarios, roles y permisos
        Route::resource('users', RegisteredUserController::class);
        Route::resource('roles', RoleController::class);
        Route::resource('permissions', PermissionController::class);
        Route::get('register', [RegisteredUserController::class, 'create'])->name('register');
        Route::post('register', [RegisteredUserController::class, 'store']);
        Route::resource('products', ProductsController::class);
        Route::resource('customer', CustomerController::class);
        Route::resource('empresa', EmpresaController::class);
    });
});