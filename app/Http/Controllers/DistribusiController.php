<?php

namespace App\Http\Controllers;

use App\Models\Branch;
use App\Models\Product;
use App\Models\BranchProductStock;
use App\Models\Transaction;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use RealRashid\SweetAlert\Facades\Alert;

class DistribusiController extends Controller
{
    public function index()
    {
        $data = Transaction::with('product', 'fromBranch', 'toBranch')->latest()->get();
        return view('distribusi.index', compact('data'));
    }

    public function create()
    {
        $branches = Branch::all();
        $products = Product::all();
        return view('distribusi.create', compact('branches', 'products'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'from_branch_id' => 'required',
            'to_branch_id' => 'required|different:from_branch_id',
            'product_id' => 'required',
            'quantity' => 'required|numeric|min:1',
            'keterangan' => 'nullable'
        ]);

        DB::transaction(function () use ($request) {
            $fromStock = BranchProductStock::where([
                'branch_id' => $request->from_branch_id,
                'product_id' => $request->product_id,
            ])->first();

            if (!$fromStock || $fromStock->stock < $request->quantity) {
                abort(400, 'Stok tidak cukup di cabang asal!');
            }

            $fromStock->decrement('stock', $request->quantity);

            $toStock = BranchProductStock::firstOrCreate(
                [
                    'branch_id' => $request->to_branch_id,
                    'product_id' => $request->product_id,
                ],
                ['stock' => 0]
            );
            $toStock->increment('stock', $request->quantity);

            Transaction::create([
                'from_branch_id' => $request->from_branch_id,
                'to_branch_id' => $request->to_branch_id,
                'product_id' => $request->product_id,
                'quantity' => $request->quantity,
                'keterangan' => $request->keterangan,
                'tanggal' => now(),
            ]);
        });
        Alert::success('Berhasil', 'Distribusi berhasil dicatat');
        return redirect()->route('distribusi.index')->with('success', 'Distribusi berhasil dicatat');
    }

    public function createCabang()
    {
        $branches = Branch::all();
        $products = Product::all();
        return view('cabang.distribusi_create', compact('branches', 'products'));
    }

    public function storeCabang(Request $request)
    {
        $request->validate([
            'to_branch_id' => 'required',
            'product_id' => 'required',
            'quantity' => 'required|numeric|min:1',
        ]);

        $user = Auth::user();
        $fromBranchId = ($user && $user->role === 'cabang1') ? 1 : 2;

        Transaction::create([
            'from_branch_id' => $fromBranchId,
            'to_branch_id' => $request->to_branch_id,
            'product_id' => $request->product_id,
            'quantity' => $request->quantity,
            'keterangan' => 'Menunggu konfirmasi',
            'tanggal' => now(),
        ]);
        
     Alert::success('Berhasil', 'Pengiriman berhasil dibuat.');
        return redirect('/cabang/dashboard');
    }

    public function konfirmasiIndex()
    {
        $user = Auth::user();
        $cabangId = ($user && $user->role === 'cabang1') ? 1 : 2;

        $transactions = Transaction::where('to_branch_id', $cabangId)
            ->where('keterangan', 'Menunggu konfirmasi')
            ->get();

        return view('cabang.konfirmasi', compact('transactions'));
    }

    public function konfirmasiStore($id)
    {
        $trx = Transaction::findOrFail($id);
        $trx->update(['keterangan' => 'Sudah dikonfirmasi']);

        $stok = BranchProductStock::firstOrCreate(
            ['branch_id' => $trx->to_branch_id, 'product_id' => $trx->product_id],
            ['stock' => 0]
        );
        $stok->increment('stock', $trx->quantity);

        Alert::success('Berhasil', 'Barang berhasil dikonfirmasi.');
        return back()->with('success', 'Barang berhasil dikonfirmasi.');
    }
}
