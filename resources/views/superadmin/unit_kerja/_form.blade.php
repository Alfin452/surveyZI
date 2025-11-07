{{--
PERBAIKAN:
1. Menyamakan style card (rounded-lg, shadow-sm, space-y-8).
2. Mengelompokkan field dengan lebih jelas (Info Dasar, Struktur, Kontak).
3. Menyamakan style <select> agar konsisten dengan <input>.
4. Menyamakan warna tombol "Simpan" menjadi indigo.
5. MENGGUNAKAN KELAS '.timepicker' (untuk Flatpickr 24-jam).
--}}
<div class="space-y-8 bg-white p-6 rounded-lg shadow-sm border border-gray-200">

    {{-- Grup 1: Info Dasar --}}
    <div class="space-y-4">
        <h3 class="text-sm font-medium text-gray-900">Informasi Dasar</h3>
        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
            <div>
                <label for="unit_kerja_name" class="block text-sm font-medium text-gray-700 mb-1">Nama Unit Kerja</label>
                <input type="text" name="unit_kerja_name" id="unit_kerja_name" value="{{ old('unit_kerja_name', $unitKerja->unit_kerja_name ?? '') }}" required class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 sm:text-sm" placeholder="Contoh: Unit Teknologi Informasi dan Pangkalan Data">
                @error('unit_kerja_name') <span class="text-red-500 text-xs mt-1 block">{{ $message }}</span> @enderror
            </div>
            <div>
                <label for="uk_short_name" class="block text-sm font-medium text-gray-700 mb-1">Nama Pendek / Akronim</label>
                <input type="text" name="uk_short_name" id="uk_short_name" value="{{ old('uk_short_name', $unitKerja->uk_short_name ?? '') }}" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 sm:text-sm" placeholder="Contoh: UTIPD">
                @error('uk_short_name') <span class="text-red-500 text-xs mt-1 block">{{ $message }}</span> @enderror
            </div>
        </div>
    </div>

    {{-- Grup 2: Tipe Unit & Induk Unit --}}
    <div class="space-y-4 pt-6 border-t border-gray-200">
        <h3 class="text-sm font-medium text-gray-900">Struktur Organisasi</h3>
        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
            <div>
                <label for="tipe_unit_id" class="block text-sm font-medium text-gray-700 mb-1">Tipe Unit</label>
                <select name="tipe_unit_id" id="tipe_unit_id" required class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 sm:text-sm">
                    <option value="">Pilih tipe unit...</option>
                    @foreach($tipeUnits as $tipe)
                    <option value="{{ $tipe->id }}" {{ old('tipe_unit_id', $unitKerja->tipe_unit_id ?? '') == $tipe->id ? 'selected' : '' }}>
                        {{ $tipe->nama_tipe_unit }}
                    </option>
                    @endforeach
                </select>
                @error('tipe_unit_id') <span class="text-red-500 text-xs mt-1 block">{{ $message }}</span> @enderror
            </div>
            <div>
                <label for="parent_id" class="block text-sm font-medium text-gray-700 mb-1">Induk Unit (Opsional)</label>
                <select name="parent_id" id="parent_id" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 sm:text-sm">
                    <option value="">Tidak ada induk</option>
                    @foreach($parentUnits as $parent)
                    @if(isset($unitKerja) && $unitKerja->id === $parent->id) @continue @endif
                    <option value="{{ $parent->id }}" {{ old('parent_id', $unitKerja->parent_id ?? '') == $parent->id ? 'selected' : '' }}>
                        {{ $parent->unit_kerja_name }}
                    </option>
                    @endforeach
                </select>
                @error('parent_id') <span class="text-red-500 text-xs mt-1 block">{{ $message }}</span> @enderror
            </div>
        </div>
    </div>

    {{-- Grup 3: Detail Kontak & Layanan --}}
    <div class="space-y-4 pt-6 border-t border-gray-200">
        <h3 class="text-sm font-medium text-gray-900">Informasi Kontak & Layanan</h3>
        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
            <div>
                <label for="contact" class="block text-sm font-medium text-gray-700 mb-1">Kontak (Email/No. Telepon)</label>
                <input type="text" name="contact" id="contact" value="{{ old('contact', $unitKerja->contact ?? '') }}" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 sm:text-sm">
            </div>
            <div>
                <label for="address" class="block text-sm font-medium text-gray-700 mb-1">Alamat / Lokasi</label>
                <input type="text" name="address" id="address" value="{{ old('address', $unitKerja->address ?? '') }}" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 sm:text-sm">
            </div>
            <div>
                <label for="start_time" class="block text-sm font-medium text-gray-700 mb-1">Jam Mulai Layanan</label>
                {{-- PERBAIKAN: Menggunakan kelas 'timepicker' untuk Flatpickr --}}
                <input type="text" name="start_time" id="start_time" value="{{ old('start_time', $unitKerja->start_time ?? '') }}" class="timepicker mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 sm:text-sm" placeholder="Input jam mulai layanan">
            </div>
            <div>
                <label for="end_time" class="block text-sm font-medium text-gray-700 mb-1">Jam Selesai Layanan</label>
                {{-- PERBAIKAN: Menggunakan kelas 'timepicker' untuk Flatpickr --}}
                <input type="text" name="end_time" id="end_time" value="{{ old('end_time', $unitKerja->end_time ?? '') }}" class="timepicker mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 sm:text-sm" placeholder="Input jam selesai layanan">
            </div>
        </div>
    </div>

</div>

{{-- Tombol Aksi --}}
<div class="mt-8 pt-6 border-t border-gray-200 flex justify-end space-x-3">
    <a href="{{ route('superadmin.unit-kerja.index') }}" class="bg-white py-2 px-4 border border-gray-300 rounded-md shadow-sm text-sm font-medium text-gray-700 hover:bg-gray-50">
        Batal
    </a>
    <button type="submit" class="inline-flex justify-center py-2 px-4 border border-transparent shadow-sm text-sm font-medium rounded-md text-white bg-indigo-600 hover:bg-indigo-700">
        Simpan Unit Kerja
    </button>
</div>