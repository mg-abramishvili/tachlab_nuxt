<?php

namespace App\Http\Controllers\Admin;

use App\Models\Product;
use App\Models\TemporaryFile;
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
        return Product::with('categories')->find($id);
    }

    public function products_by_category($id)
    {
        return Product::whereRelation('categories', 'category_id', $id)->get();
    }

    public function add_image_store(Request $request) {
        if($request->hasFile('gallery')) {

            if($request->hasFile('gallery')) {
                $file = $request->file('gallery');
            }

            $filename = $file->getClientOriginalName();
            $folder = uniqid() . '-' . now()->timestamp;
            $file->move(public_path() . '/temp_uploads/' . $folder, $filename);

            TemporaryFile::create([
                'folder' => $folder,
                'filename' => $filename
            ]);

            return $folder;
        }

        return '';
    }
}
