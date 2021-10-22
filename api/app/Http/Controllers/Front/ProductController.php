<?php

namespace App\Http\Controllers\Front;

use App\Models\Product;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    public function index()
    {
        return Product::with('categories')->get();
    }

    public function product_item($id)
    {
        return Product::find($id);
    }

    public function products_by_category($id)
    {
        return Product::whereRelation('categories', 'category_id', $id)->get();
    }
}
