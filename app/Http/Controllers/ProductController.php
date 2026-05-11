<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    public function index()
    {
        $products = Product::with('brand')->get();
        return response()->json($products, 200);
    }

    public function store(Request $request)
    {
        $request->validate([
            'name'          => 'required|string',
            'price'         => 'required|numeric',
            'warranty_years'=> 'required|integer',
            'brand_id'      => 'required|exists:brands,id',
        ]);

        $product = Product::create($request->all());
        return response()->json($product->load('brand'), 201);
    }

    public function show(string $id)
    {
        $product = Product::with('brand')->find($id);

        if (!$product) {
            return response()->json(['message' => 'Product not found'], 404);
        }

        return response()->json($product, 200);
    }

    public function update(Request $request, string $id)
    {
        $product = Product::find($id);

        if (!$product) {
            return response()->json(['message' => 'Product not found'], 404);
        }

        $product->update($request->all());
        return response()->json($product->load('brand'), 200);
    }

    public function destroy(string $id)
    {
        $product = Product::find($id);

        if (!$product) {
            return response()->json(['message' => 'Product not found'], 404);
        }

        $product->delete();
        return response()->json(['message' => 'Product deleted successfully'], 200);
    }
}