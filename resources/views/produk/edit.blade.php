@extends('layouts.app')

@section('content')
<div class="bg-white p-6 rounded shadow max-w-xl mx-auto">
    <h2 class="text-xl font-bold mb-4">Edit Produk</h2>

    <form action="{{ route('produk.update', $produk->id) }}" method="POST" class="space-y-4">
        @csrf
        @method('PUT')

        <div>
            <label class="block font-semibold">Nama Produk</label>
            <input type="text" name="name" value="{{ $produk->name }}" class="w-full border p-2 rounded" required>
        </div>
        <div>
            <label class="block font-semibold">Harga</label>
            <input type="number" name="harga" value="{{ $produk->harga }}" class="w-full border p-2 rounded" required>
        </div>
        <div>
            <label class="block font-semibold">Deskripsi</label>
            <textarea name="description" class="w-full border p-2 rounded">{{ $produk->description }}</textarea>
        </div>

        <button type="submit" class="bg-blue-600 text-white px-4 py-2 rounded hover:bg-blue-700">Simpan</button>
    </form>
</div>
@endsection
