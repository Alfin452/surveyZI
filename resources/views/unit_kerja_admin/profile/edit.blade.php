@extends('layouts.unit_kerja_admin')

@section('content')
<div class="space-y-6">

    <div class="bg-white rounded-lg p-5 border border-gray-200 shadow-sm">
        <div class="flex items-start gap-3">
            <div class="flex-shrink-0 bg-teal-500 text-white p-2 rounded-md">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4" />
                </svg>
            </div>
            <div>
                <h1 class="text-xl font-bold text-gray-800">Profil Unit Kerja</h1>
                <p class="text-sm text-gray-500 mt-1">Kelola informasi publik untuk: <span class="font-semibold">{{ $unitKerja->unit_kerja_name }}</span></p>
            </div>
        </div>
    </div>

    <div class="bg-white rounded-lg shadow-sm border border-gray-200 p-6">
        <form action="{{ route('unitkerja.admin.profile.update') }}" method="POST">
            @csrf
            @method('PUT')

            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                <div class="space-y-6">
                    <div>
                        <label for="unit_kerja_name" class="block text-sm font-medium text-gray-700">Nama Unit Kerja</label>
                        <input type="text" name="unit_kerja_name" id="unit_kerja_name" value="{{ $unitKerja->unit_kerja_name }}" disabled
                            class="mt-1 block w-full px-3 py-2 bg-gray-100 border border-gray-300 rounded-md shadow-sm sm:text-sm">
                        <p class="mt-1 text-xs text-gray-500">Nama unit kerja hanya bisa diubah oleh Superadmin.</p>
                    </div>

                    <div class="mt-4">
                        <label for="contact" class="block text-sm font-medium text-gray-700">Kontak (Telepon / Email)</label>
                        <input type="text" name="contact" id="contact" value="{{ old('contact', $unitKerja->contact) }}"
                            class="mt-1 block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:ring-teal-500 focus:border-teal-500 sm:text-sm">
                        @error('contact')
                        <p class="mt-1 text-xs text-red-500">{{ $message }}</p>
                        @enderror
                    </div>

                    <div class="mt-4">
                        <label for="start_time" class="block text-sm font-medium text-gray-700">Jam Mulai Layanan</label>
                        <input type="text" name="start_time" id="start_time" value="{{ old('start_time', $unitKerja->start_time) }}"
                            placeholder="Pilih jam (HH:MM)..."
                            class="timepicker mt-1 block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:ring-teal-500 focus:border-teal-500 sm:text-sm">
                        @error('start_time')
                        <p class="mt-1 text-xs text-red-500">{{ $message }}</p>
                        @enderror
                    </div>

                    <div class="mt-4">
                        <label for="end_time" class="block text-sm font-medium text-gray-700">Jam Selesai Layanan</label>
                        <input type="text" name="end_time" id="end_time" value="{{ old('end_time', $unitKerja->end_time) }}"
                            placeholder="Pilih jam (HH:MM)..."
                            class="timepicker mt-1 block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:ring-teal-500 focus:border-teal-500 sm:text-sm">
                        @error('end_time')
                        <p class="mt-1 text-xs text-red-500">{{ $message }}</p>
                        @enderror
                    </div>
                </div>

                <div>
                    <div>
                        <label for="address" class="block text-sm font-medium text-gray-700">Alamat</label>
                        <textarea name="address" id="address" rows="5"
                            class="mt-1 block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:ring-teal-500 focus:border-teal-500 sm:text-sm">{{ old('address', $unitKerja->address) }}</textarea>
                        @error('address')
                        <p class="mt-1 text-xs text-red-500">{{ $message }}</p>
                        @enderror
                    </div>
                </div>
            </div>

            <div class="flex justify-end mt-6 pt-4 border-t">
                <button type="submit" class="inline-flex justify-center py-2 px-4 border border-transparent shadow-sm text-sm font-medium rounded-md text-white bg-teal-600 hover:bg-teal-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-teal-500">
                    Simpan Perubahan
                </button>
            </div>
        </form>
    </div>
</div>
@endsection