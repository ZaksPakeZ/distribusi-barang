@extends('layouts.app')

@section('content')
<div class="container mx-auto max-w-7xl mt-6">
    <div class="bg-white p-6 rounded shadow">
        <h2 class="text-2xl font-bold mb-6 text-gray-800">Dashboard Admin</h2>

        <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-6">
            <div class="bg-blue-600 text-white p-5 rounded-lg shadow hover:scale-[1.02] transition">
                <h3 class="text-lg font-semibold">Total Produk</h3>
                <p class="text-3xl mt-2">{{ \App\Models\Product::count() }}</p>
            </div>
            <div class="bg-green-600 text-white p-5 rounded-lg shadow hover:scale-[1.02] transition">
                <h3 class="text-lg font-semibold">Total Cabang</h3>
                <p class="text-3xl mt-2">{{ \App\Models\Branch::count() }}</p>
            </div>
            <div class="bg-yellow-500 text-white p-5 rounded-lg shadow hover:scale-[1.02] transition">
                <h3 class="text-lg font-semibold">Total Transaksi</h3>
                <p class="text-3xl mt-2">{{ \App\Models\Transaction::count() }}</p>
            </div>
            <div class="bg-purple-600 text-white p-5 rounded-lg shadow hover:scale-[1.02] transition">
                <h3 class="text-lg font-semibold">Total Stok</h3>
                <p class="text-3xl mt-2">{{ \App\Models\BranchProductStock::sum('stock') }}</p>
            </div>
        </div>

        <div class="mt-10">
            <h3 class="text-xl font-semibold mb-4 text-gray-800">Top 5 Stok Terbanyak</h3>
            <div class="overflow-x-auto">
                <table class="min-w-full border border-gray-300 text-sm">
                    <thead>
                        <tr class="bg-gray-100 text-gray-700">
                            <th class="border p-3 text-left">Cabang</th>
                            <th class="border p-3 text-left">Produk</th>
                            <th class="border p-3 text-left">Jumlah Stok</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach (\App\Models\BranchProductStock::with('branch', 'product')->orderByDesc('stock')->take(5)->get() as $stok)
                        <tr class="hover:bg-gray-50">
                            <td class="border p-3">{{ $stok->branch->name }}</td>
                            <td class="border p-3">{{ $stok->product->name }}</td>
                            <td class="border p-3 font-semibold text-right">{{ $stok->stock }}</td>
                        </tr>
                        @endforeach
                        @if(\App\Models\BranchProductStock::count() == 0)
                        <tr>
                            <td colspan="3" class="border p-3 text-center text-gray-500">Data stok belum tersedia.</td>
                        </tr>
                        @endif
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
@endsection
