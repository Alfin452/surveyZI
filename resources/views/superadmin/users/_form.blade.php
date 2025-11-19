<div class="bg-white/60 backdrop-blur-xl border border-white/40 shadow-xl rounded-3xl p-8"
    x-data="{ roleId: '{{ old('role_id', $user->role_id ?? '') }}' }">

    <div class="space-y-10">

        {{-- 1. Informasi Akun --}}
        <div class="space-y-6">
            <div class="flex items-center gap-3 mb-2">
                <div class="p-2 bg-indigo-100 text-indigo-600 rounded-lg">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z" />
                    </svg>
                </div>
                <h3 class="text-lg font-bold text-slate-800">Informasi Akun</h3>
            </div>

            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                {{-- Username --}}
                <div class="group">
                    <label for="username" class="block text-xs font-bold text-slate-500 uppercase mb-2 ml-1">Username <span class="text-rose-500">*</span></label>
                    <div class="relative">
                        <input type="text" name="username" id="username"
                            value="{{ old('username', $user->username ?? '') }}" required
                            class="block w-full pl-4 pr-4 py-3 bg-slate-50 border-slate-200 rounded-xl text-sm focus:ring-2 focus:ring-indigo-500 focus:border-transparent transition-all placeholder-slate-400 hover:bg-white"
                            placeholder="Contoh: alfin_admin">
                    </div>
                    @error('username') <span class="text-rose-500 text-xs mt-1 block ml-1">{{ $message }}</span> @enderror
                </div>

                {{-- Email --}}
                <div class="group">
                    <label for="email" class="block text-xs font-bold text-slate-500 uppercase mb-2 ml-1">Alamat Email <span class="text-rose-500">*</span></label>
                    <div class="relative">
                        <input type="email" name="email" id="email"
                            value="{{ old('email', $user->email ?? '') }}" required
                            class="block w-full pl-4 pr-4 py-3 bg-slate-50 border-slate-200 rounded-xl text-sm focus:ring-2 focus:ring-indigo-500 focus:border-transparent transition-all placeholder-slate-400 hover:bg-white"
                            placeholder="email@uin-antasari.ac.id">
                    </div>
                    @error('email') <span class="text-rose-500 text-xs mt-1 block ml-1">{{ $message }}</span> @enderror
                </div>
            </div>

            {{-- Password (Hanya wajib saat create) --}}
            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                <div class="group">
                    {{-- PERBAIKAN DI SINI: Menggunakan @if untuk logika tampilan label --}}
                    <label for="password" class="block text-xs font-bold text-slate-500 uppercase mb-2 ml-1">
                        Password
                        @if(isset($user->id))
                        <span class="text-slate-400 font-normal text-[10px] lowercase ml-1">(opsional)</span>
                        @else
                        <span class="text-rose-500">*</span>
                        @endif
                    </label>
                    <input type="password" name="password" id="password" {{ isset($user->id) ? '' : 'required' }}
                        class="block w-full px-4 py-3 bg-slate-50 border-slate-200 rounded-xl text-sm focus:ring-2 focus:ring-indigo-500 focus:border-transparent transition-all placeholder-slate-400 hover:bg-white"
                        placeholder="••••••••">
                    @error('password') <span class="text-rose-500 text-xs mt-1 block ml-1">{{ $message }}</span> @enderror
                </div>

                <div class="group">
                    <label for="password_confirmation" class="block text-xs font-bold text-slate-500 uppercase mb-2 ml-1">Konfirmasi Password</label>
                    <input type="password" name="password_confirmation" id="password_confirmation" {{ isset($user->id) ? '' : 'required' }}
                        class="block w-full px-4 py-3 bg-slate-50 border-slate-200 rounded-xl text-sm focus:ring-2 focus:ring-indigo-500 focus:border-transparent transition-all placeholder-slate-400 hover:bg-white"
                        placeholder="••••••••">
                </div>
            </div>
        </div>

        {{-- 2. Peran & Akses --}}
        <div class="pt-6 border-t border-slate-100 space-y-6">
            <div class="flex items-center gap-3 mb-2">
                <div class="p-2 bg-amber-100 text-amber-600 rounded-lg">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 15v2m-6 4h12a2 2 0 002-2v-6a2 2 0 00-2-2H6a2 2 0 00-2 2v6a2 2 0 002 2zm10-10V7a4 4 0 00-8 0v4h8z" />
                    </svg>
                </div>
                <h3 class="text-lg font-bold text-slate-800">Peran & Hak Akses</h3>
            </div>

            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                {{-- Role Selection --}}
                <div class="group">
                    <label for="role_id" class="block text-xs font-bold text-slate-500 uppercase mb-2 ml-1">Peran Pengguna <span class="text-rose-500">*</span></label>
                    <div class="relative">
                        <select name="role_id" id="role_id" x-model="roleId" required
                            class="block w-full px-4 py-3 bg-slate-50 border-slate-200 rounded-xl text-sm focus:ring-2 focus:ring-amber-500 focus:border-transparent transition-all cursor-pointer hover:bg-white">
                            <option value="">-- Pilih Peran --</option>
                            @foreach($roles as $role)
                            <option value="{{ $role->id }}">{{ $role->role_name }}</option>
                            @endforeach
                        </select>
                    </div>
                    @error('role_id') <span class="text-rose-500 text-xs mt-1 block ml-1">{{ $message }}</span> @enderror
                </div>

                {{-- Unit Kerja (Hanya muncul jika role Admin Unit / ID 2) --}}
                {{-- PERBAIKAN: Pastikan ID role sesuai dengan database Anda (biasanya 2 atau 3 untuk admin unit) --}}
                <div class="group" x-show="roleId == 2" x-transition.opacity>
                    <label for="unit_kerja_id" class="block text-xs font-bold text-slate-500 uppercase mb-2 ml-1">Unit Kerja <span class="text-rose-500">*</span></label>
                    <div class="relative">
                        <select name="unit_kerja_id" id="unit_kerja_id"
                            class="block w-full px-4 py-3 bg-slate-50 border-slate-200 rounded-xl text-sm focus:ring-2 focus:ring-amber-500 focus:border-transparent transition-all cursor-pointer hover:bg-white">
                            <option value="">-- Pilih Unit --</option>
                            @foreach($unitKerjas as $unit)
                            <option value="{{ $unit->id }}" {{ (old('unit_kerja_id') ?? $user->unit_kerja_id ?? '') == $unit->id ? 'selected' : '' }}>
                                {{ $unit->unit_kerja_name }}
                            </option>
                            @endforeach
                        </select>
                    </div>
                    <p class="text-[10px] text-slate-400 mt-1 ml-1">*Wajib diisi untuk Admin Unit</p>
                    @error('unit_kerja_id') <span class="text-rose-500 text-xs mt-1 block ml-1">{{ $message }}</span> @enderror
                </div>
            </div>

            {{-- Status Aktif --}}
            <div>
                <label class="relative cursor-pointer group inline-flex items-center gap-3">
                    <input type="checkbox" name="is_active" value="1" class="peer sr-only" {{ old('is_active', $user->is_active ?? true) ? 'checked' : '' }}>
                    <div class="w-11 h-6 bg-slate-200 peer-focus:outline-none peer-focus:ring-4 peer-focus:ring-emerald-300 rounded-full peer peer-checked:after:translate-x-full peer-checked:after:border-white after:content-[''] after:absolute after:top-[2px] after:left-[2px] after:bg-white after:border-gray-300 after:border after:rounded-full after:h-5 after:w-5 after:transition-all peer-checked:bg-emerald-500"></div>
                    <span class="text-sm font-bold text-slate-700 group-hover:text-emerald-600 transition-colors">Akun Aktif</span>
                </label>
            </div>
        </div>

        {{-- Footer --}}
        <div class="pt-6 border-t border-slate-100 flex justify-end gap-3">
            <a href="{{ route('superadmin.users.index') }}"
                class="px-6 py-3 rounded-xl text-sm font-bold text-slate-600 bg-white border border-slate-200 hover:bg-slate-50 transition-all">
                Batal
            </a>
            <button type="submit"
                class="px-6 py-3 rounded-xl text-sm font-bold text-white bg-gradient-to-r from-amber-500 to-orange-500 hover:from-amber-600 hover:to-orange-600 shadow-lg hover:shadow-amber-500/30 hover:-translate-y-1 transition-all flex items-center gap-2">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7" />
                </svg>
                Simpan Pengguna
            </button>
        </div>

    </div>
</div>