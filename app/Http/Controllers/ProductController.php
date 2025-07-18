<?php

namespace App\Http\Controllers;
use App\Models\Product;
use Illuminate\Http\Request;
use RealRashid\SweetAlert\Facades\Alert;

class ProductController extends Controller
{
    public function index()
    {
        $produk = Product::all();
        return view('produk.index', compact('produk'));
    }

    public function create()
    {
        return view('produk.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required',
            'harga' => 'required|numeric',
            'description' => 'nullable'
        ]);

        Product::create([
            'name' => $request->name,
            'harga' => $request->harga,
            'description' => $request->description
        ]);
       Alert::success('berhasil','Produk berhasil ditambahkan');
        return redirect()->route('produk.index');
    }
    public function edit($id)
{
    $produk = Product::findOrFail($id);
    return view('produk.edit', compact('produk'));
}

public function update(Request $request, $id)
{
    $request->validate([
        'name' => 'required',
        'harga' => 'required|numeric',
        'description' => 'nullable'
    ]);

    $produk = Product::findOrFail($id);
    $produk->update($request->only('name', 'harga', 'description'));
    Alert::success('berhasil','Produk berhasil diupdate');
    return redirect()->route('produk.index');
}

public function destroy($id)
{
    $produk = Product::findOrFail($id);
    $produk->delete();
    
    Alert::success('berhasil','Produk berhasil dihapus');
    return redirect()->route('produk.index');
}
}
