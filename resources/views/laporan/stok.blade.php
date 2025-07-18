@extends('layouts.app')

@section('content')
<div class="bg-white p-6 rounded shadow">
    <h2 class="text-xl font-bold mb-4">Laporan Stok Akhir per Cabang</h2>

    <table class="w-full border-collapse border border-gray-300">
        <thead>
            <tr class="bg-gray-200">
                <th class="border p-2">Cabang</th>
                <th class="border p-2">Produk</th>
                <th class="border p-2">Stok Akhir</th>
            </tr>
        </thead>
        <tbody>
            @forelse ($data as $item)
                <tr>
                    <td class="border p-2">{{ $item->branch->name }}</td>
                    <td class="border p-2">{{ $item->product->name }}</td>
                    <td class="border p-2">{{ $item->stock }}</td>
                </tr>
            @empty
                <tr>
                    <td colspan="3" class="text-center p-4">Belum ada data stok.</td>
                </tr>
            @endforelse
        </tbody>
    </table>
</div>
@endsection
