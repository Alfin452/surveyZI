<div class="space-y-8 bg-white p-6 rounded-lg shadow-sm border border-gray-200">

    {{-- Grup 1: Info Dasar --}}
    <div class="space-y-4">
        <h3 class="text-sm font-medium text-gray-900">Informasi Dasar</h3>
        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
            <div>
                <label for="unit_kerja_name" class="block text-sm font-medium text-gray-700 mb-1">Nama Unit Kerja</label>
                <input type="text" name="unit_kerja_name" id="unit_kerja_name" value="{{ old('unit_kerja_name', $unitKerja->unit_kerja_name ?? '') }}" required
                    class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 sm:text-sm @error('unit_kerja_name') border-red-500 ring-1 ring-red-500 @enderror"
                    placeholder="Contoh: Unit Teknologi Informasi dan Pangkalan Data">
                <div class="mt-1 min-h-5">
                    @error('unit_kerja_name') <span class="text-red-500 text-xs block">{{ $message }}</span> @enderror
                </div>
            </div>
            <div>
                <label for="uk_short_name" class="block text-sm font-medium text-gray-700 mb-1">Nama Pendek / Akronim</label>
                <input type="text" name="uk_short_name" id="uk_short_name" value="{{ old('uk_short_name', $unitKerja->uk_short_name ?? '') }}"
                    class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 sm:text-sm @error('uk_short_name') border-red-500 ring-1 ring-red-500 @enderror"
                    placeholder="Contoh: UTIPD">
                <div class="mt-1 min-h-5">
                    @error('uk_short_name') <span class="text-red-500 text-xs block">{{ $message }}</span> @enderror
                </div>
            </div>
        </div>
    </div>

    {{-- Grup 2: Tipe Unit & Induk Unit --}}
    <div class="space-y-4 pt-6 border-t border-gray-200">
        <h3 class="text-sm font-medium text-gray-900">Struktur Organisasi</h3>
        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
            <div>
                <label for="tipe_unit_id" class="block text-sm font-medium text-gray-700 mb-1">Tipe Unit</label>
                <select name="tipe_unit_id" id="tipe_unit_id" required
                    class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 sm:text-sm @error('tipe_unit_id') border-red-500 ring-1 ring-red-500 @enderror">
                    <option value="">Pilih tipe unit...</option>
                    @foreach($tipeUnits as $tipe)
                    <option value="{{ $tipe->id }}" {{ old('tipe_unit_id', $unitKerja->tipe_unit_id ?? '') == $tipe->id ? 'selected' : '' }}>
                        {{ $tipe->nama_tipe_unit }}
                    </option>
                    @endforeach
                </select>
                <div class="mt-1 min-h-5">
                    @error('tipe_unit_id') <span class="text-red-500 text-xs block">{{ $message }}</span> @enderror
                </div>
            </div>
            <div>
                <label for="parent_id" class="block text-sm font-medium text-gray-700 mb-1">Induk Unit (Opsional)</label>
                <select name="parent_id" id="parent_id"
                    class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 sm:text-sm @error('parent_id') border-red-500 ring-1 ring-red-500 @enderror">
                    <option value="">Tidak ada induk</option>
                    @foreach($parentUnits as $parent)
                    @if(isset($unitKerja) && $unitKerja->id === $parent->id) @continue @endif
                    <option value="{{ $parent->id }}" {{ old('parent_id', $unitKerja->parent_id ?? '') == $parent->id ? 'selected' : '' }}>
                        {{ $parent->unit_kerja_name }}
                    </option>
                    @endforeach
                </select>
                <div class="mt-1 min-h-5">
                    @error('parent_id') <span class="text-red-500 text-xs block">{{ $message }}</span> @enderror
                </div>
            </div>
        </div>
    </div>

    {{-- Grup 3: Detail Kontak & Layanan --}}
    <div class="space-y-4 pt-6 border-t border-gray-200">
        <h3 class="text-sm font-medium text-gray-900">Informasi Kontak & Layanan</h3>
        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
            <div>
                <label for="contact" class="block text-sm font-medium text-gray-700 mb-1">Kontak (Email/No. Telepon)</label>
                <input type="text" name="contact" id="contact" value="{{ old('contact', $unitKerja->contact ?? '') }}"
                    class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 sm:text-sm @error('contact') border-red-500 ring-1 ring-red-500 @enderror">
                <div class="mt-1 min-h-5">
                    @error('contact') <span class="text-red-500 text-xs block">{{ $message }}</span> @enderror
                </div>
            </div>
            <div>
                <label for="address" class="block text-sm font-medium text-gray-700 mb-1">Alamat / Lokasi</label>
                <input type="text" name="address" id="address" value="{{ old('address', $unitKerja->address ?? '') }}"
                    class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 sm:text-sm @error('address') border-red-500 ring-1 ring-red-500 @enderror">
                <div class="mt-1 min-h-5">
                    @error('address') <span class="text-red-500 text-xs block">{{ $message }}</span> @enderror
                </div>
            </div>
            <div>
                <label for="start_time" class="block text-sm font-medium text-gray-700 mb-1">Jam Mulai Layanan</label>
                <input type="text" name="start_time" id="start_time" value="{{ old('start_time', $unitKerja->start_time ?? '') }}"
                    class="timepicker mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 sm:text-sm @error('start_time') border-red-500 ring-1 ring-red-500 @enderror"
                    placeholder="Input jam mulai layanan">
                <div class="mt-1 min-h-5">
                    @error('start_time') <span class="text-red-500 text-xs block">{{ $message }}</span> @enderror
                </div>
            </div>
            <div>
                <label for="end_time" class="block text-sm font-medium text-gray-700 mb-1">Jam Selesai Layanan</label>
                <input type="text" name="end_time" id="end_time" value="{{ old('end_time', $unitKerja->end_time ?? '') }}"
                    class="timepicker mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 sm:text-sm @error('end_time') border-red-500 ring-1 ring-red-500 @enderror"
                    placeholder="Input jam selesai layanan">
                <div class="mt-1 min-h-5">
                    @error('end_time') <span class="text-red-500 text-xs block">{{ $message }}</span> @enderror
                </div>
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