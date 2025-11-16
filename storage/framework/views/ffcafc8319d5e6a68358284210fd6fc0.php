

<?php $__env->startSection('content'); ?>
<div class="space-y-1">
    
    <div class="bg-white rounded-lg p-5 border border-gray-200 shadow-sm">
        <div class="flex items-start gap-3">
            <div class="flex-shrink-0 bg-indigo-500 text-white p-2 rounded-md">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M9 13h6m-3-3v6m5 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z" />
                </svg>
            </div>
            <div>
                <h1 class="text-xl font-bold text-gray-800">Buat Program Survei Baru</h1>
                <p class="text-sm text-gray-500 mt-1">Buat "wadah" survei baru dan targetkan ke unit kerja.</p>
            </div>
        </div>
    </div>

    
    <form action="<?php echo e(route('superadmin.programs.store')); ?>" method="POST">
        <?php echo csrf_field(); ?>
        <?php echo $__env->make('superadmin.programs._form', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?>
    </form>
</div>
<?php $__env->stopSection(); ?>

<?php $__env->startPush('scripts'); ?>
<script>
    document.addEventListener('DOMContentLoaded', function() {
        const select = document.getElementById('targeted_unit_kerjas_select');
        if (!select) return;

        const tomSelect = new TomSelect(select, {
            placeholder: 'Pilih minimal satu unit kerja...',
            plugins: ['remove_button'],
            maxOptions: 200,
        });

        // Logika untuk tombol "Pilih Semua" dan "Hapus Semua"
        const btnSelectAll = document.getElementById('select-all-button');
        const btnDeselectAll = document.getElementById('deselect-all-button');

        if (btnSelectAll && btnDeselectAll) {
            btnSelectAll.addEventListener('click', () => {
                const allOptionIds = Object.keys(tomSelect.options);
                tomSelect.setValue(allOptionIds);
            });

            btnDeselectAll.addEventListener('click', () => {
                tomSelect.clear();
            });
        }

        // Hapus style error TomSelect jika pengguna mulai memilih
        tomSelect.on('change', function() {
            if (tomSelect.items.length > 0) {
                tomSelect.wrapper.classList.remove('tomselect-error');
            }
        });

        // Terapkan style error TomSelect HANYA jika ada error dari server (Laravel)
        <?php if($errors -> has('targeted_unit_kerjas')): ?>
        tomSelect.wrapper.classList.add('tomselect-error');
        <?php endif; ?>
    });
</script>

<style>
    .tomselect-error .ts-control {
        @apply border-red-500 ring-1 ring-red-500;
    }

    #targeted_unit_kerjas_select {
        display: none !important;
    }

    .min-h-5 {
        min-height: 1.25rem;
        /* 20px */
    }
</style>
<?php $__env->stopPush(); ?>
<?php echo $__env->make('layouts.superadmin', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\laragon\www\surveyZI\resources\views/superadmin/programs/create.blade.php ENDPATH**/ ?>