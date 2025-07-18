@extends('layouts.app')

@section('content')
<div class="bg-white p-6 rounded shadow">
    <h2 class="text-xl font-bold mb-4">Riwayat Distribusi Barang</h2>
    <a href="{{ route('distribusi.create') }}" class="bg-green-600 text-white px-3 py-2 rounded hover:bg-green-700">+ Distribusi Baru</a>

    @if(session('success'))
        <p class="mt-4 text-green-600">{{ session('success') }}</p>
    @endif

    <table class="mt-4 w-full border-collapse border border-gray-300">
        <thead>
            <tr class="bg-gray-200">
                <th class="border p-2">Tanggal</th>
                <th class="border p-2">Produk</th>
                <th class="border p-2">Dari</th>
                <th class="border p-2">Ke</th>
                <th class="border p-2">Jumlah</th>
                <th class="border p-2">Keterangan</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($data as $d)
                <tr>
                    <td class="border p-2">{{ $d->tanggal }}</td>
                    <td class="border p-2">{{ $d->product->name }}</td>
                    <td class="border p-2">{{ $d->fromBranch->name }}</td>
                    <td class="border p-2">{{ $d->toBranch->name }}</td>
                    <td class="border p-2">{{ $d->quantity }}</td>
                    <td class="border p-2">{{ $d->keterangan }}</td>
                </tr>
            @endforeach
        </tbody>
    </table>
</div>
@endsection
