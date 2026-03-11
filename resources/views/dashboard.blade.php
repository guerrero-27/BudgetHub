@extends('layouts.app')

@section('content')
<div class="space-y-6">

    <!-- Stats Cards -->
    <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-6">

        <!-- Total Expenses -->
        <div class="bg-white rounded-xl shadow-sm border border-gray-100 p-6 hover:shadow-md transition-shadow">
            <div class="flex items-center justify-between">
                <div>
                    <p class="text-sm text-gray-500 mb-1">Total Expenses</p>
                    <p class="text-3xl font-bold text-gray-800"><i class="fa-solid fa-peso-sign text-3xl"></i> {{ number_format($totalExpenses, 2) }}</p>
                </div>

                <div class="w-12 h-12 bg-blue-100 rounded-full flex items-center justify-center">
                    <i class="fa-solid fa-peso-sign text-indigo-500"></i>
                </div>
            </div>
        </div>

        <!-- Paid Expenses -->
        <div class="bg-white rounded-xl shadow-sm border border-gray-100 p-6 hover:shadow-md transition-shadow">
            <div class="flex items-center justify-between">
                <div>
                    <p class="text-sm text-gray-500 mb-1">Total Paid</p>
                    <p class="text-3xl font-bold text-green-600"><i class="fa-solid fa-peso-sign text-3xl"></i> {{ number_format($paidExpenses, 2) }}</p>
                </div>

                <div class="w-12 h-12 bg-green-100 rounded-full flex items-center justify-center">
                    <svg class="w-6 h-6 text-green-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                        d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"/>
                    </svg>
                </div>
            </div>
        </div>

        <!-- Unpaid Expenses -->
        <div class="bg-white rounded-xl shadow-sm border border-gray-100 p-6 hover:shadow-md transition-shadow">
            <div class="flex items-center justify-between">
                <div>
                    <p class="text-sm text-gray-500 mb-1">Total Unpaid</p>
                    <p class="text-3xl font-bold text-red-600"><i class="fa-solid fa-peso-sign text-3xl"></i> {{ number_format($unpaidExpenses, 2) }}</p>
                </div>

                <div class="w-12 h-12 bg-red-100 rounded-full flex items-center justify-center">
                    <svg class="w-6 h-6 text-red-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                        d="M12 8v4m0 4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/>
                    </svg>
                </div>
            </div>
        </div>

    </div>

    <!-- Chart + Recent -->
    <div class="grid grid-cols-1 lg:grid-cols-2 gap-6">

        <!-- Monthly Chart -->
        <div class="bg-white rounded-xl shadow-sm p-6 border border-gray-100">
            <h3 class="text-lg font-semibold text-gray-800 mb-4">Monthly Expenses</h3>
            <div class="h-64">
                <canvas id="expensesChart"></canvas>
            </div>
        </div>

        <!-- Monthly Chart -->
        <div class="bg-white rounded-xl shadow-sm p-6 border border-gray-100">
            <h3 class="text-lg font-semibold text-gray-800 mb-4">Monthly Expenses</h3>
            <div class="h-64">
                <canvas id="expensesChart"></canvas>
            </div>
        </div>

        

    </div>

    <!-- Recent Expenses -->
        <div class="bg-white rounded-xl shadow-sm p-6 border border-gray-100">

    <h3 class="text-lg font-semibold text-gray-800 mb-4">
        Recent Expenses
    </h3>

    <!-- HEADER -->
    <div class="grid grid-cols-5 text-xs font-semibold text-gray-500 uppercase border-b pb-2 mb-2">
        <span>Title</span>
        <span>Category</span>
        <span>Date</span>
        <span>Amount</span>
        <span>Status</span>
    </div>

    <div class="space-y-2">

        @forelse($recentExpenses as $expense)

        <div class="grid grid-cols-5 items-center py-3 border-b border-gray-100">

            <!-- Title -->
            <div>
                <p class="font-medium text-gray-800">
                    {{ $expense->title }}
                </p>
                {{-- <p class="text-xs text-gray-400">
                    {{ $expense->date->format('M d, Y') }}
                </p> --}}
            </div>

            <!-- Category -->
            <div>
                @if($expense->category_id)
                @php 
                $cat = \App\Models\Category::find($expense->category_id);
                @endphp
                @if($cat)
                <span class="px-2 py-1 text-xs rounded-full 
                    bg-{{ $cat->color }}-100 
                    text-{{ $cat->color }}-800">
                    {{ $cat->name }}
                </span>
                @else
                <span class="px-2 py-1 text-xs rounded-full bg-gray-100 text-gray-700">
                    {{ $expense->category }}
                </span>
                @endif
                @else
                <span class="px-2 py-1 text-xs rounded-full bg-gray-100 text-gray-700">
                    {{ $expense->category }}
                </span>
                @endif
            </div>

            <div>
                {{-- <p class="font-medium text-gray-800">
                    {{ $expense->title }}
                </p> --}}
                <p class="text-xs text-gray-400">
                    {{ $expense->date->format('M d, Y') }}
                </p>
            </div>

            <!-- Amount -->
            <div class=" font-semibold text-gray-800 ">
                <i class="fa-solid fa-peso-sign "></i> {{ number_format($expense->amount, 2) }}
            </div>

            <!-- Status -->
            <div>
                <span class="inline-flex px-2 py-1 rounded-full text-xs font-medium
                {{ $expense->status === 'paid'
                ? 'bg-green-100 text-green-800'
                : 'bg-red-100 text-red-800' }}">
                    {{ ucfirst($expense->status) }}
                </span>
            </div>

        </div>

        @empty

        <p class="text-gray-500 text-center py-4">
            No expenses yet
        </p>

        @endforelse

    </div>

    <a href="{{ route('expenses.index') }}"
       class="block mt-4 text-center text-blue-600 hover:text-blue-700 font-medium">
        View All Expenses →
    </a>

</div>

</div>
@endsection