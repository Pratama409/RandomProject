<?php

namespace App\Http\Controllers;

use App\Models\Brand;
use Illuminate\View\View;

class HomeController extends Controller
{
    public function index(): View
    {
        $brands = Brand::query()
            ->where('is_active', true)
            ->orderByDesc('is_featured')
            ->orderBy('sort_order')
            ->orderBy('name')
            ->get([
                'id',
                'name',
                'slug',
                'country',
                'founded_year',
                'logo_path',
                'vehicle_lineup',
                'is_featured',
                'sort_order',
            ]);

        return view('home.home', compact('brands'));
    }
}
