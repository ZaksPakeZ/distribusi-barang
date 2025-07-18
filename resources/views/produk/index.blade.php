@extends('layouts.app')

@section('content')
<div class="bg-white p-6 rounded shadow">
    <div class="flex justify-between items-center mb-4">
        <h2 class="text-2xl font-bold">Daftar Produk</h2>
        <a href="{{ route('produk.create') }}" class="bg-blue-600 text-white px-4 py-2 rounded hover:bg-blue-700">
            + Tambah Produk
        </a>
    </div>

    @if(session('success'))
        <div class="bg-green-100 text-green-800 px-4 py-2 rounded mb-4">
            {{ session('success') }}
        </div>
    @endif

    <div class="overflow-x-auto">
        <table class="min-w-full border border-gray-300 text-sm">
            <thead class="bg-gray-200 text-left">
                <tr>
                    <th class="p-2 border">Nama</th>
                    <th class="p-2 border">Harga</th>
                    <th class="p-2 border">Deskripsi</th>
                    <th class="p-2 border text-center">Aksi</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($produk as $p)
                <tr class="hover:bg-gray-100">
                    <td class="p-2 border">{{ $p->name }}</td>
                    <td class="p-2 border">Rp {{ number_format($p->harga, 0, ',', '.') }}</td>
                    <td class="p-2 border">{{ $p->description }}</td>
                    <td class="p-2 border text-center space-x-2">
                        <a href="{{ route('produk.edit', $p->id) }}" class="bg-yellow-400 text-white px-2 py-1 rounded hover:bg-yellow-500">
                            Edit
                        </a>
                        <form action="{{ route('produk.destroy', $p->id) }}" method="POST" class="inline">
                            @csrf
                            @method('DELETE')
                            <button onclick="return confirm('Yakin ingin hapus produk ini?')" class="bg-red-600 text-white px-2 py-1 rounded hover:bg-red-700">
                                Hapus
                            </button>
                        </form>
                    </td>
                </tr>
                @endforeach

                @if($produk->count() === 0)
                <tr>
                    <td colspan="4" class="text-center p-4">Belum ada produk.</td>
                </tr>
                @endif
            </tbody>
        </table>
    </div>
</div>
@endsection
