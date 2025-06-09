<div id="createProductModal" class="fixed inset-0 bg-black/50 flex items-center justify-center z-[9999] hidden p-4 sm:p-6">
    <div class="relative bg-white w-full max-w-lg mx-auto rounded-lg shadow-xl text-start">
        <button type="button" data-close-modal="createProductModal"
            class="absolute top-3 right-3 text-gray-400 hover:text-gray-600 focus:outline-none !cursor-pointer">
            <svg class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor" aria-hidden="true">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
            </svg>
        </button>

        <h3 class="text-lg font-semibold text-gray-900 mb-4 p-6 pb-0">Add New Product</h3>

        <form action="{{ route('products.store') }}" method="POST" class="space-y-4 p-6 pt-0">
            @csrf
            <div>
                <label for="product_name" class="block text-sm font-medium text-gray-700">Name</label>
                <input type="text" name="product_name" id="product_name" value="{{ old('product_name') }}"
                    class="mt-1 block w-full px-3 py-2 text-sm text-gray-900 border {{ $errors->has('product_name') ? 'border-red-500' : 'border-gray-300' }} rounded-md focus:ring-blue-500 focus:border-blue-500">
                @error('product_name')
                    <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                @enderror
            </div>

            <div>
                <label for="category" class="block text-sm font-medium text-gray-700">Category</label>
                <select name="category" id="category"
                    class="mt-1 block w-full text-sm text-gray-900 {{ $errors->has('category') ? 'border border-red-500' : '' }} rounded-md focus:ring-blue-500 focus:border-blue-500">
                    <option value="">-- Choose or create a category --</option>
                    @foreach ($categories as $category)
                        <option value="{{ $category }}" {{ old('category') == $category ? 'selected' : '' }}>{{ $category }}</option>
                    @endforeach
                </select>
                @error('category')
                    <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                @enderror
            </div>

            <div>
                <label for="price" class="block text-sm font-medium text-gray-700">Price</label>
                <input type="number" name="price" id="price" value="{{ old('price') }}" min="0"
                    class="mt-1 block w-full px-3 py-2 text-sm text-gray-900 border {{ $errors->has('price') ? 'border-red-500' : 'border-gray-300' }} rounded-md focus:ring-blue-500 focus:border-blue-500">
                @error('price')
                    <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                @enderror
            </div>

            <div>
                <label for="stock" class="block text-sm font-medium text-gray-700">Stock</label>
                <input type="number" name="stock" id="stock" value="{{ old('stock') }}" min="0"
                    class="mt-1 block w-full px-3 py-2 text-sm text-gray-900 border {{ $errors->has('stock') ? 'border-red-500' : 'border-gray-300' }} rounded-md focus:ring-blue-500 focus:border-blue-500">
                @error('stock')
                    <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                @enderror
            </div>

            <div class="flex justify-end space-x-3 mt-6">
                <button type="button" data-close-modal="createProductModal"
                    class="px-4 py-2 text-xs font-medium text-red-700 border border-red-300 rounded-md hover:bg-red-200 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-gray-500 !cursor-pointer">
                    Cancel
                </button>
                <button type="submit"
                    class="px-4 py-2 text-xs font-medium text-white bg-gray-600 border border-transparent rounded-md hover:bg-gray-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-gray-500 !cursor-pointer">
                    Create Product
                </button>
            </div>
        </form>
    </div>
</div>
