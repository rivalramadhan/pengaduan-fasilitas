
@extends('layouts.admin')

@section('title', 'Manage Fasilitas')

@section('header', 'Manage Fasilitas')

@section('content')
    <div class="mb-4 flex justify-end">
        <a href="#" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded">
            + Tambah Fasilitas
        </a>
    </div>
    <div class="bg-white shadow-md rounded-lg overflow-x-auto">
        <table class="min-w-full leading-normal">
            <thead>
                <tr>
                    <th class="px-5 py-3 border-b-2 border-gray-200 bg-gray-100 text-left text-xs font-semibold text-gray-700 uppercase tracking-wider">Nama Fasilitas</th>
                    <th class="px-5 py-3 border-b-2 border-gray-200 bg-gray-100 text-left text-xs font-semibold text-gray-700 uppercase tracking-wider">Kategori</th>
                    <th class="px-5 py-3 border-b-2 border-gray-200 bg-gray-100 text-left text-xs font-semibold text-gray-700 uppercase tracking-wider">Lokasi</th>
                    <th class="px-5 py-3 border-b-2 border-gray-200 bg-gray-100 text-left text-xs font-semibold text-gray-700 uppercase tracking-wider">Status</th>
                    <th class="px-5 py-3 border-b-2 border-gray-200 bg-gray-100 text-left text-xs font-semibold text-gray-700 uppercase tracking-wider">Actions</th>
                </tr>
            </thead>
            <tbody>
                {{-- Contoh Data Baris 1 --}}
                <tr>
                    <td class="px-5 py-4 border-b border-gray-200 bg-white text-sm">Jalan Raya Desa Makmur</td>
                    <td class="px-5 py-4 border-b border-gray-200 bg-white text-sm">Infrastruktur</td>
                    <td class="px-5 py-4 border-b border-gray-200 bg-white text-sm">RT 01 / RW 02</td>
                    <td class="px-5 py-4 border-b border-gray-200 bg-white text-sm">
                        <span class="relative inline-block px-3 py-1 font-semibold text-green-900 bg-green-200 leading-tight rounded-full">Baik</span>
                    </td>
                    <td class="px-5 py-4 border-b border-gray-200 bg-white text-sm">
                        <a href="#" class="text-indigo-600 hover:text-indigo-900">Edit</a>
                        <a href="#" class="text-red-600 hover:text-red-900 ml-4">Delete</a>
                    </td>
                </tr>
                {{-- Contoh Data Baris 2 --}}
                <tr>
                    <td class="px-5 py-4 border-b border-gray-200 bg-white text-sm">Lampu Penerangan Jalan</td>
                    <td class="px-5 py-4 border-b border-gray-200 bg-white text-sm">Penerangan</td>
                    <td class="px-5 py-4 border-b border-gray-200 bg-white text-sm">Depan Balai Desa</td>
                    <td class="px-5 py-4 border-b border-gray-200 bg-white text-sm">
                        <span class="relative inline-block px-3 py-1 font-semibold text-red-900 bg-red-200 leading-tight rounded-full">Rusak</span>
                    </td>
                    <td class="px-5 py-4 border-b border-gray-200 bg-white text-sm">
                        <a href="#" class="text-indigo-600 hover:text-indigo-900">Edit</a>
                        <a href="#" class="text-red-600 hover:text-red-900 ml-4">Delete</a>
                    </td>
                </tr>
                 {{-- Jika tidak ada data --}}
                {{-- 
                @forelse ($fasilitas as $item)
                    ...
                @empty
                    <tr>
                        <td colspan="5" class="text-center py-10">Data fasilitas tidak ditemukan.</td>
                    </tr>
                @endforelse 
                --}}
            </tbody>
        </table>
    </div>
@endsection