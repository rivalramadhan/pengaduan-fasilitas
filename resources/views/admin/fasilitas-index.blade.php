
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
                    <th class="px-5 py-3 border-b-2 border-gray-200 bg-gray-100 text-left text-xs font-semibold text-gray-700 uppercase tracking-wider">No</th>
                    <th class="px-5 py-3 border-b-2 border-gray-200 bg-gray-100 text-left text-xs font-semibold text-gray-700 uppercase tracking-wider">Nama Fasilitas</th>
                    <th class="px-5 py-3 border-b-2 border-gray-200 bg-gray-100 text-left text-xs font-semibold text-gray-700 uppercase tracking-wider">Actions</th>
                </tr>
            </thead>
            <tbody>
                @forelse ($fasilitas as $f)
                    <tr>
                        <td class="px-5 py-4 border-b border-gray-200 bg-white text-sm">{{ $loop->iteration }}</td>
                        <td class="px-5 py-4 border-b border-gray-200 bg-white text-sm">{{ $f->nama_fasilitas }}</td>
                        <td class="px-5 py-4 border-b border-gray-200 bg-white text-sm">
                            <a href="#" class="text-red-600 hover:text-indigo-900">delete</a>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="5" class="text-center py-10 border-b border-gray-200 bg-white text-sm">
                            No users found.
                        </td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>
@endsection