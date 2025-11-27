

<?php $__env->startSection('content'); ?>

<div class="absolute top-0 left-0 w-full h-full overflow-hidden -z-10 pointer-events-none">
    <div class="absolute top-0 left-1/4 w-96 h-96 bg-teal-400/20 rounded-full mix-blend-multiply filter blur-3xl animate-blob"></div>
    <div class="absolute top-0 right-1/4 w-96 h-96 bg-emerald-400/20 rounded-full mix-blend-multiply filter blur-3xl animate-blob animation-delay-2000"></div>
    <div class="absolute -bottom-8 left-1/3 w-96 h-96 bg-cyan-400/20 rounded-full mix-blend-multiply filter blur-3xl animate-blob animation-delay-4000"></div>
</div>

<div class="relative z-10 space-y-6">

    
    <div class="bg-white/60 backdrop-blur-xl rounded-3xl px-6 py-5 border border-white/40 shadow-lg relative overflow-hidden">
        <div class="flex flex-col md:flex-row items-start md:items-center justify-between gap-4">
            <div class="flex items-center gap-4">
                
                <div class="w-14 h-14 flex-shrink-0 drop-shadow-lg bg-white rounded-2xl flex items-center justify-center text-teal-600">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-8 w-8" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M19 11H5m14 0a2 2 0 012 2v6a2 2 0 01-2 2H5a2 2 0 01-2-2v-6a2 2 0 012-2m14 0V9a2 2 0 00-2-2M5 11V9a2 2 0 012-2m0 0V5a2 2 0 012-2h6a2 2 0 012 2v2M7 7h10" />
                    </svg>
                </div>
                <div>
                    <h1 class="text-2xl font-black text-slate-800 tracking-tight">Form Builder Data Diri</h1>
                    <p class="text-slate-500 text-sm font-medium mt-0.5">
                        Program: <span class="font-bold text-teal-600"><?php echo e($program->title); ?></span>
                    </p>
                </div>
            </div>

            <a href="<?php echo e(route('unitkerja.admin.programs.index', ['tab' => 'myPrograms'])); ?>"
                class="group flex items-center gap-2 px-5 py-2.5 bg-white text-slate-600 border border-slate-200 rounded-xl font-bold shadow-sm hover:bg-slate-50 hover:text-teal-600 transition-all duration-300 text-sm">
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
            <button type="button" onclick="location.reload()" class="text-xs text-slate-400 hover:text-teal-600 underline">
                Reset ke Default
            </button>
        </div>

        
        
        <form action="<?php echo e(route('unitkerja.admin.my-programs.builder.update', $program)); ?>" method="POST"
            x-data="formBuilder(<?php echo e($program->formFields->toJson()); ?>)">
            <?php echo csrf_field(); ?>
            <?php echo method_field('PUT'); ?>

            
            <div class="space-y-4" id="fields-container">
                <template x-for="(field, index) in fields" :key="index">
                    <div class="border border-slate-200 rounded-2xl p-5 bg-slate-50/50 relative group transition-all hover:shadow-md hover:bg-white hover:border-teal-200">

                        
                        <div class="absolute -left-3 top-5 w-8 h-8 bg-white border border-slate-200 rounded-full flex items-center justify-center text-slate-400 font-bold text-xs shadow-sm group-hover:border-teal-300 group-hover:text-teal-600">
                            <span x-text="index + 1"></span>
                        </div>

                        <div class="pl-4 grid grid-cols-1 md:grid-cols-12 gap-5 items-start">

                            
                            <div class="md:col-span-4">
                                <label class="block text-xs font-bold text-slate-500 uppercase tracking-wider mb-1.5">Label Pertanyaan</label>
                                <input type="text" :name="`fields[${index}][label]`" x-model="field.field_label" required
                                    class="w-full rounded-xl border-slate-200 shadow-sm focus:border-teal-500 focus:ring-teal-500 sm:text-sm py-2.5 px-3 font-semibold text-slate-700"
                                    placeholder="Contoh: NIM / Tahun Masuk">
                            </div>

                            
                            <div class="md:col-span-3">
                                <label class="block text-xs font-bold text-slate-500 uppercase tracking-wider mb-1.5">Tipe Input</label>
                                <div class="relative">
                                    <select :name="`fields[${index}][type]`" x-model="field.field_type"
                                        class="w-full rounded-xl border-slate-200 shadow-sm focus:border-teal-500 focus:ring-teal-500 sm:text-sm py-2.5 px-3 appearance-none cursor-pointer">
                                        <option value="text">Teks Singkat</option>
                                        <option value="number">Angka (Number)</option>
                                        <option value="date">Tanggal</option>
                                        <option value="select">Dropdown (Pilihan)</option>
                                        <option value="radio">Radio Button (Pilihan)</option>
                                    </select>
                                    <div class="absolute inset-y-0 right-0 flex items-center px-2 pointer-events-none text-slate-400">
                                        <svg class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7" />
                                        </svg>
                                    </div>
                                </div>
                            </div>

                            
                            <div class="md:col-span-3" x-show="['select', 'radio'].includes(field.field_type)" x-transition>
                                <label class="block text-xs font-bold text-teal-600 uppercase tracking-wider mb-1.5">
                                    Opsi Jawaban <span class="text-[9px] normal-case text-slate-400">(Pisahkan koma)</span>
                                </label>
                                <input type="text" :name="`fields[${index}][options]`"
                                    x-model="field.options_string"
                                    :required="['select', 'radio'].includes(field.field_type)"
                                    class="w-full rounded-xl border-teal-200 bg-teal-50/30 shadow-sm focus:border-teal-500 focus:ring-teal-500 sm:text-sm py-2.5 px-3 transition-colors placeholder-teal-300"
                                    placeholder="Contoh: Pria, Wanita">
                            </div>

                            
                            <div class="md:col-span-3" x-show="!['select', 'radio'].includes(field.field_type)"></div>

                            
                            <div class="md:col-span-2 flex items-center justify-end gap-4 pt-7">
                                <label class="inline-flex items-center cursor-pointer select-none group/check">
                                    <input type="checkbox" :name="`fields[${index}][required]`" value="1" x-model="field.is_required"
                                        class="rounded border-slate-300 text-teal-600 shadow-sm focus:border-teal-500 focus:ring focus:ring-teal-200 focus:ring-opacity-50 cursor-pointer">
                                    <span class="ml-2 text-sm font-bold text-slate-500 group-hover/check:text-teal-600 transition-colors">Wajib</span>
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
                    class="inline-flex items-center gap-2 px-5 py-2.5 bg-white border border-slate-200 rounded-xl font-bold text-xs text-slate-600 uppercase tracking-widest shadow-sm hover:bg-slate-50 hover:text-teal-600 hover:border-teal-200 transition-all">
                    <svg class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4" />
                    </svg>
                    Tambah Pertanyaan
                </button>

                <button type="submit"
                    class="inline-flex items-center gap-2 px-6 py-2.5 bg-gradient-to-r from-teal-600 to-emerald-600 border border-transparent rounded-xl font-bold text-xs text-white uppercase tracking-widest hover:from-teal-700 hover:to-emerald-700 focus:outline-none focus:ring-2 focus:ring-teal-500 focus:ring-offset-2 transition-all shadow-lg hover:shadow-teal-500/30 hover:-translate-y-0.5">
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
            fieldsData = [{
                    field_label: 'Nama Lengkap',
                    field_type: 'text',
                    options_string: '',
                    is_required: true
                },
                {
                    field_label: 'Usia',
                    field_type: 'number',
                    options_string: '',
                    is_required: true
                },
                {
                    field_label: 'Jenis Kelamin',
                    field_type: 'radio',
                    options_string: 'Laki-laki, Perempuan',
                    is_required: true
                }
            ];
        } else {
            // Jika sudah ada data, gunakan data tersebut
            fieldsData = initialData.map(f => ({
                ...f,
                // Konversi array JSON ke string untuk edit
                options_string: Array.isArray(f.field_options) ? f.field_options.join(', ') : ''
            }));
        }

        return {
            fields: fieldsData,

            addField() {
                this.fields.push({
                    field_label: '',
                    field_type: 'text',
                    options_string: '',
                    is_required: true
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
<?php echo $__env->make('layouts.unit_kerja_admin', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\laragon\www\surveyZI\resources\views/unit_kerja_admin/programs/builder.blade.php ENDPATH**/ ?>