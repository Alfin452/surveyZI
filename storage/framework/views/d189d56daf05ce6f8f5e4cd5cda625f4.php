

<?php $__env->startSection('content'); ?>

<div class="absolute top-0 left-0 w-full h-full overflow-hidden -z-10 pointer-events-none">
    <div class="absolute top-0 left-1/4 w-96 h-96 bg-emerald-400/20 rounded-full mix-blend-multiply filter blur-3xl animate-blob"></div>
    <div class="absolute top-0 right-1/4 w-96 h-96 bg-teal-400/20 rounded-full mix-blend-multiply filter blur-3xl animate-blob animation-delay-2000"></div>
    <div class="absolute -bottom-8 left-1/3 w-96 h-96 bg-cyan-400/20 rounded-full mix-blend-multiply filter blur-3xl animate-blob animation-delay-4000"></div>
</div>

<div class="relative z-10 space-y-6">

    
    <div class="bg-white/60 backdrop-blur-xl rounded-3xl px-6 py-5 border border-white/40 shadow-lg relative overflow-hidden group hover:shadow-emerald-100/50 transition-all duration-500">
        <div class="absolute inset-0 bg-gradient-to-r from-emerald-500/5 via-teal-500/5 to-cyan-500/5 opacity-0 group-hover:opacity-100 transition-opacity duration-500"></div>

        <div class="relative flex flex-col md:flex-row items-start md:items-center justify-between gap-4">
            <div class="flex items-center gap-4">
                
                <div class="w-14 h-14 flex-shrink-0 drop-shadow-lg">
                    <img src="https://raw.githubusercontent.com/Tarikul-Islam-Anik/Animated-Fluent-Emojis/master/Emojis/Travel%20and%20places/Office%20Building.png" alt="Create Unit" class="w-full h-full object-contain">
                </div>
                <div>
                    <h1 class="text-2xl font-black text-slate-800 tracking-tight">Tambah Unit Kerja</h1>
                    <p class="text-slate-500 text-sm font-medium mt-0.5">Daftarkan fakultas, lembaga, atau unit layanan baru.</p>
                </div>
            </div>

            <a href="<?php echo e(route('superadmin.unit-kerja.index')); ?>"
                class="group flex items-center gap-2 px-5 py-2.5 bg-white text-slate-600 border border-slate-200 rounded-xl font-bold shadow-sm hover:bg-slate-50 hover:text-emerald-600 transition-all duration-300 text-sm">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 group-hover:-translate-x-1 transition-transform" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18" />
                </svg>
                <span>Kembali</span>
            </a>
        </div>
    </div>

    
    <form action="<?php echo e(route('superadmin.unit-kerja.store')); ?>" method="POST">
        <?php echo csrf_field(); ?>
        <?php echo $__env->make('superadmin.unit_kerja._form', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?>
    </form>

</div>
<?php $__env->stopSection(); ?>

<?php $__env->startPush('scripts'); ?>
<script>
    document.addEventListener('DOMContentLoaded', function() {
        // Inisialisasi TomSelect dan simpan instansinya
        const tsTipe = new TomSelect('#tipe_unit_id', {
            placeholder: 'Pilih tipe unit...',
        });
        const tsParent = new TomSelect('#parent_id', {
            placeholder: 'Pilih induk unit (jika ada)...',
        });

        // Hapus style error TomSelect jika pengguna mulai memilih
        tsTipe.on('change', () => tsTipe.wrapper.classList.remove('tomselect-error'));
        tsParent.on('change', () => tsParent.wrapper.classList.remove('tomselect-error'));

        // Terapkan style error TomSelect HANYA jika ada error dari server (Laravel)
        <?php if($errors -> has('tipe_unit_id')): ?>
        tsTipe.wrapper.classList.add('tomselect-error');
        <?php endif; ?>

        <?php if($errors -> has('parent_id')): ?>
        tsParent.wrapper.classList.add('tomselect-error');
        <?php endif; ?>
    });
</script>

<style>
    /* Style untuk error border pada TomSelect */
    .tomselect-error .ts-control {
        border-color: #f43f5e !important;
        /* Rose-500 */
        box-shadow: 0 0 0 1px #f43f5e !important;
    }

    /* Penyesuaian TomSelect dengan Desain Aurora */
    .ts-control {
        border-radius: 0.75rem !important;
        /* rounded-xl */
        padding-top: 0.75rem !important;
        padding-bottom: 0.75rem !important;
        border-color: #e2e8f0 !important;
        /* slate-200 */
        background-color: #f8fafc !important;
        /* slate-50 */
    }

    .ts-wrapper.focus .ts-control {
        background-color: #ffffff !important;
        border-color: #10b981 !important;
        /* emerald-500 */
        box-shadow: 0 0 0 2px rgba(16, 185, 129, 0.2) !important;
    }
</style>
<?php $__env->stopPush(); ?>
<?php echo $__env->make('layouts.superadmin', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\laragon\www\surveyZI\resources\views/superadmin/unit_kerja/create.blade.php ENDPATH**/ ?>