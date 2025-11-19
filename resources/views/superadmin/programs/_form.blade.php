{{-- Form Container Glassmorphism --}}
<div class="bg-white/60 backdrop-blur-xl border border-white/40 shadow-xl rounded-3xl p-8">
    <div class="space-y-10">

        {{-- 1. Informasi Dasar --}}
        <div class="space-y-6">
            <div class="flex items-center gap-3 mb-2">
                <div class="p-2 bg-indigo-100 text-indigo-600 rounded-lg">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z" />
                    </svg>
                </div>
                <h3 class="text-lg font-bold text-slate-800">Informasi Dasar</h3>
            </div>

            <div class="grid grid-cols-1 gap-6">
                {{-- Judul Program --}}
                <div class="group">
                    <label for="title" class="block text-xs font-bold text-slate-500 uppercase mb-2 ml-1">
                        Judul Program <span class="text-rose-500">*</span>
                    </label>
                    <div class="relative">
                        <div class="absolute inset-y-0 left-0 pl-4 flex items-center pointer-events-none">
                            <svg class="h-5 w-5 text-slate-400 group-focus-within:text-indigo-500 transition-colors" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z" />
                            </svg>
                        </div>
                        <input type="text" name="title" id="title"
                            value="{{ old('title', $program->title ?? '') }}"
                            required
                            class="block w-full pl-11 pr-4 py-3 bg-slate-50 border-slate-200 rounded-xl text-sm focus:ring-2 focus:ring-indigo-500 focus:border-transparent transition-all placeholder-slate-400 hover:bg-white"
                            placeholder="Contoh: Survei Kepuasan Masyarakat 2025">
                    </div>
                    @error('title') <span class="text-rose-500 text-xs mt-1 block ml-1">{{ $message }}</span> @enderror
                </div>

                {{-- Deskripsi --}}
                <div class="group">
                    <label for="description" class="block text-xs font-bold text-slate-500 uppercase mb-2 ml-1">Deskripsi</label>
                    <textarea name="description" id="description" rows="3"
                        class="block w-full px-4 py-3 bg-slate-50 border-slate-200 rounded-xl text-sm focus:ring-2 focus:ring-indigo-500 focus:border-transparent transition-all placeholder-slate-400 hover:bg-white"
                        placeholder="Jelaskan tujuan survei ini...">{{ old('description', $program->description ?? '') }}</textarea>
                    @error('description') <span class="text-rose-500 text-xs mt-1 block ml-1">{{ $message }}</span> @enderror
                </div>
            </div>
        </div>

        {{-- 2. Periode Pelaksanaan --}}
        <div class="pt-6 border-t border-slate-100">
            <div class="flex items-center gap-3 mb-6">
                <div class="p-2 bg-blue-100 text-blue-600 rounded-lg">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z" />
                    </svg>
                </div>
                <h3 class="text-lg font-bold text-slate-800">Periode Pelaksanaan</h3>
            </div>

            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                <div class="group">
                    <label for="start_date" class="block text-xs font-bold text-slate-500 uppercase mb-2 ml-1">Tanggal Mulai <span class="text-rose-500">*</span></label>
                    <div class="relative">
                        <input type="text" name="start_date" id="start_date"
                            value="{{ old('start_date', $program->start_date?->format('Y-m-d')) }}"
                            required
                            class="datepicker block w-full pl-4 pr-10 py-3 bg-slate-50 border-slate-200 rounded-xl text-sm focus:ring-2 focus:ring-blue-500 focus:border-transparent transition-all cursor-pointer hover:bg-white"
                            placeholder="Pilih tanggal...">
                        <div class="absolute inset-y-0 right-0 pr-3 flex items-center pointer-events-none">
                            <svg class="h-5 w-5 text-slate-400" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z" />
                            </svg>
                        </div>
                    </div>
                    @error('start_date') <span class="text-rose-500 text-xs mt-1 block ml-1">{{ $message }}</span> @enderror
                </div>

                <div class="group">
                    <label for="end_date" class="block text-xs font-bold text-slate-500 uppercase mb-2 ml-1">Tanggal Selesai <span class="text-rose-500">*</span></label>
                    <div class="relative">
                        <input type="text" name="end_date" id="end_date"
                            value="{{ old('end_date', $program->end_date?->format('Y-m-d')) }}"
                            required
                            class="datepicker block w-full pl-4 pr-10 py-3 bg-slate-50 border-slate-200 rounded-xl text-sm focus:ring-2 focus:ring-blue-500 focus:border-transparent transition-all cursor-pointer hover:bg-white"
                            placeholder="Pilih tanggal...">
                        <div class="absolute inset-y-0 right-0 pr-3 flex items-center pointer-events-none">
                            <svg class="h-5 w-5 text-slate-400" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z" />
                            </svg>
                        </div>
                    </div>
                    @error('end_date') <span class="text-rose-500 text-xs mt-1 block ml-1">{{ $message }}</span> @enderror
                </div>
            </div>
        </div>

        {{-- 3. Opsi Program (Interactive Cards) --}}
        <div class="pt-6 border-t border-slate-100">
            <div class="flex items-center gap-3 mb-6">
                <div class="p-2 bg-amber-100 text-amber-600 rounded-lg">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10.325 4.317c.426-1.756 2.924-1.756 3.35 0a1.724 1.724 0 002.573 1.066c1.543-.94 3.31.826 2.37 2.37a1.724 1.724 0 001.065 2.572c1.756.426 1.756 2.924 0 3.35a1.724 1.724 0 00-1.066 2.573c.94 1.543-.826 3.31-2.37 2.37a1.724 1.724 0 00-2.572 1.065c-.426 1.756-2.924 1.756-3.35 0a1.724 1.724 0 00-2.573-1.066c-1.543.94-3.31-.826-2.37-2.37a1.724 1.724 0 00-1.065-2.572c-1.756-.426-1.756-2.924 0-3.35a1.724 1.724 0 001.066-2.573c-.94-1.543.826-3.31 2.37-2.37.996.608 2.296.07 2.572-1.065z" />
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" />
                    </svg>
                </div>
                <h3 class="text-lg font-bold text-slate-800">Pengaturan Lanjutan</h3>
            </div>

            <div class="grid grid-cols-1 md:grid-cols-3 gap-4">
                {{-- Option 1: Status Aktif --}}
                <label class="relative cursor-pointer group">
                    <input type="checkbox" name="is_active" value="1" class="peer sr-only" {{ old('is_active', $program->is_active ?? true) ? 'checked' : '' }}>
                    <div class="p-4 bg-white border-2 border-slate-100 rounded-2xl hover:border-emerald-300 peer-checked:border-emerald-500 peer-checked:bg-emerald-50 transition-all shadow-sm h-full">
                        <div class="flex items-center justify-between mb-2">
                            <div class="p-2 bg-emerald-100 text-emerald-600 rounded-lg">
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z" />
                                </svg>
                            </div>
                            <div class="w-6 h-6 rounded-full border-2 border-slate-200 peer-checked:border-emerald-500 peer-checked:bg-emerald-500 flex items-center justify-center transition-colors">
                                <svg class="w-4 h-4 text-white opacity-0 peer-checked:opacity-100" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="3" d="M5 13l4 4L19 7" />
                                </svg>
                            </div>
                        </div>
                        <p class="font-bold text-slate-700 group-hover:text-emerald-600">Status Aktif</p>
                        <p class="text-xs text-slate-400 mt-1">Survei dapat diakses oleh publik.</p>
                    </div>
                </label>

                {{-- Option 2: Wajib Pra-Survei --}}
                <label class="relative cursor-pointer group">
                    <input type="checkbox" name="requires_pre_survey" value="1" class="peer sr-only" {{ old('requires_pre_survey', $program->requires_pre_survey ?? true) ? 'checked' : '' }}>
                    <div class="p-4 bg-white border-2 border-slate-100 rounded-2xl hover:border-blue-300 peer-checked:border-blue-500 peer-checked:bg-blue-50 transition-all shadow-sm h-full">
                        <div class="flex items-center justify-between mb-2">
                            <div class="p-2 bg-blue-100 text-blue-600 rounded-lg">
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 6H5a2 2 0 00-2 2v9a2 2 0 002 2h14a2 2 0 002-2V8a2 2 0 00-2-2h-5m-4 0V5a2 2 0 114 0v1m-4 0c0 .884-.5 2-2 2h4c-1.5 0-2-1.116-2-2z" />
                                </svg>
                            </div>
                            <div class="w-6 h-6 rounded-full border-2 border-slate-200 peer-checked:border-blue-500 peer-checked:bg-blue-500 flex items-center justify-center transition-colors">
                                <svg class="w-4 h-4 text-white opacity-0 peer-checked:opacity-100" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="3" d="M5 13l4 4L19 7" />
                                </svg>
                            </div>
                        </div>
                        <p class="font-bold text-slate-700 group-hover:text-blue-600">Wajib Data Diri</p>
                        <p class="text-xs text-slate-400 mt-1">Responden wajib isi biodata.</p>
                    </div>
                </label>

                {{-- Option 3: Featured --}}
                <label class="relative cursor-pointer group">
                    <input type="checkbox" name="is_featured" value="1" class="peer sr-only" {{ old('is_featured', $program->is_featured ?? false) ? 'checked' : '' }}>
                    <div class="p-4 bg-white border-2 border-slate-100 rounded-2xl hover:border-amber-300 peer-checked:border-amber-500 peer-checked:bg-amber-50 transition-all shadow-sm h-full">
                        <div class="flex items-center justify-between mb-2">
                            <div class="p-2 bg-amber-100 text-amber-600 rounded-lg">
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11.049 2.927c.3-.921 1.603-.921 1.902 0l1.519 4.674a1 1 0 00.95.69h4.915c.969 0 1.371 1.24.588 1.81l-3.976 2.888a1 1 0 00-.363 1.118l1.518 4.674c.3.922-.755 1.688-1.538 1.118l-3.976-2.888a1 1 0 00-1.176 0l-3.976 2.888c-.783.57-1.838-.197-1.538-1.118l1.518-4.674a1 1 0 00-.363-1.118l-3.976-2.888c-.784-.57-.38-1.81.588-1.81h4.914a1 1 0 00.951-.69l1.519-4.674z" />
                                </svg>
                            </div>
                            <div class="w-6 h-6 rounded-full border-2 border-slate-200 peer-checked:border-amber-500 peer-checked:bg-amber-500 flex items-center justify-center transition-colors">
                                <svg class="w-4 h-4 text-white opacity-0 peer-checked:opacity-100" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="3" d="M5 13l4 4L19 7" />
                                </svg>
                            </div>
                        </div>
                        <p class="font-bold text-slate-700 group-hover:text-amber-600">Program Unggulan</p>
                        <p class="text-xs text-slate-400 mt-1">Tampil prioritas di beranda.</p>
                    </div>
                </label>
            </div>
        </div>

        {{-- 4. Target Unit Kerja --}}
        <div class="pt-6 border-t border-slate-100">
            <div class="flex flex-col md:flex-row md:items-center justify-between gap-4 mb-4">
                <div class="flex items-center gap-3">
                    <div class="p-2 bg-teal-100 text-teal-600 rounded-lg">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4" />
                        </svg>
                    </div>
                    <div>
                        <h3 class="text-lg font-bold text-slate-800">Target Unit Kerja <span class="text-rose-500">*</span></h3>
                        <p class="text-xs text-slate-500">Pilih unit yang akan berpartisipasi.</p>
                    </div>
                </div>
                <div class="flex gap-2">
                    <button type="button" id="select-all-button" class="px-3 py-1.5 text-xs font-bold text-indigo-600 bg-indigo-50 rounded-lg hover:bg-indigo-100 transition-colors">
                        + Pilih Semua
                    </button>
                    <button type="button" id="deselect-all-button" class="px-3 py-1.5 text-xs font-bold text-slate-600 bg-slate-100 rounded-lg hover:bg-slate-200 transition-colors">
                        x Hapus Semua
                    </button>
                </div>
            </div>

            <select
                name="targeted_unit_kerjas[]"
                id="targeted_unit_kerjas_select"
                multiple
                class="block w-full rounded-xl border-slate-200 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 sm:text-sm p-4"
                placeholder="Klik untuk mencari unit...">
                @foreach($unitKerjas as $unit)
                <option value="{{ $unit->id }}"
                    {{ in_array($unit->id, old('targeted_unit_kerjas', $program->targetedUnitKerjas?->pluck('id')->toArray() ?? [])) ? 'selected' : '' }}>
                    {{ $unit->unit_kerja_name }}
                </option>
                @endforeach
            </select>
            @error('targeted_unit_kerjas') <span class="text-rose-500 text-xs mt-1 block ml-1">{{ $message }}</span> @enderror
        </div>

        {{-- Footer Buttons --}}
        <div class="pt-6 border-t border-slate-100 flex flex-col-reverse md:flex-row justify-end gap-3">
            <a href="{{ route('superadmin.programs.index') }}"
                class="px-6 py-3 rounded-xl text-sm font-bold text-slate-600 bg-white border border-slate-200 hover:bg-slate-50 transition-all text-center">
                Batal
            </a>
            <button type="submit"
                class="px-6 py-3 rounded-xl text-sm font-bold text-white bg-gradient-to-r from-indigo-600 to-purple-600 hover:from-indigo-500 hover:to-purple-500 shadow-lg hover:shadow-indigo-500/30 hover:-translate-y-1 transition-all">
                Simpan Program
            </button>
        </div>
    </div>
</div>