<div class="space-y-6 bg-white p-6 rounded-xl shadow-lg border">
    {{-- Nama Unit Kerja & Nama Pendek --}}
    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
        <div>
            <label for="unit_kerja_name" class="block text-sm font-medium text-gray-700">Nama Unit Kerja</label>
            <input type="text" name="unit_kerja_name" id="unit_kerja_name" value="{{ old('unit_kerja_name', $unitKerja->unit_kerja_name ?? '') }}" required class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 sm:text-sm" placeholder="Contoh: UPT Teknologi Informasi & Pangkalan Data">
            @error('unit_kerja_name') <span class="text-red-500 text-xs mt-1">{{ $message }}</span> @enderror
        </div>
        <div>
            <label for="uk_short_name" class="block text-sm font-medium text-gray-700">Nama Pendek / Akronim</label>
            <input type="text" name="uk_short_name" id="uk_short_name" value="{{ old('uk_short_name', $unitKerja->uk_short_name ?? '') }}" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 sm:text-sm" placeholder="Contoh: UTIPD">
            @error('uk_short_name') <span class="text-red-500 text-xs mt-1">{{ $message }}</span> @enderror
        </div>
    </div>

    {{-- Tipe Unit & Induk Unit --}}
    <div class="grid grid-cols-1 md:grid-cols-2 gap-6 pt-4 border-t">
        <div>
            <label for="tipe_unit_id" class="block text-sm font-medium text-gray-700">Tipe Unit</label>
            <select name="tipe_unit_id" id="tipe_unit_id" required class="mt-1 block w-full pl-3 pr-10 py-2 text-base border-gray-300 focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm rounded-md">
                <option value="">Pilih tipe unit...</option>
                @foreach($tipeUnits as $tipe)
                <option value="{{ $tipe->id }}" {{ old('tipe_unit_id', $unitKerja->tipe_unit_id ?? '') == $tipe->id ? 'selected' : '' }}>
                    {{ $tipe->nama_tipe_unit }}
                </option>
                @endforeach
            </select>
            @error('tipe_unit_id') <span class="text-red-500 text-xs mt-1">{{ $message }}</span> @enderror
        </div>
        <div>
            <label for="parent_id" class="block text-sm font-medium text-gray-700">Induk Unit (Opsional)</label>
            <select name="parent_id" id="parent_id" class="mt-1 block w-full pl-3 pr-10 py-2 text-base border-gray-300 focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm rounded-md">
                <option value="">Tidak ada induk</option>
                @foreach($parentUnits as $parent)
                <option value="{{ $parent->id }}" {{ old('parent_id', $unitKerja->parent_id ?? '') == $parent->id ? 'selected' : '' }}>
                    {{ $parent->unit_kerja_name }}
                </option>
                @endforeach
            </select>
            @error('parent_id') <span class="text-red-500 text-xs mt-1">{{ $message }}</span> @enderror
        </div>
    </div>

    {{-- Detail Kontak & Lokasi --}}
    <div class="grid grid-cols-1 md:grid-cols-2 gap-6 pt-4 border-t">
        <div>
            <label for="contact" class="block text-sm font-medium text-gray-700">Kontak (Email/No. Telepon)</label>
            <input type="text" name="contact" id="contact" value="{{ old('contact', $unitKerja->contact ?? '') }}" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 sm:text-sm">
        </div>
        <div>
            <label for="address" class="block text-sm font-medium text-gray-700">Alamat / Lokasi</label>
            <input type="text" name="address" id="address" value="{{ old('address', $unitKerja->address ?? '') }}" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 sm:text-sm">
        </div>
    </div>

    {{-- Jam Layanan --}}
    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
        <div>
            <label for="start_time" class="block text-sm font-medium text-gray-700">Jam Mulai Layanan</label>
            <input type="text" name="start_time" id="start_time" value="{{ old('start_time', $unitKerja->start_time ?? '') }}" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 sm:text-sm" placeholder="Contoh: 08:00 WITA">
        </div>
        <div>
            <label for="end_time" class="block text-sm font-medium text-gray-700">Jam Selesai Layanan</label>
            <input type="text" name="end_time" id="end_time" value="{{ old('end_time', $unitKerja->end_time ?? '') }}" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 sm:text-sm" placeholder="Contoh: 16:00 WITA">
        </div>
    </div>

</div>

{{-- Tombol Aksi --}}
<div class="mt-8 pt-6 border-t flex justify-end space-x-3">
    <a href="{{ route('superadmin.unit-kerja.index') }}" class="bg-white py-2 px-4 border border-gray-300 rounded-md shadow-sm text-sm font-medium text-gray-700 hover:bg-gray-50">
        Batal
    </a>
    <button type="submit" class="inline-flex justify-center py-2 px-4 border border-transparent shadow-sm text-sm font-medium rounded-md text-white bg-blue-600 hover:bg-blue-700">
        Simpan Unit Kerja
    </button>
</div>