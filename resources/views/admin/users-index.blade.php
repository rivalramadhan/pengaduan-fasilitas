@extends('layouts.admin')
@section('title', 'Manage Users')
@section('header', 'Manage Users')
@section('content')
    <div class="bg-white shadow-md rounded-lg overflow-x-auto">
        <table class="min-w-full leading-normal">
            <thead>
                <tr>
                    <th class="px-5 py-3 border-b-2 border-gray-200 bg-gray-100 text-left text-xs font-semibold text-gray-700 uppercase tracking-wider">Name</th>
                    <th class="px-5 py-3 border-b-2 border-gray-200 bg-gray-100 text-left text-xs font-semibold text-gray-700 uppercase tracking-wider">NIK</th>
                    <th class="px-5 py-3 border-b-2 border-gray-200 bg-gray-100 text-left text-xs font-semibold text-gray-700 uppercase tracking-wider">Password</th>
                    <th class="px-5 py-3 border-b-2 border-gray-200 bg-gray-100 text-left text-xs font-semibold text-gray-700 uppercase tracking-wider">No Telp</th>
                    <th class="px-5 py-3 border-b-2 border-gray-200 bg-gray-100 text-left text-xs font-semibold text-gray-700 uppercase tracking-wider">Role</th>
                    <th class="px-5 py-3 border-b-2 border-gray-200 bg-gray-100 text-left text-xs font-semibold text-gray-700 uppercase tracking-wider">Actions</th>
                </tr>
            </thead>
            <tbody>
                @forelse ($users as $user)
                    <tr>
                        <td class="px-5 py-4 border-b border-gray-200 bg-white text-sm">{{ $user->nama }}</td>
                        <td class="px-5 py-4 border-b border-gray-200 bg-white text-sm">{{ $user->nik }}</td>
                        <td class="px-5 py-4 border-b border-gray-200 bg-white text-sm">{{ $user->password }}</td>
                        <td class="px-5 py-4 border-b border-gray-200 bg-white text-sm">{{ $user->no_telp }}</td>
                        <td class="px-5 py-4 border-b border-gray-200 bg-white text-sm">
                            <span class="relative inline-block px-3 py-1 font-semibold leading-tight rounded-full
                                @if($user->role == 'admin') text-red-900 bg-red-200 @elseif($user->role == 'petugas') text-green-900 bg-green-200 @else text-blue-900 bg-blue-200 @endif">
                                {{ ucfirst($user->role) }}
                            </span>
                        </td>
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