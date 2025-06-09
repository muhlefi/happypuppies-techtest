@extends('layout.app')
@section('title', 'Dashboard')

@section('content')
    <div class="text-start space-y-3">
        <h2 class="text-2xl font-semibold text-gray-900">Product</h2>
        <nav class="flex" aria-label="Breadcrumb">
            <ol class="inline-flex items-center space-x-1 md:space-x-3">
                <li class="inline-flex items-center">
                    <a href="#" class="inline-flex items-center text-sm font-medium text-gray-700 hover:text-gray-900">
                        <i class="fas fa-home mr-2"></i>
                        Home
                    </a>
                </li>
                <li>
                    <div class="flex items-center">
                        <i class="fas fa-angle-right text-gray-400 mx-2"></i>
                        <span class="ml-1 text-sm font-medium text-gray-700">Product</span>
                    </div>
                </li>
            </ol>
        </nav>
    </div>

    <div class="mt-8 bg-white border border-gray-200 rounded-lg">
        <div class="p-4 flex items-center justify-between border-b border-gray-200">
            <h3 class="text-md font-semibold text-gray-800">Product</h3>
            <div class="flex items-center space-x-3">
                <input type="text" placeholder="Cari..."
                    class="block w-48 px-3 py-2 text-xs text-gray-900 border border-gray-300 rounded-md focus:ring-blue-500 focus:border-blue-500">
                <button
                    class="px-4 py-2 text-xs font-medium text-gray-700 bg-gray-100 border border-gray-300 rounded-md hover:bg-gray-200 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500">
                    <i class="fas fa-filter mr-1"></i> Filter
                </button>
                <button
                    class="px-4 py-2 text-xs font-medium text-white bg-blue-600 border border-transparent rounded-md hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500">
                    <i class="fas fa-plus mr-1"></i> Tambah Data Baru
                </button>
            </div>
        </div>

        <div class="overflow-x-auto">
            <table class="min-w-full divide-y divide-gray-200">
                <thead class="bg-gray-50">
                    <tr>
                        <th scope="col"
                            class="px-6 py-3 text-xs font-medium text-gray-500 uppercase tracking-wider">
                            No
                        </th>
                        <th scope="col"
                            class="px-6 py-3 text-xs font-medium text-gray-500 uppercase tracking-wider">
                            Nama
                        </th>
                        <th scope="col"
                            class="px-6 py-3 text-xs font-medium text-gray-500 uppercase tracking-wider">
                            Kategori
                        </th>
                        <th scope="col"
                            class="px-6 py-3 text-xs font-medium text-gray-500 uppercase tracking-wider">
                            Harga
                        </th>
                        <th scope="col"
                            class="px-6 py-3 text-xs font-medium text-gray-500 uppercase tracking-wider">
                            Stok
                        </th>
                        <th scope="col"
                            class="px-6 py-3 text-xs font-medium text-gray-500 uppercase tracking-wider">
                            Aksi
                        </th>
                    </tr>
                </thead>
                <tbody class="bg-white divide-y divide-gray-200">
                    <tr class="hover:bg-gray-50">
                        <td class="px-6 py-4 whitespace-nowrap text-sm font-medium text-gray-900">1</td>
                        <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">Laptop Asus Vivobook</td>
                        <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">Elektronik</td>
                        <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">Rp 8.500.000</td>
                        <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">15</td>
                        <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500 flex items-center justify-center">
                            <div class="flex space-x-2">
                                <button
                                    class="px-3 py-1 text-xs font-medium text-white bg-yellow-500 border border-transparent rounded-md hover:bg-yellow-600 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-yellow-500 cursor-pointer">
                                    <i class="fas fa-edit"></i>
                                </button>
                                <button
                                    class="px-3 py-1 text-xs font-medium text-white bg-red-500 border border-transparent rounded-md hover:bg-red-600 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-red-500 cursor-pointer">
                                    <i class="fas fa-trash-alt"></i>
                                </button>
                            </div>
                        </td>
                    </tr>
                </tbody>
            </table>
        </div>

        <div class="p-4 flex items-center justify-between border-t border-gray-200 bg-gray-50 rounded-b-lg">
            <div class="text-sm text-gray-700">
                Menampilkan 1 sampai 10 dari 100 entri
            </div>
            <div class="flex items-center space-x-1">
                <button
                    class="px-3 py-1 text-sm font-medium text-gray-700 bg-white border border-gray-300 rounded-md hover:bg-gray-100">Sebelumnya</button>
                <button
                    class="px-3 py-1 text-sm font-medium text-blue-600 bg-blue-50 border border-blue-300 rounded-md">1</button>
                <button
                    class="px-3 py-1 text-sm font-medium text-gray-700 bg-white border border-gray-300 rounded-md hover:bg-gray-100">2</button>
                <button
                    class="px-3 py-1 text-sm font-medium text-gray-700 bg-white border border-gray-300 rounded-md hover:bg-gray-100">3</button>
                <button
                    class="px-3 py-1 text-sm font-medium text-gray-700 bg-white border border-gray-300 rounded-md hover:bg-gray-100">Berikutnya</button>
            </div>
        </div>
    </div>
@endsection