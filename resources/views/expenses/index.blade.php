@extends('layouts.app')

@section('title', 'Expenses')

@push('styles')
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
@endpush

@section('content')

<div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-6">

    <!-- Page Header -->
    <div class="mb-6 flex flex-col sm:flex-row sm:items-center sm:justify-between gap-4">

        <div>
            <h1 class="text-2xl font-bold text-gray-900">Expenses</h1>
            <p class="text-gray-600 mt-1">Manage your expenses</p>
        </div>

        <a href="{{ route('expenses.create') }}"
           class="inline-flex items-center px-4 py-2 bg-indigo-600 text-white rounded-lg hover:bg-indigo-700 transition">

            <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                      d="M12 4v16m8-8H4"/>
            </svg>

            Add Expense
        </a>

    </div>

    <!-- Statistics -->
    <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-6 mb-6">

        <!-- Total -->
        <div class="bg-white rounded-xl shadow-sm border border-gray-100 p-6 hover:shadow-md transition-shadow">

            <div class="flex items-center justify-between">

                <div>
                    <p class="text-sm text-gray-500">Total Expenses</p>
                    <p class="text-2xl font-bold text-gray-900 mt-1">
                        <i class="fa-solid fa-peso-sign text-2xl"></i> {{ number_format($totalAmount,2) }}
                    </p>
                </div>

                <div class="w-12 h-12 bg-indigo-100 rounded-lg flex items-center justify-center">
                    <i class="fa-solid fa-peso-sign text-1xl text-indigo-500"></i>
                </div>

            </div>
        </div>

        <!-- Paid -->
        <div class="bg-white rounded-xl shadow-sm border border-gray-100 p-6 hover:shadow-md transition-shadow">

            <div class="flex items-center justify-between">

                <div>
                    <p class="text-sm text-gray-500">Paid</p>
                    <p class="text-2xl font-bold text-green-600 mt-1">
                        <i class="fa-solid fa-peso-sign text-2xl"></i> {{ number_format($paidAmount,2) }}
                    </p>
                </div>

                <div class="w-12 h-12 bg-green-100 rounded-lg flex items-center justify-center">
                    <i class="fa-solid fa-circle-check text-green-600"></i>
                </div>

            </div>
        </div>

        <!-- Unpaid -->
        <div class="bg-white rounded-xl shadow-sm border border-gray-100 p-6 hover:shadow-md transition-shadow">

            <div class="flex items-center justify-between">

                <div>
                    <p class="text-sm text-gray-500">Unpaid</p>
                    <p class="text-2xl font-bold text-red-600 mt-1">
                        <i class="fa-solid fa-peso-sign text-2xl"></i> {{ number_format($unpaidAmount,2) }}
                    </p>
                </div>

                <div class="w-12 h-12 bg-red-100 rounded-lg flex items-center justify-center">
                    <i class="fa-solid fa-exclamation text-red-600 "></i>
                    
                </div>

            </div>
        </div>

    </div>

    <!-- Filter -->
    <div class="bg-white rounded-xl shadow-sm border border-gray-100 p-4 mb-6">

        <form method="GET"
      action="{{ route('expenses.index') }}"
      class="flex flex-col md:flex-row gap-4">

    <!-- Search Input -->
    <input
        type="text"
        name="search"
        value="{{ $search }}"
        placeholder="Search expenses..."
        class="flex-1 px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-indigo-500">

    <!-- Custom Animated Dropdown -->
    <div x-data="{ open: false, selected: '{{ $status ?? '' }}' }" class="relative w-48">

        <!-- Button -->
        <button type="button" @click="open = !open"
            class="w-full px-4 py-2 bg-white border border-gray-300 rounded-lg flex justify-between items-center shadow-sm">
            <span x-text="selected || 'All Status'"></span>
            <svg :class="{'rotate-180': open}" class="w-5 h-5 transition-transform duration-300" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"/>
            </svg>
        </button>

        <!-- Hidden input for form submission -->
        <input type="hidden" name="status" :value="selected">

        <!-- Dropdown menu -->
        <div x-show="open" @click.away="open = false"
             x-transition:enter="transition ease-out duration-200"
             x-transition:enter-start="opacity-0 translate-y-2"
             x-transition:enter-end="opacity-100 translate-y-0"
             x-transition:leave="transition ease-in duration-150"
             x-transition:leave-start="opacity-100 translate-y-0"
             x-transition:leave-end="opacity-0 translate-y-2"
             class="absolute mt-1 w-full bg-white border border-gray-300 rounded-lg shadow-lg z-50">

            <ul class="py-1">
                <li @click="selected = ''; open = false"
                    class="px-4 py-2 hover:bg-gray-100 cursor-pointer">All Status</li>
                <li @click="selected = 'paid'; open = false"
                    class="px-4 py-2 hover:bg-gray-100 cursor-pointer">Paid</li>
                <li @click="selected = 'unpaid'; open = false"
                    class="px-4 py-2 hover:bg-gray-100 cursor-pointer">Unpaid</li>
            </ul>
        </div>

    </div>

    <!-- Filter Button -->
    <button type="submit"
            class="px-6 py-2 bg-gray-900 text-white rounded-lg hover:bg-gray-800">
        Filter
    </button>

    <!-- Clear Button -->
    @if($search || $status)
        <a href="{{ route('expenses.index') }}"
           class="px-6 py-2 bg-gray-200 text-gray-700 rounded-lg hover:bg-gray-300">
            Clear
        </a>
    @endif

</form>

    </div>

    <!-- Table -->
    <div class="bg-white rounded-xl shadow-sm border border-gray-100 overflow-hidden">

        <div class="overflow-x-auto">

            <table class="min-w-full text-sm">

                <thead class="bg-gray-50">
                    <tr>

                        <th class="px-6 py-3 text-left font-medium text-gray-500 uppercase">Title</th>
                        <th class="px-6 py-3 text-left font-medium text-gray-500 uppercase">Amount</th>
                        <th class="px-6 py-3 text-left font-medium text-gray-500 uppercase">Category</th>
                        <th class="px-6 py-3 text-left font-medium text-gray-500 uppercase">Date</th>
                        <th class="px-6 py-3 text-left font-medium text-gray-500 uppercase">Status</th>
                        <th class="px-6 py-3 text-left font-medium text-gray-500 uppercase">Actions</th>

                    </tr>
                </thead>

                <tbody class="divide-y divide-gray-200">

                    @forelse($expenses as $expense)

                    <tr class="hover:bg-gray-50">

                        <td class="px-6 py-4">
                            <div class="font-medium text-gray-900">
                                {{ $expense->title }}
                            </div>

                            @if($expense->description)
                            <div class="text-xs text-gray-500">
                                {{ $expense->description }}
                            </div>
                            @endif
                        </td>

                        <td class="px-6 py-4 font-semibold">
                            <i class="fa-solid fa-peso-sign"></i> {{ number_format($expense->amount,2) }}
                        </td>

                        <td class="px-6 py-4">
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
                                No Category
                            </span>
                            @endif
                            @else
                            <span class="px-2 py-1 text-xs rounded-full bg-gray-100 text-gray-700">
                                No Category
                            </span>
                            @endif
                        </td>

                        <td class="px-6 py-4 text-gray-600">
                            {{ \Carbon\Carbon::parse($expense->date)->format('M d, Y') }}
                        </td>

                        <td class="px-6 py-4">

                            @if($expense->status === 'paid')

                            <span class="px-2 py-1 text-xs bg-green-100 text-green-700 rounded-full">
                                Paid
                            </span>

                            @else

                            <span class="px-2 py-1 text-xs bg-red-100 text-red-700 rounded-full">
                                Unpaid
                            </span>

                            @endif

                        </td>

                        <td class="px-6 py-4 flex gap-2">

                            <a href="{{ route('expenses.edit',$expense) }}"
                               class="text-blue-600 hover:text-blue-800">

                               Edit

                            </a>

                            <form action="{{ route('expenses.destroy',$expense) }}"
                                  method="POST"
                                  onsubmit="return confirm('Delete expense?')">

                                @csrf
                                @method('DELETE')

                                <button class="text-red-600 hover:text-red-800">
                                    Delete
                                </button>

                            </form>

                        </td>

                    </tr>

                    @empty

                    <tr>
                        <td colspan="6" class="text-center py-10 text-gray-500">
                            No expenses found.
                        </td>
                    </tr>

                    @endforelse

                </tbody>

            </table>

        </div>

        <!-- Pagination -->
        <div class="px-6 py-4 border-t">
            {{ $expenses->links() }}
        </div>

    </div>

</div>

@endsection