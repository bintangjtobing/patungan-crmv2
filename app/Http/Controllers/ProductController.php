<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;
use CloudinaryLabs\CloudinaryLaravel\Facades\Cloudinary;

class ProductController extends Controller
{
    /**
     * Display a listing of the products.
     */
    public function index()
    {
        $products = Product::ordered()->get();
        notify()->success('Product list loaded successfully!');
        return view('dashboard.products.index', compact('products'));
    }

    /**
     * Show the form for creating a new product.
     */
    public function create()
    {
        notify()->info('Ready to create a new product.');
        return view('dashboard.products.create');
    }

    /**
     * Store a newly created product in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'nama' => 'required|string|max:255',
            'harga_jual' => 'required|integer',
            'harga_beli' => 'required|integer',
            'type' => 'required|string|max:255',
            'description' => 'nullable|string',
            'url_image' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
        ]);

        $data = $request->only(['nama', 'harga_jual', 'harga_beli', 'type', 'description']);

        // Handle image upload if provided
        if ($request->hasFile('url_image')) {
            $uploadedFileUrl = Cloudinary::upload($request->file('url_image')->getRealPath())->getSecurePath();
            $data['url_image'] = $uploadedFileUrl;
        }

        Product::create($data);

        notify()->success('Product created successfully!');
        return redirect()->route('products.index')->with('success', 'Product created successfully.');
    }

    /**
     * Show the form for editing the specified product.
     */
    public function edit(Product $product)
    {
        notify()->info('You are editing the product: ' . $product->nama);
        return view('dashboard.products.edit', compact('product'));
    }

    /**
     * Update the specified product in storage.
     */
    public function update(Request $request, Product $product)
    {
        $request->validate([
            'nama' => 'required|string|max:255',
            'harga_jual' => 'required|integer',
            'harga_beli' => 'required|integer',
            'type' => 'required|string|max:255',
            'description' => 'nullable|string',
            'url_image' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
        ]);

        $data = $request->only(['nama', 'harga_jual', 'harga_beli', 'type', 'description']);

        // Handle image upload if provided
        if ($request->hasFile('url_image')) {
            // Delete the old image from Cloudinary if it exists
            if ($product->url_image) {
                $publicId = basename($product->url_image, '.' . pathinfo($product->url_image, PATHINFO_EXTENSION));
                Cloudinary::destroy($publicId);
            }

            $uploadedFileUrl = Cloudinary::upload($request->file('url_image')->getRealPath())->getSecurePath();
            $data['url_image'] = $uploadedFileUrl;
        }

        $product->update($data);

        notify()->success('Product updated successfully!');
        return redirect()->route('products.index')->with('success', 'Product updated successfully.');
    }

    /**
     * Remove the specified product from storage.
     */
    public function destroy(Product $product)
    {
        // Delete image from Cloudinary if it exists
        if ($product->url_image) {
            $publicId = basename($product->url_image, '.' . pathinfo($product->url_image, PATHINFO_EXTENSION));
            Cloudinary::destroy($publicId);
        }

        $product->delete();

        notify()->success('Product deleted successfully!');
        return redirect()->route('products.index')->with('success', 'Product deleted successfully.');
    }
}