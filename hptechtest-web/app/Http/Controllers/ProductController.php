<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session; // Ini sebenarnya tidak digunakan untuk SweetAlert::toast, bisa dihapus jika tidak ada Session::flash() lain
use RealRashid\SweetAlert\Facades\Alert;
use Illuminate\Support\Str; // Digunakan untuk Str::random()

class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        try {
            $categories = Product::select('category')->distinct()->pluck('category')->toArray();

            $query = Product::query();

            if ($request->filled('search')) {
                $query->where('product_name', 'LIKE', "%{$request->search}%");
            }

            if ($request->filled('category') && $request->category !== 'all') {
                $query->where('category', $request->category);
            }

            $products = $query->paginate(10)->appends($request->all());

            return view('pages.private.products.index', compact('products', 'categories'));
        } catch (\Exception $e) {
            Alert::error('Error', 'An error occurred while loading products: ' . $e->getMessage());
            return redirect()->route('products.index');
        }
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $categories = Product::select('category')->distinct()->pluck('category')->toArray();
        return view('pages.private.products.create_edit', compact('categories'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'product_name' => 'required|string|max:255',
            'category' => 'required|string|max:255',
            'price' => 'required|numeric|min:0',
            'stock' => 'required|integer|min:0',
        ]);

        try {
            Product::create([
                'id' => Str::upper(Str::random(4)),
                'product_name' => $request->product_name,
                'category' => $request->category,
                'price' => $request->price,
                'stock' => $request->stock,
            ]);

            Alert::toast('Product successfully added!', 'success');
            return redirect()->route('products.index');
        } catch (\Exception $e) {
            Alert::toast('An error occurred while adding the product.', 'error');
            return redirect()->route('products.index')->withInput();
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(Product $product)
    {
        return response()->json($product);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Product $product)
    {
        $categories = Product::select('category')->distinct()->pluck('category')->toArray();

        return view('pages.private.products.create_edit', compact('product', 'categories'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Product $product)
    {
        $request->validate([
            'product_name' => 'required|string|max:255',
            'category' => 'required|string|max:255',
            'price' => 'required|numeric|min:0',
            'stock' => 'required|integer|min:0',
        ]);

        try {
            $product->update($request->all());

            Alert::toast('Product successfully updated!', 'success');
            return redirect()->route('products.index');
        } catch (\Exception $e) {
            Alert::toast('An error occurred while updating the product.', 'error');
            return redirect()->route('products.index')->withInput();
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Product $product)
    {
        try {
            $product->delete();
            Alert::toast('Product successfully deleted!', 'success');
        } catch (\Exception $e) {
            Alert::toast('An error occurred while deleting the product.', 'error');
            return redirect()->route('products.index');
        }
        return redirect()->route('products.index');
    }
}
