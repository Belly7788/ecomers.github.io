<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\Brand;
use App\Models\Category;
use App\Models\Color;
use App\Models\Size;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class ProductController extends Controller
{
    // Display list of products for admin
    public function index()
    {
        $products = Product::with(['brand', 'category', 'user'])->get();
        return view('Pages.Product.list_product', compact('products'));
    }

    // Show add product form
    public function create()
    {
        $brands = Brand::where('status', 1)->get();
        $categories = Category::where('status', 1)->get();
        $colors = Color::where('status', 1)->get();
        $sizes = Size::where('status', 1)->get();
        return view('Pages.Product.add_product', compact('brands', 'categories', 'colors', 'sizes'));
    }

    // Store new product
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:100',
            'regular_price' => 'required|numeric',
            'discount' => 'nullable|numeric',
            'category_id' => 'required|exists:categories,id',
            'brand_id' => 'nullable|exists:brands,id',
            'description' => 'nullable|string',
            'thumbnail' => 'required|image|mimes:jpeg,png,jpg|max:2048',
            'color_id' => 'nullable|array',
            'color_id.*' => 'exists:colors,id',
            'size_id' => 'nullable|array',
            'size_id.*' => 'exists:sizes,id',
            'stock' => 'required|integer|min:0',
        ]);

        $data = $request->all();
        $data['create_by'] = Auth::id();

        // Convert color_id and size_id arrays to comma-separated strings
        $data['color_id'] = $request->color_id ? implode(',', $request->color_id) : null;
        $data['size_id'] = $request->size_id ? implode(',', $request->size_id) : null;

        // Handle thumbnail upload
        if ($request->hasFile('thumbnail')) {
            $data['thumbnail'] = $request->file('thumbnail')->store('products', 'public');
        }

        Product::create($data);

        return redirect()->route('product.list')->with('message', 'Product added successfully!');
    }

    // Show edit product form
    public function edit($id)
    {
        $product = Product::findOrFail($id);
        $brands = Brand::where('status', 1)->get();
        $categories = Category::where('status', 1)->get();
        $colors = Color::where('status', 1)->get();
        $sizes = Size::where('status', 1)->get();
        return view('Pages.Product.edit_product', compact('product', 'brands', 'categories', 'colors', 'sizes'));
    }

    // Update product
    public function update(Request $request, $id)
    {
        $product = Product::findOrFail($id);

        $request->validate([
            'name' => 'required|string|max:100',
            'regular_price' => 'required|numeric',
            'discount' => 'nullable|numeric',
            'category_id' => 'required|exists:categories,id',
            'brand_id' => 'nullable|exists:brands,id',
            'description' => 'nullable|string',
            'thumbnail' => 'nullable|image|mimes:jpeg,png,jpg|max:2048',
            'color_id' => 'nullable|array',
            'color_id.*' => 'exists:colors,id',
            'size_id' => 'nullable|array',
            'size_id.*' => 'exists:sizes,id',
            'stock' => 'required|integer|min:0',
        ]);

        $data = $request->all();

        // Convert color_id and size_id arrays to comma-separated strings
        $data['color_id'] = $request->color_id ? implode(',', $request->color_id) : null;
        $data['size_id'] = $request->size_id ? implode(',', $request->size_id) : null;

        // Handle thumbnail upload
        if ($request->hasFile('thumbnail')) {
            // Delete old thumbnail
            if ($product->thumbnail) {
                Storage::disk('public')->delete($product->thumbnail);
            }
            $data['thumbnail'] = $request->file('thumbnail')->store('products', 'public');
        }

        $product->update($data);

        return redirect()->route('product.list')->with('message', 'Product updated successfully!');
    }

    // Delete product
    public function destroy($id)
    {
        $product = Product::findOrFail($id);

        // Delete thumbnail
        if ($product->thumbnail) {
            Storage::disk('public')->delete($product->thumbnail);
        }

        $product->delete();

        return redirect()->route('product.list')->with('message', 'Product deleted successfully!');
    }

    // Fetch products for front-end
    public function getFrontEndProducts()
    {
        // Fetch new products (e.g., latest 4 products)
        $newProducts = Product::where('status', 1)
            ->orderBy('created_at', 'desc')
            ->take(4)
            ->get();

        // Fetch promotion products (e.g., products with a discount)
        $promotionProducts = Product::where('status', 1)
            ->whereNotNull('discount')
            ->where('discount', '>', 0)
            ->take(4)
            ->get();

        // Fetch popular products (e.g., based on stock or a custom 'popularity' field)
        $popularProducts = Product::where('status', 1)
            ->orderBy('stock', 'desc')
            ->take(4)
            ->get();

        return view('front-end.index', compact('newProducts', 'promotionProducts', 'popularProducts'));
    }

    // Show product detail page
    public function show($id)
    {
        $product = Product::with(['brand', 'category'])->findOrFail($id);
        return view('front-end.news-detail', compact('product'));
    }

    public function shop(Request $request)
{
    $query = Product::where('status', 1);

    // Filter by category
    if ($request->has('cat')) {
        $query->whereHas('category', function ($q) use ($request) {
            $q->where('name', $request->cat);
        });
    }

    // Filter by price (max or min)
    if ($request->has('price')) {
        $query->orderBy('regular_price', $request->price === 'max' ? 'desc' : 'asc');
    }

    // Filter by promotion
    if ($request->has('promotion') && $request->promotion === 'true') {
        $query->whereNotNull('discount')->where('discount', '>', 0);
    }

    // Search by product name
    if ($request->has('s')) {
        $query->where('name', 'like', '%' . $request->s . '%');
    }

    // Paginate results (e.g., 9 products per page)
    $products = $query->paginate(9);

    // Fetch categories for the filter sidebar
    $categories = Category::where('status', 1)->get();

    return view('front-end.shop', compact('products', 'categories'));
}

    public function getNewsProducts()
    {
        $newsProducts = Product::where('status', 1)
            ->orderBy('created_at', 'desc')
            ->paginate(8);
        return view('front-end.news', compact('newsProducts'));
    }

    public function search(Request $request)
    {
        $searchQuery = $request->input('s', '');

        // Fetch products matching the search query
        $products = Product::where('status', 1)
            ->where('name', 'like', '%' . $searchQuery . '%')
            ->orWhere('description', 'like', '%' . $searchQuery . '%')
            ->paginate(8);

        // Optionally fetch news products (e.g., latest products) for the "News Result" section
        $newsProducts = Product::where('status', 1)
            ->orderBy('created_at', 'desc')
            ->take(4)
            ->get();

        return view('front-end.search', compact('products', 'newsProducts', 'searchQuery'));
    }


}
