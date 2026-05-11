<?php

namespace App\Http\Controllers;

use App\Models\Brand;
use Illuminate\Http\Request;

class BrandController extends Controller
{
    public function index()
    {
        $brands = Brand::all();
        return response()->json($brands, 200);
    }

    public function store(Request $request)
    {
        $request->validate([
            'name'              => 'required|string',
            'country_of_origin' => 'required|string',
        ]);

        $brand = Brand::create($request->all());
        return response()->json($brand, 201);
    }

    public function show(string $id)
    {
        $brand = Brand::find($id);

        if (!$brand) {
            return response()->json(['message' => 'Brand not found'], 404);
        }

        return response()->json($brand, 200);
    }

    public function update(Request $request, string $id)
    {
        $brand = Brand::find($id);

        if (!$brand) {
            return response()->json(['message' => 'Brand not found'], 404);
        }

        $brand->update($request->all());
        return response()->json($brand, 200);
    }

    public function destroy(string $id)
    {
        $brand = Brand::find($id);

        if (!$brand) {
            return response()->json(['message' => 'Brand not found'], 404);
        }

        $brand->delete();
        return response()->json(['message' => 'Brand deleted successfully'], 200);
    }
}