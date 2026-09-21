<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\MenuItem;
use App\Models\Order;
use App\Models\User;

class AdminDashboardController extends Controller
{
    public function index()
    {
        $totalMenuItems = MenuItem::count();

        $totalOrders = Order::count();

        $todayOrders = Order::whereDate('created_at', today())->count();

        $totalCustomers = User::where('role', 'customer')->count();

        $recentOrders = Order::with('user')
            ->latest()
            ->take(5)
            ->get();

        return view('admin.dashboard', compact(
            'totalMenuItems',
            'totalOrders',
            'todayOrders',
            'totalCustomers',
            'recentOrders'
        ));
    }
}