<?php

namespace App\Http\Controllers;

use App\Models\Expense;
use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ExpenseController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
{
    $search = $request->search;
    $status = $request->status;

    $expenses = Expense::where('user_id', Auth::id())
        ->with('category')
        ->when($search, function ($query) use ($search) {
            $query->where('title', 'like', "%{$search}%")
                ->orWhere('description', 'like', "%{$search}%");
        })
        ->when($status, function ($query) use ($status) {
            $query->where('status', $status);
        })
        ->orderBy('date', 'desc')
        ->paginate(10);

    
    $totalAmount = Expense::where('user_id', Auth::id())->sum('amount');
    $paidAmount = Expense::where('user_id', Auth::id())->where('status', 'paid')->sum('amount');
    $unpaidAmount = Expense::where('user_id', Auth::id())->where('status', 'unpaid')->sum('amount');

    return view('expenses.index', compact('expenses', 'search', 'status', 'totalAmount', 'paidAmount', 'unpaidAmount'));
}


    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $categories = Category::orderBy('name')->get();
        return view('expenses.create', compact('categories'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'nullable|string',
            'amount' => 'required|numeric|min:0',
            'category_id' => 'required|exists:categories,id',
            'date' => 'required|date',
            'status' => 'required|in:paid,unpaid',
        ]);

        // Get category name and set both category_id and category (for backward compatibility)
        $category = Category::find($validated['category_id']);
        $validated['category'] = $category->name;
        $validated['user_id'] = Auth::id();

        Expense::create($validated);

        return redirect()->route('expenses.index')
            ->with('success', 'Expense added successfully!');
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Expense $expense)
    {
        $this->authorizeExpense($expense);
        $categories = Category::orderBy('name')->get();
        return view('expenses.edit', compact('expense', 'categories'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Expense $expense)
    {
        $this->authorizeExpense($expense);

        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'nullable|string',
            'amount' => 'required|numeric|min:0',
            'category_id' => 'required|exists:categories,id',
            'date' => 'required|date',
            'status' => 'required|in:paid,unpaid',
        ]);

        // Get category name and set both category_id and category (for backward compatibility)
        $category = Category::find($validated['category_id']);
        $validated['category'] = $category->name;

        $expense->update($validated);

        return redirect()->route('expenses.index')->with('success', 'Expense updated successfully!');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Expense $expense)
    {
        $this->authorizeExpense($expense);
        $expense->delete();

        return redirect()->route('expenses.index')->with('success', 'Expense deleted successfully!');
    }

    /**
     * Toggle expense status between paid and unpaid.
     */
    public function toggleStatus(Expense $expense)
    {
        $this->authorizeExpense($expense);

        $expense->update([
            'status' => $expense->status === 'paid' ? 'unpaid' : 'paid'
        ]);

        return redirect()->route('expenses.index')->with('success', 'Status updated successfully!');
    }

    /**
     * Authorize that the expense belongs to the current user.
     */
    private function authorizeExpense(Expense $expense)
    {
        if ($expense->user_id !== Auth::id()) {
            abort(403, 'Unauthorized action.');
        }
    }
}