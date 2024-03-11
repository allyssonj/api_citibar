<?php

namespace App\Http\Controllers;

use App\Enums\Status;
use App\Models\Product;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    public function index(Request $request)
    {
        $page = $request->query('page', 1);
        $perPage = $request->query('per_page', 10);

        $products = Product::with('categories')->paginate($perPage, '*', 'page', $page);

        return response()->json([
            'products' => $products
        ]);
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'description' => 'required|string',
            'price' => 'required',
            'status' => 'required|integer',
            'categories' => 'required|array'
        ]);

        //validate if categories is array of numbers
        $categories = $request->input('categories');

        foreach ($categories as $category) {
            if (!is_numeric($category)) {
                return response()->json([
                    'message' => 'Invalid category'
                ], 400);
            }
        }

        $product = Product::create([
            'name' => $request->input('name'),
            'description' => $request->input('description'),
            'price' => $request->input('price'),
            'status' => $request->input('status', Status::ATIVO),
            'user_id' => auth()->id()
        ]);

        $product->categories()->attach($request->input('categories'));

        return response()->json([
            'message' => 'Product created successfully'
        ]);
    }

    public function update(Request $request, int $id)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'description' => 'required|string',
            'price' => 'required',
            'categories' => 'required|array',
            'status' => 'required|integer'
        ]);

        //validate if categories is array of numbers
        $categories = $request->input('categories');

        foreach ($categories as $category) {
            if (!is_numeric($category)) {
                return response()->json([
                    'message' => 'Invalid category'
                ], 400);
            }
        }

        $product = Product::findOrFail($id);

        $product->update([
            'name' => $request->input('name'),
            'description' => $request->input('description'),
            'price' => $request->input('price'),
            'status' => $request->input('status', Status::ATIVO),
        ]);

        $product->categories()->sync($request->input('categories'));

        return response()->json([
            'message' => 'Product updated successfully'
        ]);
    }

    public function destroy(int $id)
    {
        $product = Product::findOrFail($id);
        $product->delete();

        return response()->json([
            'message' => 'Product deleted successfully'
        ]);
    }
}
