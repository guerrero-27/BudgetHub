@extends('layouts.app')

@section('title', 'Edit Category')

@section('content')
<div class="p-6 max-w-2xl mx-auto">
    <div class="mb-6">
        <a href="{{ route('categories.index') }}" class="inline-flex items-center text-gray-600 hover:text-gray-900">
            <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7"/>
            </svg>
            Back to Categories
        </a>
    </div>

    <div class="bg-white rounded-xl shadow-sm border border-gray-100 p-6">
        <h1 class="text-2xl font-bold text-gray-900 mb-6">Edit Category</h1>

        <form action="{{ route('categories.update', $category) }}" method="POST">
            @csrf
            @method('PUT')

            <div class="space-y-4">
                <div>
                    <label for="name" class="block text-sm font-medium text-gray-700 mb-1">Category Name</label>
                    <input type="text" name="name" id="name" value="{{ old('name', $category->name) }}" required
                        class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500"
                        placeholder="e.g., Food, Transport, Entertainment">
                    @error('name')
                        <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                    @enderror
                </div>

                <div>
                    <label for="color" class="block text-sm font-medium text-gray-700 mb-1">Color</label>
                    
                    <!-- Color Selection Grid -->
                    <div class="grid grid-cols-4 gap-3 mb-4">
                        @php
                            $colors = [
                                'green' => 'Green',
                                'red' => 'Red', 
                                'blue' => 'Blue',
                                'yellow' => 'Yellow',
                                'purple' => 'Purple',
                                'pink' => 'Pink',
                                'indigo' => 'Indigo',
                                'gray' => 'Gray',
                            ];
                        @endphp

                        @foreach($colors as $colorName => $colorLabel)
                        <label class="cursor-pointer">
                            <input type="radio" name="color" value="{{ $colorName }}" 
                                   {{ old('color', $category->color) === $colorName ? 'checked' : '' }}
                                   class="sr-only peer" required>
                            <div class="px-4 py-3 text-center border-2 border-gray-200 rounded-lg 
                                peer-checked:border-{{ $colorName }}-500 
                                peer-checked:bg-{{ $colorName }}-50 
                                peer-checked:shadow-[0_0_10px_rgba(0,0,0,0.1)]
                                peer-checked:shadow-{{ $colorName }}-500/30
                                hover:border-{{ $colorName }}-300 hover:bg-{{ $colorName }}-50 
                                transition-all duration-200">
                                <span class="w-4 h-4 inline-block rounded-full bg-{{ $colorName }}-500 mb-1"></span>
                                <span class="block text-xs text-gray-600">{{ $colorLabel }}</span>
                            </div>
                        </label>
                        @endforeach
                    </div>

                    @error('color')
                        <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                    @enderror
                </div>

                <!-- Live Preview -->
                <div class="bg-gray-50 rounded-lg p-4">
                    <h3 class="text-sm font-medium text-gray-500 mb-3">Live Preview</h3>
                    <div class="flex items-center gap-3">
                        <div id="previewBadge" class="w-12 h-12 rounded-full bg-{{ $category->color }}-100 flex items-center justify-center">
                            <span id="previewInitial" class="text-{{ $category->color }}-600 font-bold text-xl">
                                {{ strtoupper(substr($category->name, 0, 1)) }}
                            </span>
                        </div>
                        <div>
                            <span id="previewName" class="font-semibold text-gray-900">{{ $category->name }}</span>
                            <span id="previewColorBadge" class="ml-2 px-2 py-0.5 text-xs rounded-full bg-{{ $category->color }}-100 text-{{ $category->color }}-700">
                                {{ $category->color }}
                            </span>
                        </div>
                    </div>
                </div>
            </div>

            <div class="mt-6 flex gap-4">
                <button type="submit" class="flex-1 px-6 py-3 bg-indigo-600 text-white font-medium rounded-lg hover:bg-indigo-700 transition-colors">
                    Update Category
                </button>
                <a href="{{ route('categories.index') }}" class="px-6 py-3 bg-gray-200 text-gray-700 font-medium rounded-lg hover:bg-gray-300 transition-colors">
                    Cancel
                </a>
            </div>
        </form>
    </div>
</div>

@push('scripts')
<script>
    const nameInput = document.getElementById('name');
    const colorInputs = document.querySelectorAll('input[name="color"]');
    const previewBadge = document.getElementById('previewBadge');
    const previewInitial = document.getElementById('previewInitial');
    const previewName = document.getElementById('previewName');
    const previewColorBadge = document.getElementById('previewColorBadge');

    function updatePreview() {
        const name = nameInput.value || 'Category Name';
        let color = 'green';
        
        colorInputs.forEach(input => {
            if (input.checked) {
                color = input.value;
            }
        });

        // Update preview elements
        previewName.textContent = name;
        previewInitial.textContent = name.charAt(0).toUpperCase();
        
        // Update badge colors
        const colors = ['green', 'red', 'blue', 'yellow', 'purple', 'pink', 'indigo', 'gray'];
        colors.forEach(c => {
            previewBadge.classList.remove(`bg-${c}-100`);
            previewInitial.classList.remove(`text-${c}-600`);
            previewColorBadge.classList.remove(`bg-${c}-100`, `text-${c}-700`);
        });
        
        previewBadge.classList.add(`bg-${color}-100`);
        previewInitial.classList.add(`text-${color}-600`);
        previewColorBadge.classList.add(`bg-${color}-100`, `text-${color}-700`);
        previewColorBadge.textContent = color;
    }

    nameInput.addEventListener('input', updatePreview);
    colorInputs.forEach(input => {
        input.addEventListener('change', updatePreview);
    });

    // Initialize preview on page load
    updatePreview();
</script>
@endpush
@endsection

