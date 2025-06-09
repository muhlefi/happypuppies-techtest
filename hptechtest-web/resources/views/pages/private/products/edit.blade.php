<div id="editProductModal" class="fixed inset-0 bg-black/50 flex items-center justify-center z-[9999] hidden p-4 sm:p-6">
    <div class="relative p-6 bg-white w-full max-w-lg mx-auto rounded-lg shadow-xl text-start">
        <button type="button" data-close-modal="editProductModal"
            class="absolute top-3 right-3 text-gray-400 hover:text-gray-600 focus:outline-none !cursor-pointer">
            <svg class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor" aria-hidden="true">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
            </svg>
        </button>

        <h3 class="text-lg font-semibold text-gray-900 mb-4">Edit Product</h3>

        <form id="editProductForm" method="POST" class="space-y-4">
            @csrf
            @method('PUT')

            <div>
                <label for="edit_product_name" class="block text-sm font-medium text-gray-700">Name</label>
                <input type="text" name="product_name" id="edit_product_name"
                    class="mt-1 block w-full px-3 py-2 text-sm text-gray-900 border border-gray-300 rounded-md focus:ring-blue-500 focus:border-blue-500">
                <p id="edit_product_name_error" class="text-red-500 text-xs mt-1 hidden"></p>
            </div>

            <div>
                <label for="edit_category" class="block text-sm font-medium text-gray-700">Category</label>
                <select name="category" id="edit_category"
                    class="mt-1 block w-full text-sm text-gray-900 rounded-md focus:ring-blue-500 focus:border-blue-500">
                    <option value="">-- Choose or create a category --</option>
                    @foreach ($categories as $category)
                        <option value="{{ $category }}">{{ $category }}</option>
                    @endforeach
                </select>
                <p id="edit_category_error" class="text-red-500 text-xs mt-1 hidden"></p>
            </div>

            <div>
                <label for="edit_price" class="block text-sm font-medium text-gray-700">Price</label>
                <input type="number" name="price" id="edit_price" min="0"
                    class="mt-1 block w-full px-3 py-2 text-sm text-gray-900 border border-gray-300 rounded-md focus:ring-blue-500 focus:border-blue-500">
                <p id="edit_price_error" class="text-red-500 text-xs mt-1 hidden"></p>
            </div>

            <div>
                <label for="edit_stock" class="block text-sm font-medium text-gray-700">Stock</label>
                <input type="number" name="stock" id="edit_stock" min="0"
                    class="mt-1 block w-full px-3 py-2 text-sm text-gray-900 border border-gray-300 rounded-md focus:ring-blue-500 focus:border-blue-500">
                <p id="edit_stock_error" class="text-red-500 text-xs mt-1 hidden"></p>
            </div>

            <div class="flex justify-end space-x-3 mt-6">
                <button type="button" data-close-modal="editProductModal"
                    class="px-4 py-2 text-xs font-medium text-red-700 border border-red-300 rounded-md hover:bg-red-200 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-gray-500 !cursor-pointer">
                    Cancel
                </button>
                <button type="submit"
                    class="px-4 py-2 text-xs font-medium text-white bg-gray-600 border border-transparent rounded-md hover:bg-gray-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-gray-500 !cursor-pointer">
                    Update Product
                </button>
            </div>
        </form>
    </div>
</div>
