@extends('layouts.app')

@section('content')
<div class="bg-white p-6 rounded shadow">
    <h2 class="text-xl font-bold mb-4">Distribusi Barang</h2>
    <form action="{{ route('distribusi.store') }}" method="POST" class="space-y-4">
        @csrf
        <div>
            <label class="block font-semibold">Cabang Asal</label>
            <select name="from_branch_id" required class="w-full border p-2 rounded">
                @foreach ($branches as $branch)
                    <option value="{{ $branch->id }}">{{ $branch->name }}</option>
                @endforeach 
            </select>
        </div>
        <div>
            <label class="block font-semibold">Cabang Tujuan</label>
            <select name="to_branch_id" required class="w-full border p-2 rounded">
                @foreach ($branches as $branch)
                    <option value="{{ $branch->id }}">{{ $branch->name }}</option>
                @endforeach
            </select>
        </div>
        <div>
            <label class="block font-semibold">Produk</label>
            <select name="product_id" required class="w-full border p-2 rounded">
                @foreach ($products as $product)
                    <option value="{{ $product->id }}">{{ $product->name }}</option>
                @endforeach
            </select>
        </div>
        <div>
            <label class="block font-semibold">Jumlah</label>
            <input type="number" name="quantity" min="1" class="w-full border p-2 rounded">
        </div>
        <div>
            <label class="block font-semibold">Keterangan (Opsional)</label>
            <textarea name="keterangan" class="w-full border p-2 rounded"></textarea>
        </div>
        <button type="submit" class="bg-blue-600 text-white px-4 py-2 rounded hover:bg-blue-700">Kirim Barang</button>
    </form>
</div>
@endsection
