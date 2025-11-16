

<?php $__env->startSection('content'); ?>
<div class="p-2 space-y-6">

    
    <div class="bg-white rounded-lg p-5 border border-gray-200 shadow-sm">
        <div class="flex items-start gap-3">
            <div class="flex-shrink-0 bg-blue-500 text-white p-2 rounded-md">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z" />
                </svg>
            </div>
            <div>
                <h1 class="text-xl font-bold text-gray-800">Edit Unit Kerja</h1>
                <p class="text-sm text-gray-500 mt-1">Perbarui detail untuk unit kerja: <span class="font-semibold"><?php echo e($unitKerja->unit_kerja_name); ?></span></p>
            </div>
        </div>
    </div>

    
    <form action="<?php echo e(route('superadmin.unit-kerja.update', $unitKerja)); ?>" method="POST">
        <?php echo csrf_field(); ?>
        <?php echo method_field('PUT'); ?>
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
        @apply border-red-500 ring-1 ring-red-500;
    }

    .min-h-5 {
        min-height: 1.25rem;
        /* 20px */
    }
</style>
<?php $__env->stopPush(); ?>
<?php echo $__env->make('layouts.superadmin', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\laragon\www\surveyZI\resources\views/superadmin/unit_kerja/edit.blade.php ENDPATH**/ ?>