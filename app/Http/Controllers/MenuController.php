<?php

namespace App\Http\Controllers;

use App\Models\Menu;
use Illuminate\Http\Request;

class MenuController extends Controller
{
    public function index(Request $request)
    {
        $page = $request->query('page', 1);
        $perPage = $request->query('per_page', 10);

        $menus = Menu::with('products')->paginate($perPage, '*', 'page', $page);

        return response()->json([
            'menus' => $menus
        ]);
    }
}
