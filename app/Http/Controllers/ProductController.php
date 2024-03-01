<?php

namespace App\Http\Controllers;

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
}
