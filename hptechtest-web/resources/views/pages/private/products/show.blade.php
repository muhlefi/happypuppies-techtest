<div id="detailProductModal" class="fixed inset-0 bg-black/50 flex items-center justify-center z-[9999] hidden p-4 sm:p-6">
    <div class="relative p-6 bg-white w-full max-w-md mx-auto rounded-lg shadow-xl text-start">
        <button type="button" data-close-modal="detailProductModal"
            class="absolute top-3 right-3 text-gray-400 hover:text-gray-600 focus:outline-none !cursor-pointer">
            <svg class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor" aria-hidden="true">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
            </svg>
        </button>

        <h3 class="text-lg font-semibold text-gray-900 mb-4">Product Details</h3>

        <div class="space-y-4">
            <div>
                <label class="block text-sm font-medium text-gray-700">Name:</label>
                <p id="detail_product_name" class="mt-1 text-sm text-gray-900"></p>
            </div>

            <div>
                <label class="block text-sm font-medium text-gray-700">Category:</label>
                <p id="detail_category" class="mt-1 text-sm text-gray-900"></p>
            </div>

            <div>
                <label class="block text-sm font-medium text-gray-700">Price:</label>
                <p id="detail_price" class="mt-1 text-sm text-gray-900"></p>
            </div>

            <div>
                <label class="block text-sm font-medium text-gray-700">Stock:</label>
                <p id="detail_stock" class="mt-1 text-sm text-gray-900"></p>
            </div>
        </div>
    </div>
</div>