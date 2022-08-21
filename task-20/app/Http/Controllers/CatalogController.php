<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\Service;

class CatalogController extends Controller
{

    public function index()
    {
        $categories = Product::all('type')->unique('type');

        return view('catalog')
            ->with(compact('categories'));
    }

    public function show(string $category)
    {
        $products = Product::query()->where('type', $category)->get();

        $services = Service::all();

        return view('category')
            ->with(compact('products'))
            ->with(compact('services'));
    }

}
