<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Brand;
use App\Models\Car;
use App\Models\Category;
use Illuminate\Contracts\View\View;

class DashboardController extends Controller
{
    public function index(): View
    {
        $totalCars = Car::query()->count();
        $activeCars = Car::query()->where('is_active', true)->count();

        return view('admin.dashboard', [
            'totalCars' => $totalCars,
            'activeCars' => $activeCars,
            'hiddenCars' => max(0, $totalCars - $activeCars),
            'featuredCars' => Car::query()->where('is_featured', true)->count(),
            'brandsCount' => Brand::query()->count(),
            'categoriesCount' => Category::query()->count(),
            'recentCars' => Car::query()
                ->with('brand:id,name')
                ->latest('updated_at')
                ->limit(6)
                ->get(),
        ]);
    }
}