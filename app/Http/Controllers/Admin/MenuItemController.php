<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\MenuItem;
use App\Models\Category;
use Illuminate\Http\Request;

class MenuItemController extends Controller
{
    public function index()
    {
        $menuItems = MenuItem::with('category')
            ->latest()
            ->get();

        return view('admin.menu-items.index', compact('menuItems'));
    }

    public function create()
    {
        $categories = Category::all();

        return view('admin.menu-items.create', compact('categories'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'description' => 'required|string',
            'price' => 'required|numeric|min:0',
            'image' => 'required|string',
            'category_id' => 'required|exists:categories,id',
        ]);

        MenuItem::create($validated);

        return redirect()
            ->route('menu-items.index')
            ->with('success', 'Dish added successfully.');
    }

    public function edit(MenuItem $menu_item)
    {
        $categories = Category::all();

        return view('admin.menu-items.edit', [
            'menuItem' => $menu_item,
            'categories' => $categories
        ]);
    }

    public function update(Request $request, MenuItem $menu_item)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'description' => 'required|string',
            'price' => 'required|numeric|min:0',
            'image' => 'required|string',
            'category_id' => 'required|exists:categories,id',
        ]);

        $menu_item->update($validated);

        return redirect()
            ->route('menu-items.index')
            ->with('success', 'Dish updated successfully.');
    }

    public function destroy(MenuItem $menu_item)
    {
        $menu_item->delete();

        return redirect()
            ->route('menu-items.index')
            ->with('success', 'Dish deleted successfully.');
    }
}