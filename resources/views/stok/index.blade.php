@extends('layouts.app')

@section('content')
<div class="bg-white p-6 rounded shadow">
    <div class="flex justify-between items-center mb-4">
        <h2 class="text-2xl font-bold">Stok Barang per Cabang</h2>
        <a href="{{ route('stok.create') }}" class="bg-blue-600 text-white px-4 py-2 rounded hover:bg-blue-700">
            + Tambah Stok
        </a>
    </div>

    @if(session('success'))
        <div class="bg-green-100 text-green-800 px-4 py-2 rounded mb-4">
            {{ session('success') }}
        </div>
    @endif

    <div class="overflow-x-auto">
        <table class="min-w-full border border-gray-300 text-sm">
            <thead class="bg-gray-100">
                <tr>
                    <th class="p-2 border text-left">Cabang</th>
                    <th class="p-2 border text-left">Produk</th>
                    <th class="p-2 border text-center">Stok</th>
                </tr>
            </thead>
            <tbody>
                @forelse ($data as $item)
                <tr class="hover:bg-gray-50">
                    <td class="p-2 border">{{ $item->branch->name }}</td>
                    <td class="p-2 border">{{ $item->product->name }}</td>
                    <td class="p-2 border text-center">{{ $item->stock }}</td>
                </tr>
                @empty
                <tr>
                    <td colspan="3" class="text-center p-4">Belum ada data stok.</td>
                </tr>
                @endforelse
            </tbody>
        </table>
    </div>
</div>
@endsection
