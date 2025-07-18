@extends('layouts.app')

@section('content')
<div class="container mx-auto max-w-lg mt-10 bg-white p-6 rounded shadow">
    <h2 class="text-2xl font-bold mb-6 text-gray-800">Tambah Produk</h2>

    <form action="{{ route('produk.store') }}" method="POST" class="space-y-4">
        @csrf
        
        <div>
            <label class="block mb-1 text-gray-700">Nama Produk</label>
            <input type="text" name="name" required 
                class="w-full border-gray-300 rounded px-3 py-2 focus:outline-none focus:ring focus:border-blue-500">
        </div>

        <div>
            <label class="block mb-1 text-gray-700">Harga</label>
            <input type="number" name="harga" required min="0"
                class="w-full border-gray-300 rounded px-3 py-2 focus:outline-none focus:ring focus:border-blue-500">
        </div>

        <div>
            <label class="block mb-1 text-gray-700">Deskripsi</label>
            <textarea name="description" rows="4"
                class="w-full border-gray-300 rounded px-3 py-2 focus:outline-none focus:ring focus:border-blue-500"></textarea>
        </div>

        <div class="flex justify-end">
            <button type="submit"
                class="bg-blue-600 text-white px-4 py-2 rounded hover:bg-blue-700 transition">
                Simpan
            </button>
        </div>
    </form>
</div>
@endsection
