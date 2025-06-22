<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class CatalogController extends Controller
{
    public function getProducts(Request $request)
    {
        $query = DB::table('products')->where('qty', '>', 0);
        $categories = DB::table('categories')->get();
        $params = collect($request->query());

        // Добавляем поиск по названию товара
        if ($request->has('search')) {
            $searchTerm = $request->get('search');
            $query->where('title', 'LIKE', "%{$searchTerm}%");
        }

        // Получаем подкатегории, если выбрана категория
        $subcategories = [];
        if ($params->get('filter')) {
            $subcategories = DB::table('subcategories')
                ->where('category_id', $params->get('filter'))
                ->get();
        }

        $products = $query->get();

        if ($params->get('sort_by')) {
            $products = $products->sortBy($params->get('sort_by'));
        }
        if ($params->get('sort_by_desc')) {
            $products = $products->sortByDesc($params->get('sort_by_desc'));
        }
        if ($params->get('filter')) {
            $products = $products->where('product_type', $params->get('filter'));
        }
        if ($params->get('subcategory')) {
            $products = $products->where('subcategory_id', $params->get('subcategory'));
        }

        return view('catalog', [
            'products' => $products, 
            'categories' => $categories,
            'subcategories' => $subcategories,
            'params' => $params
        ]);
    }

    public function liveSearch(Request $request)
    {
        $search = $request->get('search');
        
        if (strlen($search) < 2) {
            return response()->json([]);
        }

        $products = DB::table('products')
            ->where('qty', '>', 0)
            ->where('title', 'LIKE', "%{$search}%")
            ->select('id', 'title', 'price')
            ->limit(5)
            ->get();

        return response()->json($products);
    }
}
