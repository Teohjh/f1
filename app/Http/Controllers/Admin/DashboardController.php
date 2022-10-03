<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Product;
use App\Models\Consumer;

class DashboardController extends Controller
{
    public function index()
    {
        $products = Product::count();
        $consumers = Consumer::count();
        $product_shown = Product::where('product_status','Shown')->count();

        return view('admin.admin_dashboard', compact('products','product_shown','consumers'));
    }
}
