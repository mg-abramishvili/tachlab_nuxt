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
        $product = Product::with('categories')->find($id);
        return response()->json([
            'product' => $product,
            'gallery' => $product->getMedia(),
        ]);
    }

    public function products_by_category($id)
    {
        return Product::whereRelation('categories', 'category_id', $id)->get();
    }

    public function product_update($id, Request $request) {
        $data = request()->all();
        $product = Product::find($id);

        $file1 = request()->input('gallery');
        for ($i = 0; $i < count($file1); $i++) {
            $file = $file1[$i];
            if(TemporaryFile::where('folder', $file)->first()) {
                $temp_file = TemporaryFile::where('folder', $file)->first();
                $url = public_path() . '/temp_uploads/' . $temp_file->folder . '/' . $temp_file->filename;
                $product->addMedia($url)->toMediaCollection();
                unlink($url);
                rmdir(public_path('temp_uploads/' . $temp_file->folder));
                $temp_file->delete();
            }
        }

        $product->save();
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
