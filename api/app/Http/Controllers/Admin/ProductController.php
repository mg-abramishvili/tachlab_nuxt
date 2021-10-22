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

    public function file($type)
    {
        switch ($type) {
            case 'upload':
                return $this->upload();
        }

        return \Response::make('success', 200, [
            'Content-Disposition' => 'inline',
        ]);
    }

    public function upload()
    {
        if (request()->file('gallery')) {
            $file1 = request()->file('gallery');
            for ($i = 0; $i < count($file1); $i++) {
                $file = $file1[$i];
                $filename = md5(time() . rand(1, 100000)) . '.' . $file->getClientOriginalExtension();
                $file->move(public_path() . '/uploads', $filename);

                return \Response::make('/uploads/' . $filename, 200, [
                    'Content-Disposition' => 'inline',
                ]);
            }
        }
    }

    public function product_update($id, Request $request) {
        $data = request()->all();
        $product = Product::find($id);

        $product->name = $data['name'];
        $product->price = $data['price'];
        $product->description = $data['description'];

        if (!isset($data['gallery'])) {
            $data['gallery'] = [];
        }
        $product->gallery = $data['gallery'];

        $product->save();
    }
}
