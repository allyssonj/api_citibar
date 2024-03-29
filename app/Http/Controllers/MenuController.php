<?php

namespace App\Http\Controllers;

use App\Enums\Status;
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

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'status' => 'required',
        ]);

        $menu = Menu::create([
            'name' => $request->input('name'),
            'status' => $request->input('status', Status::ATIVO),
            'user_id' => auth()->id()
        ]);

        return response()->json([
            'message' => 'Menu created successfully'
        ]);
    }

    public function update(Request $request, int $id)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'status' => 'required',
        ]);

        $menu = Menu::findOrFail($id);
        $menu->name = $request->input('name');
        $menu->status = $request->input('status');
        $menu->save();

        return response()->json([
            'message' => 'Menu updated successfully'
        ]);
    }

    public function destroy(int $id)
    {
        $menu = Menu::findOrFail($id);
        $menu->delete();

        return response()->json([
            'message' => 'Menu deleted successfully'
        ]);
    }
}
