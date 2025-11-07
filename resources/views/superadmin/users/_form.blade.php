{{--
PERBAIKAN:
1. Menyamakan style card (rounded-lg, shadow-sm, space-y-8).
2. Menambahkan class styling ke <select> (SANGAT PENTING).
3. Mengelompokkan field dengan h3 (Info Akun, Password, dll).
4. Menyamakan warna tombol "Simpan" menjadi indigo.
--}}
<div class="space-y-8 bg-white p-6 rounded-lg shadow-sm border border-gray-200" x-data="{ roleId: '{{ old('role_id', $user->role_id ?? '') }}' }">

    {{-- Grup 1: Info Akun --}}
    <div class="space-y-4">
        <h3 class="text-sm font-medium text-gray-900">Informasi Akun</h3>
        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
            <div>
                <label for="username" class="block text-sm font-medium text-gray-700 mb-1">Nama Pengguna</label>
                <input type="text" name="username" id="username" value="{{ old('username', $user->username ?? '') }}" required class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 sm:text-sm">
                @error('username') <span class="text-red-500 text-xs mt-1 block">{{ $message }}</span> @enderror
            </div>
            <div>
                <label for="email" class="block text-sm font-medium text-gray-700 mb-1">Alamat Email</label>
                <input type="email" name="email" id="email" value="{{ old('email', $user->email ?? '') }}" required class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 sm:text-sm">
                @error('email') <span class="text-red-500 text-xs mt-1 block">{{ $message }}</span> @enderror
            </div>
        </div>
    </div>

    {{-- Grup 2: Password --}}
    <div class="space-y-4 pt-6 border-t border-gray-200">
        <h3 class="text-sm font-medium text-gray-900">Keamanan</h3>
        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
            <div>
                <label for="password" class="block text-sm font-medium text-gray-700 mb-1">Password</label>
                <input type="password" name="password" id="password" {{ $user->exists ? '' : 'required' }} class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 sm:text-sm">
                @if($user->exists) <p class="text-xs text-gray-500 mt-1">Kosongkan jika tidak ingin mengubah password.</p> @endif
                @error('password') <span class="text-red-500 text-xs mt-1 block">{{ $message }}</span> @enderror
            </div>
            <div>
                <label for="password_confirmation" class="block text-sm font-medium text-gray-700 mb-1">Konfirmasi Password</label>
                <input type="password" name="password_confirmation" id="password_confirmation" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 sm:text-sm">
            </div>
        </div>
    </div>

    {{-- Grup 3: Peran & Unit Kerja --}}
    <div class="space-y-4 pt-6 border-t border-gray-200">
        <h3 class="text-sm font-medium text-gray-900">Peran & Otorisasi</h3>
        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
            <div>
                <label for="role_id_select" class="block text-sm font-medium text-gray-700 mb-1">Peran</label>
                {{-- PERBAIKAN: Menambahkan class styling ke <select> --}}
                <select name="role_id" id="role_id_select" required x-model="roleId" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 sm:text-sm">
                    <option value="">Pilih peran...</option>
                    @foreach($roles as $role)
                    <option value="{{ $role->id }}">{{ $role->role_name }}</option>
                    @endforeach
                </select>
                @error('role_id') <span class="text-red-500 text-xs mt-1 block">{{ $message }}</span> @enderror
            </div>
            <div x-show="roleId == 2" x-transition>
                <label for="unit_kerja_id_select" class="block text-sm font-medium text-gray-700 mb-1">Unit Kerja</label>
                {{-- PERBAIKAN: Menambahkan class styling ke <select> --}}
                <select name="unit_kerja_id" id="unit_kerja_id_select" :required="roleId == 2" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 sm:text-sm">
                    <option value="">Pilih unit kerja...</option>
                    @foreach($unitKerjas as $unit)
                    <option value="{{ $unit->id }}" {{ old('unit_kerja_id', $user->unit_kerja_id ?? '') == $unit->id ? 'selected' : '' }}>
                        {{ $unit->unit_kerja_name }}
                    </option>
                    @endforeach
                </select>
                @error('unit_kerja_id') <span class="text-red-500 text-xs mt-1 block">{{ $message }}</span> @enderror
            </div>
        </div>
    </div>

    {{-- Grup 4: Opsi Status Aktif --}}
    <div class="pt-6 border-t border-gray-200">
        <h3 class="text-sm font-medium text-gray-900">Status Akun</h3>
        <div class="relative flex items-start mt-4">
            <div class="flex h-6 items-center">
                <input id="is_active" name="is_active" type="checkbox" value="1" {{ old('is_active', $user->is_active ?? true) ? 'checked' : '' }} class="h-4 w-4 rounded border-gray-300 text-indigo-600 focus:ring-indigo-600">
            </div>
            <div class="ml-3 text-sm leading-6">
                <label for="is_active" class="font-medium text-gray-900">Akun Aktif</label>
                <p class="text-gray-500">Pengguna dengan akun tidak aktif tidak akan bisa login.</p>
            </div>
        </div>
    </div>
</div>

{{-- Tombol Aksi --}}
<div class="mt-8 pt-6 border-t border-gray-200 flex justify-end space-x-3">
    <a href="{{ route('superadmin.users.index') }}" class="bg-white py-2 px-4 border border-gray-300 rounded-md shadow-sm text-sm font-medium text-gray-700 hover:bg-gray-50">
        Batal
    </a>
    {{-- PERBAIKAN: Menyamakan warna tombol 'bg-indigo-600' --}}
    <button type="submit" class="inline-flex justify-center py-2 px-4 border border-transparent shadow-sm text-sm font-medium rounded-md text-white bg-indigo-600 hover:bg-indigo-700">
        Simpan Pengguna
    </button>
</div>