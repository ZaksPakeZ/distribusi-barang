<?php

namespace App\Http\Controllers;
use App\Models\Branch;
use App\Models\Product;
use App\Models\BranchProductStock;
use Illuminate\Http\Request;
use RealRashid\SweetAlert\Facades\Alert;



class StokController extends Controller
{
    public function index()
    {
        $data = BranchProductStock::with('branch', 'product')->get();
        return view('stok.index', compact('data'));
    }

    public function create()
    {
        $branches = Branch::all();
        $products = Product::all();
        return view('stok.create', compact('branches', 'products'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'branch_id' => 'required',
            'product_id' => 'required',
            'stock' => 'required|numeric|min:0'
        ]);

        // Kalau udah ada, update aja
        $stok = BranchProductStock::updateOrCreate(
            [
                'branch_id' => $request->branch_id,
                'product_id' => $request->product_id
            ],
            [
                'stock' => $request->stock
            ]
        );
        
        Alert::success('Berhasil', 'Stok berhasil ditambahkan / diupdate');
        return redirect()->route('stok.index');
    }
}
