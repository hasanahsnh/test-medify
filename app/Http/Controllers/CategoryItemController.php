<?php

namespace App\Http\Controllers;

use App\Models\CategoryItem;
use Illuminate\Http\Request;

class CategoryItemController extends Controller
{
    public function index() {
        return view('master_items.index.index-category-item');
    }

    public function search(Request $request) {
        $data = CategoryItem::query();
        if (!empty($request->kode)) $data->where('kode_kategori_item', 'LIKE', '%' . $request->kode . '%');
        if (!empty($request->nama)) $data->where('nama_kategori_item', 'LIKE', '%' . $request->nama . '%');

        return response()->json([
            'status' => 200,
            'data' => $data->get()
        ]);
    }

    public function formView($method, $id = 0) {
        if ($method == 'new') {
            $item = [];
        } else {
            $item = CategoryItem::find($id);
        }
        $data['item'] = $item;
        $data['method'] = $method;
        return view('master_items.single.category-item', $data);
    }

    public function singleView($kode) {
        $data['data'] = CategoryItem::where('kode_kategori_item', $kode)->firstOrFail();
        return view('master_items.single.category-item', $data);
    }

    public function formSubmit(Request $request, $method, $id = 0) {
        if ($method == 'new') {
            $data_item = new CategoryItem;
            $kode = CategoryItem::count('id');
            $kode = $kode + 1;
            $kode = str_pad($kode, 5, '0', STR_PAD_LEFT);
            sleep(3);
        } else {
            $data_item = CategoryItem::find($id);
            $kode = $data_item->kode;
        }

        $data_item->kode_kategori_item = $kode;
        $data_item->nama_kategori_item = $request->nama_kategori_item;

        $data_item->save();
        
        return redirect()->route('category');
    }

}
