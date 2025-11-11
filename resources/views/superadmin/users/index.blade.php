@extends('layouts.superadmin')

@section('content')
<div class="space-y-1">
    {{-- Header Halaman --}}
    <div class="bg-white rounded-lg p-5 border border-gray-200 shadow-sm">
        <div class="flex flex-col md:flex-row md:justify-between md:items-center">
            <div>
                <div class="flex items-start gap-3">
                    <div class="flex-shrink-0 bg-gradient-to-br from-yellow-100 to-yellow-200 text-yellow-600 p-3 rounded-lg">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M12 4.354a4 4 0 110 5.292M15 21H3v-1a6 6 0 0112 0v1zm0 0h6v-1a6 6 0 00-9-5.197M13 7a4 4 0 11-8 0 4 4 0 018 0z" />
                        </svg>
                    </div>
                    <div>
                        <h1 class="text-xl font-bold text-gray-800">Manajemen Pengguna</h1>
                        <p class="text-sm text-gray-500 mt-1">Kelola akun Super Admin dan Admin Unit Kerja.</p>
                    </div>
                </div>
            </div>
            <a href="{{ route('superadmin.users.create') }}" class="mt-4 md:mt-0 bg-green-600 text-white px-5 py-2 rounded-lg font-medium hover:bg-green-700 transition duration-300 shadow-sm flex items-center space-x-2 self-start md:self-end">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" viewBox="0 0 20 20" fill="currentColor">
                    <path fill-rule="evenodd" d="M10 3a1 1 0 011 1v5h5a1 1 0 110 2h-5v5a1 1 0 11-2 0v-5H4a1 1 0 110-2h5V4a1 1 0 011-1z" clip-rule="evenodd" />
                </svg>
                <span>Tambah Pengguna</span>
            </a>
        </div>
    </div>

    <div class="bg-white rounded-lg p-5 border border-gray-200 shadow-sm">
        <form action="{{ route('superadmin.users.index') }}" method="GET" class="space-y-4 md:space-y-0 md:grid md:grid-cols-2 lg:grid-cols-3 md:gap-4">
            <div>
                <label for="search" class="text-sm font-medium text-gray-700">Cari Nama / Email</label>
                <div class="relative mt-1">
                    <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none"><svg class="h-5 w-5 text-gray-400" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor">
                            <path fill-rule="evenodd" d="M8 4a4 4 0 100 8 4 4 0 000-8zM2 8a6 6 0 1110.89 3.476l4.817 4.817a1 1 0 01-1.414 1.414l-4.816-4.816A6 6 0 012 8z" clip-rule="evenodd" />
                        </svg></div>
                    <input type="text" id="search" name="search" class="w-full pl-10 pr-4 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-1 focus:ring-indigo-500 focus:border-indigo-500" placeholder="Ketik nama atau email..." value="{{ request('search') }}">
                </div>
            </div>
            <div>
                <label for="role" class="text-sm font-medium text-gray-700">Peran</label>
                <select id="role" name="role" class="mt-1 w-full pl-3 pr-10 py-2 border border-gray-300 rounded-md shadow-sm bg-white focus:outline-none focus:ring-1 focus:ring-indigo-500 focus:border-indigo-500">
                    <option value="">Semua Peran</option>
                    @foreach ($roles as $role)
                    <option value="{{ $role->id }}" {{ request('role') == $role->id ? 'selected' : '' }}>{{ $role->role_name }}</option>
                    @endforeach
                </select>
            </div>
            <div class="flex items-end gap-3">
                <button type="submit" class="w-full bg-indigo-600 text-white px-5 py-2 rounded-md font-semibold hover:bg-indigo-700 transition shadow-sm flex items-center justify-center space-x-2">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M3 4a1 1 0 011-1h16a1 1 0 011 1v2.586a1 1 0 01-.293.707l-6.414 6.414a1 1 0 00-.293.707V17l-4 4v-6.586a1 1 0 00-.293-.707L3.293 7.293A1 1 0 013 6.586V4z" />
                    </svg>
                    <span>Filter</span>
                </button>
                <a href="{{ route('superadmin.users.index') }}" class="px-4 py-2 text-sm font-semibold text-gray-600 hover:text-gray-800 border border-gray-300 rounded-md shadow-sm bg-white hover:bg-gray-50">Reset</a>
            </div>
        </form>
    </div>

    {{-- Tabel Pengguna --}}
    <div class="overflow-x-auto bg-white rounded-lg shadow-sm border border-gray-200">
        <table class="min-w-full divide-y divide-gray-200">
            <thead class="bg-indigo-50">
                <tr>
                    <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Nama</th>
                    <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Peran & Unit Kerja</th>
                    <th scope="col" class="px-6 py-3 text-center text-xs font-medium text-gray-500 uppercase tracking-wider">Status</th>
                    <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Tanggal Bergabung</th>
                    <th scope="col" class="px-6 py-3 text-center text-xs font-medium text-gray-500 uppercase tracking-wider">Aksi</th>
                </tr>
            </thead>
            <tbody class="bg-white divide-y divide-gray-200">
                @forelse ($users as $user)
                <tr class="hover:bg-indigo-50/50 transition-colors duration-200">

                    {{-- PERBAIKAN: Hapus 'whitespace-nowrap' dan tambahkan 'align-middle' --}}
                    <td class="px-6 py-4 align-middle">
                        <div class="font-semibold text-gray-900">{{ $user->username }}</div>
                        <div class="text-sm text-gray-500">{{ $user->email }}</div>
                    </td>

                    {{-- PERBAIKAN: Hapus 'whitespace-nowrap' dan tambahkan 'align-middle' --}}
                    <td class="px-6 py-4 align-middle">
                        <div class="font-semibold text-gray-800">{{ $user->role->role_name ?? 'N/A' }}</div>
                        @if($user->unitKerja)
                        <div class="text-sm text-gray-500">{{ $user->unitKerja->unit_kerja_name }}</div>
                        @endif
                    </td>

                    {{-- PERBAIKAN: Tambahkan 'align-middle' --}}
                    <td class="px-6 py-4 whitespace-nowrap text-center align-middle">
                        @if($user->is_active)
                        <span class="px-3 py-1 inline-flex text-xs leading-5 font-semibold rounded-full bg-green-100 text-green-800">Aktif</span>
                        @else
                        <span class="px-3 py-1 inline-flex text-xs leading-5 font-semibold rounded-full bg-gray-100 text-gray-800">Tidak Aktif</span>
                        @endif
                    </td>

                    {{-- PERBAIKAN: Tambahkan 'align-middle' --}}
                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-700 align-middle">
                        {{ $user->created_at->format('d M Y') }}
                    </td>

                    {{-- PERBAIKAN: Tambahkan 'align-middle' --}}
                    <td class="px-6 py-4 whitespace-nowrap text-sm font-medium align-middle">
                        <div class="flex items-center justify-center space-x-4">
                            <a href="{{ route('superadmin.users.edit', $user) }}" class="text-indigo-600 hover:text-indigo-900" title="Edit">
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z" />
                                </svg>
                            </a>
                            @if(Auth::id() !== $user->id)
                            <button type="button" @click="$dispatch('open-delete-modal', { url: '{{ route('superadmin.users.destroy', $user) }}', name: '{{ addslashes($user->username) }}' })" class="text-red-600 hover:text-red-800" title="Hapus">
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6M9 7V4a1 1 0 011-1h4a1 1 0 011 1v3M4 7h16" />
                                </svg>
                            </button>
                            @else
                            <span class="w-5 h-5"></span>
                            @endif
                        </div>
                    </td>
                </tr>
                @empty
                <tr>
                    <td colspan="5" class="text-center py-12 px-4">
                        <div class="text-center">
                            <svg xmlns="http://www.w3.org/2000/svg" class="mx-auto h-12 w-12 text-gray-400" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="1">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M12 4.354a4 4 0 110 5.292M15 21H3v-1a6 6 0 0112 0v1zm0 0h6v-1a6 6 0 00-9-5.197M13 7a4 4 0 11-8 0 4 4 0 018 0z" />
                            </svg>
                            <p class="mt-4 font-semibold text-gray-600">Data Tidak Ditemukan</p>
                            <p class="text-gray-500 text-sm mt-1">Belum ada pengguna yang dibuat atau sesuai dengan filter Anda.</p>
                        </div>
                    </td>
                </tr>
                @endforelse
            </tbody>
        </table>
    </div>

    <div class="mt-6">
        {{ $users->links() }}
    </div>
</div>
@endsection