<?php

namespace AppHttpControllers;

use AppModelsBrand;
use IlluminateViewView;

class HomeController extends Controller
{
    public function index(): View
    {
        $brands = Brand::query()
            ->where('is_active', true)
            ->orderBy('name')
            ->get([
                'id',
                'name',
                'slug',
                'country',
                'founded_year',
                'logo_path',
                'vehicle_lineup',
            ]);

        return view('home.home', compact('brands'));
    }
}
