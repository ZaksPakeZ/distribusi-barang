@extends('layouts.app')

@section('content')
<div class="container mx-auto max-w-lg mt-10 bg-white p-6 rounded shadow">
    <h2 class="text-2xl font-bold mb-6 text-gray-800">Tambah / Update Stok Cabang</h2>

    <form action="{{ route('stok.store') }}" method="POST" class="space-y-4">
        @csrf
        
        <div>
            <label class="block mb-1 text-gray-700">Cabang</label>
            <select name="branch_id" required class="w-full border-gray-300 rounded px-3 py-2 focus:outline-none focus:ring focus:border-blue-500">
                <option value="">-- Pilih Cabang --</option>
                @foreach ($branches as $cabang)
                    <option value="{{ $cabang->id }}">{{ $cabang->name }}</option>
                @endforeach
            </select>
        </div>

        <div>
            <label class="block mb-1 text-gray-700">Produk</label>
            <select name="product_id" required class="w-full border-gray-300 rounded px-3 py-2 focus:outline-none focus:ring focus:border-blue-500">
                <option value="">-- Pilih Produk --</option>
                @foreach ($products as $produk)
                    <option value="{{ $produk->id }}">{{ $produk->name }}</option>
                @endforeach
            </select>
        </div>

        <div>
            <label class="block mb-1 text-gray-700">Jumlah Stok</label>
            <input type="number" name="stock" min="0" required class="w-full border-gray-300 rounded px-3 py-2 focus:outline-none focus:ring focus:border-blue-500">
        </div>

        <div class="flex justify-end">
            <button type="submit" class="bg-blue-600 text-white px-4 py-2 rounded hover:bg-blue-700 transition">Simpan</button>
        </div>
    </form>
</div>
@endsection
