@extends('layouts.app')

@section('title', 'Categories')

@section('content')
<div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-6">

    <!-- Page Header -->
    <div class="mb-6 flex flex-col sm:flex-row sm:items-center sm:justify-between gap-4">

        <div>
            <h1 class="text-2xl font-bold text-gray-900">Categories</h1>
            <p class="text-gray-600 mt-1">Manage expense categories</p>
        </div>

        <a href="{{ route('categories.create') }}"
           class="inline-flex items-center px-4 py-2 bg-indigo-600 text-white rounded-lg hover:bg-indigo-700 transition">

            <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                      d="M12 4v16m8-8H4"/>
            </svg>

            Add Category
        </a>

    </div>

    <!-- Success Message -->
    @if(session('success'))
        <div class="mb-4 p-4 bg-green-100 border border-green-400 text-green-700 rounded-lg">
            {{ session('success') }}
        </div>
    @endif

    <!-- Error Message -->
    @if(session('error'))
        <div class="mb-4 p-4 bg-red-100 border border-red-400 text-red-700 rounded-lg">
            {{ session('error') }}
        </div>
    @endif

    <!-- Categories Grid -->
    <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 xl:grid-cols-4 gap-4">

        @forelse($categories as $category)

        <div class="bg-white rounded-xl shadow-sm border border-gray-100 p-4 hover:shadow-md transition-shadow">

            <div class="flex items-center justify-between">
                
                <div class="flex items-center gap-3">
                    <!-- Color Badge Preview -->
                    <div class="w-10 h-10 rounded-full bg-{{ $category->color }}-100 flex items-center justify-center">
                        <span class="text-{{ $category->color }}-600 font-bold text-lg">
                            {{ strtoupper(substr($category->name, 0, 1)) }}
                        </span>
                    </div>
                    
                    <div>
                        <h3 class="font-semibold text-gray-900">{{ $category->name }}</h3>
                        <span class="px-2 py-0.5 text-xs rounded-full bg-{{ $category->color }}-100 text-{{ $category->color }}-700">
                            {{ $category->color }}
                        </span>
                    </div>
                </div>

                <!-- Actions Dropdown -->
                <div class="relative" x-data="{ open: false }">
                    <button @click="open = !open" class="p-2 text-gray-400 hover:text-gray-600 rounded-full hover:bg-gray-100">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 5v.01M12 12v.01M12 19v.01M12 6a1 1 0 110-2 1 1 0 010 2zm0 7a1 1 0 110-2 1 1 0 010 2zm0 7a1 1 0 110-2 1 1 0 010 2z"/>
                        </svg>
                    </button>

                    <div x-show="open" @click.away="open = false"
                         class="absolute right-0 mt-1 w-32 bg-white border border-gray-200 rounded-lg shadow-lg z-10"
                         x-transition:enter="transition ease-out duration-100"
                         x-transition:enter-start="transform opacity-0 scale-95"
                         x-transition:enter-end="transform opacity-100 scale-100"
                         x-transition:leave="transition ease-in duration-75"
                         x-transition:leave-start="transform opacity-100 scale-100"
                         x-transition:leave-end="transform opacity-0 scale-95">

                        <a href="{{ route('categories.edit', $category) }}" 
                           class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-100 rounded-t-lg">
                            Edit
                        </a>

                        <form action="{{ route('categories.destroy', $category) }}" method="POST" 
                              onsubmit="return confirm('Are you sure you want to delete this category?')">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="w-full text-left px-4 py-2 text-sm text-red-600 hover:bg-red-50 rounded-b-lg">
                                Delete
                            </button>
                        </form>
                    </div>
                </div>

            </div>

            <!-- Expense Count -->
            <div class="mt-3 pt-3 border-t border-gray-100">
                <p class="text-xs text-gray-500">
                    {{ $category->expenses()->count() }} expense{{ $category->expenses()->count() !== 1 ? 's' : '' }}
                </p>
            </div>

        </div>

        @empty

        <div class="col-span-full text-center py-12">
            <svg class="w-16 h-16 mx-auto text-gray-300 mb-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M7 7h.01M7 3h5c.512 0 1.024.195 1.414.586l7 7a2 2 0 010 2.828l-7 7a2 2 0 01-2.828 0l-7-7A1.994 1.994 0 013 12V7a4 4 0 014-4z"/>
            </svg>
            <h3 class="text-lg font-medium text-gray-900 mb-1">No categories yet</h3>
            <p class="text-gray-500 mb-4">Create your first category to organize your expenses</p>
            <a href="{{ route('categories.create') }}" class="inline-flex items-center px-4 py-2 bg-indigo-600 text-white rounded-lg hover:bg-indigo-700 transition">
                Add Category
            </a>
        </div>

        @endforelse

    </div>

    <!-- Pagination -->
    @if($categories->hasPages())
    <div class="mt-6">
        {{ $categories->links() }}
    </div>
    @endif

</div>
@endsection

