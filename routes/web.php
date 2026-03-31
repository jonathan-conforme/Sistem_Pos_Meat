<?php

use App\Http\Controllers\Auth\RegisteredUserController;
use App\Http\Controllers\CashClosureController;
use App\Http\Controllers\CategoriesController;
use App\Http\Controllers\CreditPaymentController;
use App\Http\Controllers\CustomerController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\EmpresaController;
use App\Http\Controllers\Finanzas\CuentaController;
use App\Http\Controllers\Finanzas\ExpenseController;
use App\Http\Controllers\Finanzas\IngresoController;
use App\Http\Controllers\Finanzas\MovimientoController;
use App\Http\Controllers\InvoiceController;
use App\Http\Controllers\PdfController;
use App\Http\Controllers\PermissionController;
use App\Http\Controllers\ProductsController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\RoleController;
use App\Http\Controllers\SaleItemsController;
use App\Http\Controllers\SalesController;
use App\Http\Controllers\SuppliersController;
use App\Http\Controllers\PurchasesController;
use App\Http\Controllers\UnitController;
use App\Http\Controllers\InventoryController;
use App\Http\Controllers\InventoryMovementsController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Finanzas\ResumenController;


// ==================== RUTAS PÚBLICAS ====================
Route::get('/', function () {
    return redirect()->route('login');
});
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
require __DIR__.'/auth.php';

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
        // apertura de caja
        Route::get('/open', [CashClosureController::class, 'open'])->name('open');
        Route::post('/store-open', [CashClosureController::class, 'storeOpen'])->name('store-open');

        // CRUD
        Route::get('/', [CashClosureController::class, 'index'])->name('index');
        Route::get('/create', [CashClosureController::class, 'create'])->name('create');
        Route::post('/', [CashClosureController::class, 'store'])->name('store');
        Route::get('/{cashClosure}', [CashClosureController::class, 'show'])->name('show');
    });
    
    Route::post(
        'cash-closures/{cashClosure}/register-financial',
        [CashClosureController::class, 'registerFinancial']
    )->name('cash-closures.register-financial');

    // ==================== RUTAS DE FACTURACIÓN Y PDF ====================
    Route::prefix('pdf')->name('pdf.')->group(function () {
        Route::get('/ticket/{saleId}', [PdfController::class, 'generarTicket'])->name('ticket');
        Route::get('/descargar/{saleId}', [PdfController::class, 'descargarTicket'])->name('descargar');
    });
    Route::get('/credito/factura/{saleId}', [PdfController::class, 'generarFacturaCredito'])->name('pdf.credito.factura');

    // Facturas
  Route::prefix('invoices')->name('invoices.')->group(function () {

    Route::get('/', [InvoiceController::class, 'index'])->name('index');

    Route::get('/{invoice}', [InvoiceController::class, 'show'])->name('show');

    Route::get('/{invoice}/pdf', [InvoiceController::class, 'pdf'])->name('pdf');

    Route::get('/{invoice}/print', [InvoiceController::class, 'print'])->name('print');

    Route::get('/{invoice}/whatsapp', [InvoiceController::class, 'sendWhatsAppPDF'])
        ->name('whatsapp');

});


    // ==================== RUTAS DE CLIENTES Y PRODUCTOS ====================
    Route::resource('customer', CustomerController::class);
    Route::get('/categories/stats', [CategoriesController::class, 'stats'])->name('categories.stats');
    Route::get('/categories/create', [CategoriesController::class, 'create'])->name('categories.create');

    Route::resource('categories', CategoriesController::class)->except(['create']);
    Route::post('categories/{category}/toggle', [CategoriesController::class, 'toggle'])->name('categories.toggle');
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
        Route::patch('products/{product}/toggle', [ProductsController::class, 'toggle'])
            ->name('products.toggle');
        Route::resource('customer', CustomerController::class);
        Route::resource('empresa', EmpresaController::class);
        Route::resource('income', IngresoController::class);
        Route::resource('expenses', ExpenseController::class);
        Route::resource('resumen', ResumenController::class);
        Route::resource('movimientos', MovimientoController::class);
        Route::resource('cuentas', CuentaController::class);
        Route::resource('purchases', PurchasesController::class);
        Route::resource('units', UnitController::class);
        Route::resource('inventory', InventoryController::class);
        Route::resource('inventory-movements', InventoryMovementsController::class);
        Route::patch('units/{unit}/toggle', [UnitController::class, 'toggle'])
    ->name('units.toggle');
    });
});
