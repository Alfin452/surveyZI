

<?php $__env->startSection('content'); ?>

<div class="absolute top-0 left-0 w-full h-full overflow-hidden -z-10 pointer-events-none">
    <div class="absolute top-0 left-1/4 w-96 h-96 bg-purple-400/20 rounded-full mix-blend-multiply filter blur-3xl animate-blob"></div>
    <div class="absolute top-0 right-1/4 w-96 h-96 bg-indigo-400/20 rounded-full mix-blend-multiply filter blur-3xl animate-blob animation-delay-2000"></div>
    <div class="absolute -bottom-8 left-1/3 w-96 h-96 bg-blue-400/20 rounded-full mix-blend-multiply filter blur-3xl animate-blob animation-delay-4000"></div>
</div>

<div class="relative z-10 space-y-6">

    
    <div class="bg-white/60 backdrop-blur-xl rounded-3xl px-6 py-5 border border-white/40 shadow-lg relative overflow-hidden">
        <div class="flex flex-col md:flex-row items-start md:items-center justify-between gap-4">
            <div class="flex items-center gap-4">
                
                <div class="w-14 h-14 flex-shrink-0 drop-shadow-lg bg-white rounded-2xl flex items-center justify-center text-purple-600">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-8 w-8" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M19 11H5m14 0a2 2 0 012 2v6a2 2 0 01-2 2H5a2 2 0 01-2-2v-6a2 2 0 012-2m14 0V9a2 2 0 00-2-2M5 11V9a2 2 0 012-2m0 0V5a2 2 0 012-2h6a2 2 0 012 2v2M7 7h10" />
                    </svg>
                </div>
                <div>
                    <h1 class="text-2xl font-black text-slate-800 tracking-tight">Form Builder Data Diri</h1>
                    <p class="text-slate-500 text-sm font-medium mt-0.5">
                        Program: <span class="font-bold text-purple-600"><?php echo e($program->title); ?></span>
                    </p>
                </div>
            </div>

            <a href="<?php echo e(route('superadmin.programs.index')); ?>"
                class="group flex items-center gap-2 px-5 py-2.5 bg-white text-slate-600 border border-slate-200 rounded-xl font-bold shadow-sm hover:bg-slate-50 hover:text-purple-600 transition-all duration-300 text-sm">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 group-hover:-translate-x-1 transition-transform" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18" />
                </svg>
                <span>Kembali</span>
            </a>
        </div>
    </div>

    
    <div class="bg-white/80 backdrop-blur-xl border border-white/60 shadow-xl rounded-3xl p-6 md:p-8">

        <div class="mb-8 border-b border-slate-200 pb-4 flex justify-between items-center">
            <div>
                <h3 class="text-lg font-bold text-slate-800">Konfigurasi Field (Pre-Survey)</h3>
                <p class="text-sm text-slate-500">Atur pertanyaan data diri yang wajib diisi responden.</p>
            </div>
            <button type="button" onclick="location.reload()" class="text-xs text-slate-400 hover:text-purple-600 underline">
                Reset ke Default
            </button>
        </div>

        
        <form action="<?php echo e(route('superadmin.programs.builder.update', $program)); ?>" method="POST"
            x-data="formBuilder(<?php echo e($program->formFields->toJson()); ?>)">
            <?php echo csrf_field(); ?>
            <?php echo method_field('PUT'); ?>

            
            <div class="space-y-4" id="fields-container">
                <template x-for="(field, index) in fields" :key="index">
                    <div class="border border-slate-200 rounded-2xl p-5 bg-slate-50/50 relative group transition-all hover:shadow-md hover:bg-white hover:border-purple-200">

                        
                        <div class="absolute -left-3 top-5 w-8 h-8 bg-white border border-slate-200 rounded-full flex items-center justify-center text-slate-400 font-bold text-xs shadow-sm group-hover:border-purple-300 group-hover:text-purple-600">
                            <span x-text="index + 1"></span>
                        </div>

                        <div class="pl-4 grid grid-cols-1 md:grid-cols-12 gap-5 items-start">

                            
                            <div class="md:col-span-4">
                                <label class="block text-xs font-bold text-slate-500 uppercase tracking-wider mb-1.5">Label Pertanyaan</label>
                                <input type="text" :name="`fields[${index}][label]`"
                                    x-model="field.field_label"
                                    @input="autoFillKey(index)"
                                    required
                                    class="w-full rounded-xl border-slate-200 shadow-sm focus:border-purple-500 focus:ring-purple-500 sm:text-sm py-2.5 px-3 font-semibold text-slate-700"
                                    placeholder="Contoh: Nama Lengkap">
                            </div>

                            
                            <div class="md:col-span-3">
                                <label class="block text-xs font-bold text-slate-500 uppercase tracking-wider mb-1.5">
                                    Database Key <span class="text-[9px] text-purple-500 lowercase">(slug)</span>
                                </label>
                                <div class="relative">
                                    
                                    <input type="text" :name="`fields[${index}][key]`"
                                        x-model="field.field_key"
                                        required
                                        pattern="[a-z0-9_]+"
                                        title="Hanya huruf kecil, angka, dan underscore"
                                        class="w-full rounded-xl border-slate-200 bg-slate-100/50 shadow-sm focus:border-purple-500 focus:ring-purple-500 sm:text-sm py-2.5 px-3 font-mono text-slate-600 placeholder:text-slate-300"
                                        placeholder="nama_lengkap">
                                </div>
                            </div>

                            
                            <div class="md:col-span-3">
                                <label class="block text-xs font-bold text-slate-500 uppercase tracking-wider mb-1.5">Tipe & Validasi</label>
                                <div class="flex gap-2">
                                    <div class="relative w-full">
                                        <select :name="`fields[${index}][type]`" x-model="field.field_type"
                                            class="w-full rounded-xl border-slate-200 shadow-sm focus:border-purple-500 focus:ring-purple-500 sm:text-sm py-2.5 px-3 appearance-none cursor-pointer">
                                            <option value="text">Teks Singkat</option>
                                            <option value="number">Angka (Number)</option>
                                            <option value="date">Tanggal</option>
                                            <option value="select">Dropdown</option>
                                            <option value="radio">Radio Button</option>
                                        </select>
                                    </div>
                                    
                                    <div x-show="['text', 'number'].includes(field.field_type)" class="w-20 flex-shrink-0" title="Maksimal Karakter/Digit">
                                        <input type="number" :name="`fields[${index}][max_length]`"
                                            x-model="field.max_length"
                                            class="w-full rounded-xl border-slate-200 shadow-sm focus:border-purple-500 focus:ring-purple-500 sm:text-sm py-2.5 px-2 text-center text-slate-600 placeholder:text-slate-300"
                                            placeholder="Max">
                                    </div>
                                </div>
                            </div>

                            
                            <div class="md:col-span-12 md:col-start-5 bg-purple-50/50 rounded-xl p-4 mt-2"
                                x-show="['select', 'radio'].includes(field.field_type)" x-transition>
                                <label class="block text-xs font-bold text-purple-600 uppercase tracking-wider mb-1.5">
                                    Opsi Jawaban <span class="text-[9px] normal-case text-slate-400">(Pisahkan koma)</span>
                                </label>
                                <input type="text" :name="`fields[${index}][options]`"
                                    x-model="field.options_string"
                                    :required="['select', 'radio'].includes(field.field_type)"
                                    class="w-full rounded-xl border-purple-200 bg-white shadow-sm focus:border-purple-500 focus:ring-purple-500 sm:text-sm py-2.5 px-3 transition-colors placeholder-purple-300"
                                    placeholder="Contoh: Pria, Wanita">
                            </div>

                            
                            <div class="md:col-span-2 flex items-center justify-end gap-4 pt-7">
                                <label class="inline-flex items-center cursor-pointer select-none group/check">
                                    <input type="checkbox" :name="`fields[${index}][required]`" value="1" x-model="field.is_required"
                                        class="rounded border-slate-300 text-purple-600 shadow-sm focus:border-purple-500 focus:ring focus:ring-purple-200 focus:ring-opacity-50 cursor-pointer">
                                    <span class="ml-2 text-sm font-bold text-slate-500 group-hover/check:text-purple-600">Wajib</span>
                                </label>

                                <button type="button" @click="removeField(index)"
                                    class="p-2 rounded-lg text-slate-400 hover:text-rose-600 hover:bg-rose-50 transition-all" title="Hapus Field">
                                    <svg class="w-5 h-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16" />
                                    </svg>
                                </button>
                            </div>

                        </div>
                    </div>
                </template>

                <div x-show="fields.length === 0" class="text-center py-12 border-2 border-dashed border-slate-300 rounded-3xl bg-slate-50/30">
                    <p class="text-slate-500 font-medium">Belum ada pertanyaan.</p>
                </div>
            </div>

            
            <div class="mt-8 flex justify-between items-center border-t border-slate-100 pt-6">
                <button type="button" @click="addField()"
                    class="inline-flex items-center gap-2 px-5 py-2.5 bg-white border border-slate-200 rounded-xl font-bold text-xs text-slate-600 uppercase tracking-widest shadow-sm hover:bg-slate-50 hover:text-purple-600 hover:border-purple-200 transition-all">
                    <svg class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4" />
                    </svg>
                    Tambah Pertanyaan
                </button>

                <button type="submit"
                    class="inline-flex items-center gap-2 px-6 py-2.5 bg-purple-600 border border-transparent rounded-xl font-bold text-xs text-white uppercase tracking-widest hover:bg-purple-700 hover:shadow-purple-500/30 shadow-lg transition-all">
                    <svg class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7" />
                    </svg>
                    Simpan Konfigurasi
                </button>
            </div>
        </form>
    </div>
</div>
<?php $__env->stopSection(); ?>

<?php $__env->startPush('scripts'); ?>
<script>
    function formBuilder(initialData) {
        let fieldsData = [];

        // --- LOGIKA AUTO TEMPLATE ---
        if (!initialData || initialData.length === 0) {
            // Kita update template default Anda dengan field_key dan max_length
            fieldsData = [{
                    field_label: 'Nama Lengkap',
                    field_key: 'nama_lengkap', // Baru
                    field_type: 'text',
                    options_string: '',
                    is_required: true,
                    max_length: 100 // Baru
                },
                {
                    field_label: 'Usia',
                    field_key: 'usia', // Baru
                    field_type: 'number',
                    options_string: '',
                    is_required: true,
                    max_length: 3 // Baru (misal max 3 digit)
                },
                {
                    field_label: 'Jenis Kelamin',
                    field_key: 'jenis_kelamin', // Baru
                    field_type: 'radio',
                    options_string: 'Laki-laki, Perempuan',
                    is_required: true,
                    max_length: null
                },
                {
                    field_label: 'Status',
                    field_key: 'status', // Baru
                    field_type: 'select',
                    options_string: 'Mahasiswa, Dosen, Tenaga Kependidikan, Alumni, Masyarakat Umum, Mitra Kerjasama',
                    is_required: true,
                    max_length: null
                },
                {
                    field_label: 'Fakultas / Unit Asal',
                    field_key: 'fakultas_unit_asal', // Baru
                    field_type: 'text',
                    options_string: '',
                    is_required: true,
                    max_length: 100
                }
            ];
        } else {
            // Jika load dari DB, pastikan property baru tetap ada (handle null)
            fieldsData = initialData.map(f => ({
                ...f,
                options_string: Array.isArray(f.field_options) ? f.field_options.join(', ') : '',
                field_key: f.field_key || '', // Handle data lama
                max_length: f.max_length || null // Handle data lama
            }));
        }

        return {
            fields: fieldsData,

            // --- FUNGSI BARU: AUTO FILL KEY ---
            autoFillKey(index) {
                let label = this.fields[index].field_label;
                // Ubah ke lowercase, spasi jadi underscore, hapus simbol
                let slug = label.toLowerCase()
                    .replace(/[^\w\s]/gi, '')
                    .replace(/\s+/g, '_');

                // Isi ke field key
                this.fields[index].field_key = slug;
            },

            addField() {
                this.fields.push({
                    field_label: '',
                    field_key: '', // Baru
                    field_type: 'text',
                    options_string: '',
                    is_required: true,
                    max_length: null // Baru
                });
            },

            removeField(index) {
                let f = this.fields[index];
                if (!f.field_label && !f.options_string) {
                    this.fields.splice(index, 1);
                    return;
                }

                if (confirm('Hapus pertanyaan ini?')) {
                    this.fields.splice(index, 1);
                }
            }
        }
    }
</script>
<?php $__env->stopPush(); ?>
<?php echo $__env->make('layouts.superadmin', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\laragon\www\surveyZI\resources\views/superadmin/programs/builder.blade.php ENDPATH**/ ?>