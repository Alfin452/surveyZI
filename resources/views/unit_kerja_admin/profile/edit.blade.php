@extends('layouts.unit_kerja_admin')

@section('content')
<div class="container mx-auto px-4 sm:px-8 py-8">

    <h2 class="text-2xl font-semibold leading-tight">Profil Unit Kerja</h2>
    <p class="text-gray-600 mb-6">Kelola informasi publik untuk unit kerja Anda.</p>

    <!-- Menampilkan pesan sukses -->
    @if (session('success'))
    <div class="mb-4 p-4 text-sm text-green-700 bg-green-100 rounded-lg" role="alert">
        {{ session('success') }}
    </div>
    @endif

    <!-- Menampilkan pesan error (jika ada) -->
    @if (session('error'))
    <div class="mb-4 p-4 text-sm text-red-700 bg-red-100 rounded-lg" role="alert">
        {{ session('error') }}
    </div>
    @endif

    @if($unitKerja)
    <div class="bg-white shadow rounded-lg p-6">
        <form action="{{ route('unitkerja.admin.profile.update') }}" method="POST">
            @csrf
            @method('PUT')

            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                <!-- Kolom Kiri -->
                <div>
                    <!-- Nama Unit Kerja (Read-only) -->
                    <div>
                        <label for="unit_kerja_name" class="block text-sm font-medium text-gray-700">Nama Unit Kerja</label>
                        <input type="text" name="unit_kerja_name" id="unit_kerja_name" value="{{ $unitKerja->unit_kerja_name }}" disabled
                            class="mt-1 block w-full px-3 py-2 bg-gray-100 border border-gray-300 rounded-md shadow-sm sm:text-sm">
                        <p class="mt-1 text-xs text-gray-500">Nama unit kerja hanya bisa diubah oleh Superadmin.</p>
                    </div>

                    <!-- Kontak (Telepon/Email) -->
                    <div class="mt-4">
                        <label for="contact" class="block text-sm font-medium text-gray-700">Kontak (Telepon / Email)</label>
                        <input type="text" name="contact" id="contact" value="{{ old('contact', $unitKerja->contact) }}"
                            class="mt-1 block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm">
                        @error('contact')
                        <p class="mt-1 text-xs text-red-500">{{ $message }}</p>
                        @enderror
                    </div>

                    <!-- Jam Layanan (Mulai) -->
                    <div class="mt-4">
                        <label for="start_time" class="block text-sm font-medium text-gray-700">Jam Mulai Layanan</label>
                        <input type="text" name="start_time" id="start_time" value="{{ old('start_time', $unitKerja->start_time) }}"
                            placeholder="Contoh: 08:00"
                            class="timepicker mt-1 block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm">
                        @error('start_time')
                        <p class="mt-1 text-xs text-red-500">{{ $message }}</p>
                        @enderror
                    </div>

                    <!-- Jam Layanan (Selesai/Khusus) -->
                    <div class="mt-4">
                        <label for="end_time" class="block text-sm font-medium text-gray-700">Jam Selesai Layanan</label>
                        <input type="text" name="end_time" id="end_time" value="{{ old('end_time', $unitKerja->end_time) }}"
                            placeholder="Contoh: 16:00"
                            class="timepicker mt-1 block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm">
                        @error('end_time')
                        <p class="mt-1 text-xs text-red-500">{{ $message }}</p>
                        @enderror
                    </div>
                </div>

                <!-- Kolom Kanan -->
                <div>
                    <!-- Alamat -->
                    <div>
                        <label for="address" class="block text-sm font-medium text-gray-700">Alamat</label>
                        <textarea name="address" id="address" rows="5"
                            class="mt-1 block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm">{{ old('address', $unitKerja->address) }}</textarea>
                        @error('address')
                        <p class="mt-1 text-xs text-red-500">{{ $message }}</p>
                        @enderror
                    </div>
                </div>
            </div>

            <!-- Tombol Simpan -->
            <div class="flex justify-end mt-6 pt-4 border-t">
                <button type="submit" class="inline-flex justify-center py-2 px-4 border border-transparent shadow-sm text-sm font-medium rounded-md text-white bg-indigo-600 hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500">
                    Simpan Perubahan
                </button>
            </div>
        </form>
    </div>
    @endif

</div>
@endsection