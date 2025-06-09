@extends('layout.app')
@section('title', 'Product List')

@section('content')
    <div class="text-start space-y-3">
        <h2 class="text-2xl font-semibold text-gray-900">Products</h2>
        <nav class="flex" aria-label="Breadcrumb">
            <ol class="inline-flex items-center space-x-1 md:space-x-3">
                <li class="inline-flex items-center">
                    <a href="{{ url('/') }}"
                        class="inline-flex items-center text-sm font-medium text-gray-700 hover:text-gray-900">
                        <i class="fas fa-home mr-2"></i> Home
                    </a>
                </li>
                <li>
                    <div class="flex items-center">
                        <i class="fas fa-angle-right text-gray-400 mx-2"></i>
                        <span class="ml-1 text-sm font-medium text-gray-700">Products</span>
                    </div>
                </li>
            </ol>
        </nav>
    </div>

    <div class="mt-8 bg-white border border-gray-200 rounded-lg">
        <div class="p-4 flex flex-col sm:flex-row items-center justify-between border-b border-gray-200">
            <h3 class="text-md font-semibold text-gray-800 mb-4 sm:mb-0 w-full sm:w-auto text-start">Product List</h3>

            <div class="flex flex-col sm:flex-row sm:items-center gap-3 sm:w-auto w-full">
                <form id="filterForm" method="GET" action="{{ route('products.index') }}"
                    class="flex flex-col sm:flex-row sm:items-center gap-3 w-full sm:w-auto">
                    <div class="relative w-full sm:w-auto">
                        <div class="flex items-center gap-2 w-full">
                            <input type="text" name="search" id="searchInput" placeholder="Search product..."
                                value="{{ request('search') }}"
                                class="flex-grow px-3 py-2 border border-gray-300 rounded-md text-sm focus:ring-blue-500 focus:border-blue-500">

                            <button id="filterToggle" type="button"
                                class="px-3 py-2 border border-gray-300 rounded-md text-sm bg-white hover:bg-gray-200 focus:bg-gray-600 focus:text-white focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500 cursor-pointer">
                                <i class="fas fa-filter mr-1"></i> Filter
                            </button>
                        </div>

                        <div id="filterPopover"
                            class="absolute z-20 mt-2 w-full sm:w-64 bg-white border border-gray-200 rounded-lg shadow-lg hidden">
                            <div class="p-4 space-y-4">
                                <label for="categoryFilter" class="text-xs font-medium text-gray-700 mb-2">Filter</label>
                                <select name="category" id="categoryFilter"
                                    class="w-full px-3 py-2 text-xs text-gray-900 border border-gray-300 rounded-md focus:ring-blue-500 focus:border-blue-500">
                                    <option value="all"
                                        {{ request('category') === 'all' || !request('category') ? 'selected' : '' }}>All
                                        Categories</option>
                                    @foreach ($categories as $cat)
                                        <option value="{{ $cat }}"
                                            {{ request('category') === $cat ? 'selected' : '' }}>{{ $cat }}
                                        </option>
                                    @endforeach
                                </select>
                                <div class="flex justify-between items-center gap-3">
                                    <button type="submit"
                                        class="w-1/2 text-xs font-medium text-white bg-gray-600 px-3 py-2 rounded-md focus:outline-none focus:ring-2 focus:ring-offset-2 cursor-pointer">
                                        Apply
                                    </button>
                                    <button type="submit" onclick="location.href='{{ route('products.index') }}'"
                                        class="w-1/2 text-xs text-red-600 border border-red-600 px-3 py-2 rounded-md hover:underline focus:outline-none focus:ring-2 focus:ring-offset-2 cursor-pointer">
                                        Reset
                                    </button>
                                </div>
                            </div>
                        </div>
                    </div>
                </form>

                <button data-open-modal="createProductModal" type="button"
                    class="text-white cursor-pointer px-4 py-2 text-xs font-medium bg-gray-600 border border-transparent rounded-md hover:bg-gray-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-gray-500 w-full sm:w-auto">
                    <i class="fas fa-plus mr-1"></i> Add New Product
                </button>
            </div>
        </div>
        <div class="overflow-auto">
            <table class="min-w-full divide-y divide-gray-200 overflow-auto">
                <thead class="bg-gray-50">
                    <tr>
                        <th class="px-6 py-3 text-xs font-medium text-gray-500 uppercase tracking-wider">No</th>
                        <th class="px-6 py-3 text-xs font-medium text-gray-500 uppercase tracking-wider">Name</th>
                        <th class="px-6 py-3 text-xs font-medium text-gray-500 uppercase tracking-wider">Category</th>
                        <th class="px-6 py-3 text-xs font-medium text-gray-500 uppercase tracking-wider">Price</th>
                        <th class="px-6 py-3 text-xs font-medium text-gray-500 uppercase tracking-wider">Stock</th>
                        <th class="px-6 py-3 text-xs font-medium text-gray-500 uppercase tracking-wider">Action</th>
                    </tr>
                </thead>
                <tbody class="bg-white divide-y divide-gray-200">
                    @forelse ($products as $index => $product)
                        <tr class="hover:bg-gray-50">
                            <td class="px-6 py-4 whitespace-nowrap text-sm font-medium text-gray-900">
                                {{ $products->firstItem() + $index }}
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">{{ $product->product_name }}</td>
                            <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">{{ $product->category }}</td>
                            <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">Rp
                                {{ number_format($product->price, 0, ',', '.') }}</td>
                            <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">{{ $product->stock }}</td>
                            <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">
                                <div class="flex space-x-2 justify-center">
                                    <button type="button" data-open-modal="detailProductModal"
                                        class="px-3 py-1 text-xs font-medium text-white bg-blue-500 rounded-md hover:bg-blue-600 !cursor-pointer">
                                        <i class="fas fa-eye"></i>
                                    </button>
                                    <button type="button" data-open-modal="editProductModal"
                                        data-product="{{ json_encode($product) }}"
                                        class="px-3 py-1 text-xs font-medium text-white bg-yellow-500 rounded-md hover:bg-yellow-600 !cursor-pointer">
                                        <i class="fas fa-edit"></i>
                                    </button>
                                    <form action="{{ route('products.destroy', $product->id) }}" method="POST"
                                        onsubmit="return confirm('Yakin ingin hapus data ini?')">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit"
                                            class="px-3 py-1 text-xs font-medium text-white bg-red-500 rounded-md hover:bg-red-600 !cursor-pointer">
                                            <i class="fas fa-trash-alt"></i>
                                        </button>
                                    </form>
                                </div>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="6" class="text-center px-6 py-4 text-sm text-gray-500">No products found.</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>

            <div class="p-4 border-t border-gray-200 bg-gray-50 rounded-b-lg">
                {{ $products->links() }}
            </div>
        </div>

        @include('pages.private.products.create')
        @include('pages.private.products.show')
        @include('pages.private.products.edit')
    </div>
@endsection

@section('scripts')
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            function openModal(modalId) {
                const modal = document.getElementById(modalId);
                if (modal) {
                    modal.classList.remove('hidden');
                    document.body.style.overflow = 'hidden';
                }
            }

            function closeModal(modalId) {
                const modal = document.getElementById(modalId);
                if (modal) {
                    modal.classList.add('hidden');
                    document.body.style.overflow = '';
                    modal.querySelectorAll('.text-red-500').forEach(el => {
                        el.textContent = '';
                        el.classList.add('hidden');
                    });
                    modal.querySelectorAll('input.border-red-500, select.border-red-500').forEach(el => {
                        el.classList.remove('border-red-500');
                    });
                }
            }

            document.querySelectorAll('[data-open-modal]').forEach(button => {
                button.addEventListener('click', function() {
                    const modalId = this.dataset.openModal;
                    openModal(modalId);

                    if (modalId === 'detailProductModal') {
                        const productData = JSON.parse(this.closest('tr').querySelector(
                            '[data-product]').dataset.product);
                        document.getElementById('detail_product_name').textContent = productData
                            .product_name;
                        document.getElementById('detail_category').textContent = productData
                            .category;
                        document.getElementById('detail_price').textContent =
                            `Rp ${Number(productData.price).toLocaleString('id-ID')}`;
                        document.getElementById('detail_stock').textContent = productData.stock;
                    } else if (modalId === 'editProductModal') {
                        const productData = JSON.parse(this.dataset.product);
                        document.getElementById('edit_product_name').value = productData
                            .product_name;
                        editCategoryTomSelect.setValue(productData.category);
                        document.getElementById('edit_price').value = productData.price;
                        document.getElementById('edit_stock').value = productData.stock;

                        const editForm = document.getElementById('editProductForm');
                        editForm.action = `/products/${productData.id}`;
                    }
                });
            });

            document.querySelectorAll('[data-close-modal]').forEach(button => {
                button.addEventListener('click', function() {
                    const modalId = this.dataset.closeModal;
                    closeModal(modalId);
                });
            });

            @if ($errors->any())
                const createProductModal = document.getElementById('createProductModal');
                if (createProductModal) {
                    openModal('createProductModal');
                    @error('product_name')
                        document.getElementById('product_name').classList.add('border-red-500');
                        document.getElementById('product_name_error').textContent = "{{ $message }}";
                        document.getElementById('product_name_error').classList.remove('hidden');
                    @enderror
                    @error('category')
                        document.getElementById('category').classList.add('border-red-500');
                        document.getElementById('category_error').textContent = "{{ $message }}";
                        document.getElementById('category_error').classList.remove('hidden');
                    @enderror
                    @error('price')
                        document.getElementById('price').classList.add('border-red-500');
                        document.getElementById('price_error').textContent = "{{ $message }}";
                        document.getElementById('price_error').classList.remove('hidden');
                    @enderror
                    @error('stock')
                        document.getElementById('stock').classList.add('border-red-500');
                        document.getElementById('stock_error').textContent = "{{ $message }}";
                        document.getElementById('stock_error').classList.remove('hidden');
                    @enderror
                }
            @endif

            new TomSelect('#category', {
                create: true,
                persist: false,
                maxOptions: 100,
                sortField: {
                    field: "text",
                    direction: "asc"
                },
            });

            const editCategoryTomSelect = new TomSelect('#edit_category', {
                create: true,
                persist: false,
                maxOptions: 100,
                sortField: {
                    field: "text",
                    direction: "asc"
                },
            });

            @if ($errors->hasAny(['product_name', 'category', 'price', 'stock']) && session('edit_product_id'))
                const editProductId = {{ session('edit_product_id') }};
                const productRow = document.querySelector(`[data-product*="id":${editProductId}]`).closest('tr');
                const productData = JSON.parse(productRow.querySelector('[data-product]').dataset.product);

                openModal('editProductModal');

                document.getElementById('edit_product_name').value = "{{ old('product_name') }}";
                editCategoryTomSelect.setValue("{{ old('category') }}");
                document.getElementById('edit_price').value = "{{ old('price') }}";
                document.getElementById('edit_stock').value = "{{ old('stock') }}";

                const editForm = document.getElementById('editProductForm');
                editForm.action = `/products/${editProductId}`;

                @error('product_name')
                    document.getElementById('edit_product_name').classList.add('border-red-500');
                    document.getElementById('edit_product_name_error').textContent = "{{ $message }}";
                    document.getElementById('edit_product_name_error').classList.remove('hidden');
                @enderror
                @error('category')
                    document.getElementById('edit_category').classList.add('border-red-500');
                    document.getElementById('edit_category_error').textContent = "{{ $message }}";
                    document.getElementById('edit_category_error').classList.remove('hidden');
                @enderror
                @error('price')
                    document.getElementById('edit_price').classList.add('border-red-500');
                    document.getElementById('edit_price_error').textContent = "{{ $message }}";
                    document.getElementById('edit_price_error').classList.remove('hidden');
                @enderror
                @error('stock')
                    document.getElementById('edit_stock').classList.add('border-red-500');
                    document.getElementById('edit_stock_error').textContent = "{{ $message }}";
                    document.getElementById('edit_stock_error').classList.remove('hidden');
                @enderror
            @endif

            document.getElementById('filterToggle').addEventListener('click', function() {
                const popover = document.getElementById('filterPopover');
                popover.classList.toggle('hidden');
            });

            document.addEventListener('click', function(e) {
                const toggleBtn = document.getElementById('filterToggle');
                const popover = document.getElementById('filterPopover');
                if (!toggleBtn.contains(e.target) && !popover.contains(e.target)) {
                    popover.classList.add('hidden');
                }
            });

            let debounceTimer;
            const searchInput = document.getElementById('searchInput');
            searchInput.addEventListener('input', function() {
                clearTimeout(debounceTimer);
                debounceTimer = setTimeout(() => {
                    document.getElementById('filterForm').submit();
                }, 500);
            });

        });
    </script>
@endsection
