<?php

namespace App\Http\Controllers;

use App\Models\Sale;
use App\Models\sale_items;
use App\Models\Customer;
use App\Models\Empresa;
use App\Models\categories;
use App\Models\Product;
use App\Models\Suppliers;
use App\Models\User;
use App\Models\CashClosure; // 👈 Asegúrate de importar este modelo
use Illuminate\Http\Request;
use Illuminate\View\View;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;

class DashboardController extends Controller
{
    public function index(): View
    {
        $userId = Auth::id();

        // ==================== ESTADÍSTICAS DE VENTAS ====================
        $salesToday = Sale::whereDate('created_at', today())->count();
        $salesTodayAmount = Sale::whereDate('created_at', today())->sum('total');

        $salesThisWeek = Sale::whereBetween('created_at', [
            now()->startOfWeek(), 
            now()->endOfWeek()
        ])->count();
        $salesThisWeekAmount = Sale::whereBetween('created_at', [
            now()->startOfWeek(), 
            now()->endOfWeek()
        ])->sum('total');

        $salesThisMonth = Sale::whereMonth('created_at', now()->month)
                              ->whereYear('created_at', now()->year)
                              ->count();
        $salesThisMonthAmount = Sale::whereMonth('created_at', now()->month)
                                    ->whereYear('created_at', now()->year)
                                    ->sum('total');

        $totalSales = Sale::count();
        $totalSalesAmount = Sale::sum('total');

        $lastMonthSales = Sale::whereMonth('created_at', now()->subMonth()->month)
                             ->whereYear('created_at', now()->subMonth()->year)
                             ->count();

        $salesGrowth = $lastMonthSales > 0 
            ? (($salesThisMonth - $lastMonthSales) / $lastMonthSales) * 100 
            : ($salesThisMonth > 0 ? 100 : 0);

        $topProducts = sale_items::select('product_id', DB::raw('SUM(quantity) as total_sold'))
            ->with('product')
            ->groupBy('product_id')
            ->orderByDesc('total_sold')
            ->take(5)
            ->get();

        $paymentMethods = Sale::select('payment_type', DB::raw('COUNT(*) as count'), DB::raw('SUM(total) as amount'))
            ->groupBy('payment_type')
            ->get();

        $totalInvoices = Sale::count();
        $invoicesThisMonth = $salesThisMonth;
        $totalCustomers = Customer::count();
        $totalCompanies = Empresa::count();
        $totalCategories = categories::count();
        $totalProducts = Product::count();
        $totalSuppliers = Suppliers::count();
        $totalUsers = User::count();

        $recentSales = Sale::with(['customer', 'items.product'])
            ->latest()
            ->take(5)
            ->get();

        // ==================== ESTADÍSTICAS DE CIERRE DE CAJA MULTI-USUARIO ====================

        $myTodaySales = Sale::with('items')
            ->whereDate('created_at', today())
            ->where('created_by', $userId)
            ->where('status', 'completed')
            ->get();
            
        $myTodayProfit = $myTodaySales->sum(function($sale) {
            return $sale->items->sum('profit');
        });

        $myTodayClosure = CashClosure::today()->user($userId)->first();

        $todayClosures = CashClosure::today()->with('user')->get();
        $activeUsers = User::count(); // contamos todos los usuarios

        
        $totalSalesToday = Sale::whereDate('created_at', today())
            ->where('status', 'completed')
            ->sum('total');
            
        $totalProfitToday = Sale::with('items')
            ->whereDate('created_at', today())
            ->where('status', 'completed')
            ->get()
            ->sum(function($sale) {
                return $sale->items->sum('profit');
            });

        $cashClosureStats = [
            'has_today_closure' => $myTodayClosure !== null,
            'my_today_closure' => $myTodayClosure,
            'my_cash_sales' => $myTodaySales->where('payment_type', 'cash')->sum('total'),
            'my_card_sales' => $myTodaySales->where('payment_type', 'card')->sum('total'),
            'my_transfer_sales' => $myTodaySales->where('payment_type', 'transfer')->sum('total'),
            'my_credit_sales' => $myTodaySales->where('payment_type', 'credit')->sum('total'),
            'my_total_sales' => $myTodaySales->sum('total'),
            'my_profit' => $myTodayProfit,
            'my_sales_count' => $myTodaySales->count(),

            'today_closures_count' => $todayClosures->count(),
            'active_users_count' => $activeUsers,
            'total_sales_today' => $totalSalesToday,
            'total_profit_today' => $totalProfitToday,
            'pending_closures_count' => $todayClosures->where('status', 'completed')->count(),
        ];

        // ==================== RENDERIZAR VISTA ====================
        return view('dashboard', compact(
            'salesToday',
            'salesTodayAmount',
            'salesThisWeek',
            'salesThisWeekAmount',
            'salesThisMonth',
            'salesThisMonthAmount',
            'totalSales',
            'totalSalesAmount',
            'salesGrowth',
            'topProducts',
            'paymentMethods',
            'totalInvoices',
            'invoicesThisMonth',
            'totalCustomers',
            'totalCompanies',
            'totalCategories',
            'totalProducts',
            'totalSuppliers',
            'totalUsers',
            'recentSales',
            'cashClosureStats' // 👈 agregado sin romper el resto
        ));
    }

    // Métodos AJAX (sin cambios)
    public function getStats(): \Illuminate\Http\JsonResponse { /* ... */ }
    public function getChartData(): \Illuminate\Http\JsonResponse { /* ... */ }
}
