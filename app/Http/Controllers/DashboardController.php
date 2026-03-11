<?php

namespace App\Http\Controllers;

use App\Models\Expense;
use Illuminate\Support\Facades\Auth;
use Carbon\Carbon;

class DashboardController extends Controller
{
    public function index()
    {
        $userId = Auth::id();

        $totalExpenses = Expense::where('user_id', $userId)->sum('amount');
        $paidExpenses = Expense::where('user_id', $userId)->where('status', 'paid')->sum('amount');
        $unpaidExpenses = Expense::where('user_id', $userId)->where('status', 'unpaid')->sum('amount');

        $recentExpenses = Expense::where('user_id', $userId)
            ->orderBy('date', 'desc')
            ->take(5)
            ->get();

        // Monthly expenses for chart (last 6 months)
        $monthlyExpenses = Expense::where('user_id', $userId)
            ->where('date', '>=', Carbon::now()->subMonths(6))
            ->selectRaw('MONTH(date) as month, SUM(amount) as total')
            ->groupBy('month')
            ->orderBy('month')
            ->get();

        $months = [];
        $amounts = [];
        
        for ($i = 5; $i >= 0; $i--) {
            $month = Carbon::now()->subMonths($i);
            $months[] = $month->format('F');
            $monthNum = $month->month;
            $monthData = $monthlyExpenses->firstWhere('month', $monthNum);
            $amounts[] = $monthData ? $monthData->total : 0;
        }

        return view('dashboard', compact(
            'totalExpenses',
            'paidExpenses',
            'unpaidExpenses',
            'recentExpenses',
            'months',
            'amounts'
        ));
    }
}
