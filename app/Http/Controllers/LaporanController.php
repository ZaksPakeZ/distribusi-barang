<?php

namespace App\Http\Controllers;

use App\Models\BranchProductStock;

class LaporanController extends Controller
{
    public function stokAkhir()
    {
        $data = BranchProductStock::with('branch', 'product')->orderBy('branch_id')->get();
        return view('laporan.stok', compact('data'));
    }
}