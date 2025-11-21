
<?php if (isset($component)) { $__componentOriginal69dc84650370d1d4dc1b42d016d7226b = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginal69dc84650370d1d4dc1b42d016d7226b = $attributes; } ?>
<?php $component = App\View\Components\GuestLayout::resolve([] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('guest-layout'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\App\View\Components\GuestLayout::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes(['title' => 'Riwayat Survei Saya']); ?>

    <main class="w-full max-w-3xl mx-auto py-12 px-4 mt-10">
        
        <div class="text-center mb-8 section-title-anim">
            <h1 class="text-3xl font-extrabold text-gray-900">Riwayat Survei</h1>
            <p class="text-gray-600 mt-2">Berikut adalah daftar semua survei yang telah Anda ikuti.</p>
        </div>

        
        <div class="bg-white rounded-xl shadow-lg border p-6 sm:p-8 section-title-anim">
            <div class="flow-root">
                <div class="-my-8 divide-y divide-gray-200">

                    <?php $__empty_1 = true; $__currentLoopData = $responses; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $response): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
                    <div class="py-8">
                        <div class="flex items-center space-x-4">
                            <div class="flex-shrink-0 bg-indigo-100 text-indigo-600 h-12 w-12 rounded-full flex items-center justify-center">
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M9 12l2 2 4-4m6-4a9 9 0 11-18 0 9 9 0 0118 0z" />
                                </svg>
                            </div>
                            <div class="flex-1 min-w-0">
                                <p class="text-base font-semibold text-gray-900 truncate">
                                    <?php echo e($response->surveyProgram->title); ?>

                                </p>
                                <p class="text-sm text-gray-500 truncate">
                                    Untuk unit: <span class="font-medium"><?php echo e($response->unitKerja->unit_kerja_name); ?></span>
                                </p>
                                <p class="text-sm text-gray-400 mt-1">
                                    
                                    Diselesaikan pada: <?php echo e(\Carbon\Carbon::parse($response->completed_at)->format('d M Y, H:i')); ?>

                                </p>
                            </div>
                            <div>
                                <span class="inline-flex items-center px-3 py-1.5 rounded-full text-xs font-medium bg-green-100 text-green-800">
                                    Selesai
                                </span>
                            </div>
                        </div>
                    </div>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
                    <div class="py-12 text-center">
                        <svg xmlns="http://www.w3.org/2000/svg" class="mx-auto h-12 w-12 text-gray-400" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="1">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z" />
                        </svg>
                        <h3 class="mt-2 text-lg font-medium text-gray-900">Belum Ada Riwayat</h3>
                        <p class="mt-1 text-sm text-gray-500">Anda belum menyelesaikan survei apapun.</p>
                        <div class="mt-6">
                            <a href="<?php echo e(route('home')); ?>#program-survei" class="inline-flex items-center px-4 py-2 border border-transparent shadow-sm text-sm font-medium rounded-md text-white bg-indigo-600 hover:bg-indigo-700">
                                Mulai Isi Survei
                            </a>
                        </div>
                    </div>
                    <?php endif; ?>
                </div>
            </div>
        </div>

        
        <div class="mt-8">
            <?php echo e($responses->links()); ?>

        </div>
    </main>
 <?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__attributesOriginal69dc84650370d1d4dc1b42d016d7226b)): ?>
<?php $attributes = $__attributesOriginal69dc84650370d1d4dc1b42d016d7226b; ?>
<?php unset($__attributesOriginal69dc84650370d1d4dc1b42d016d7226b); ?>
<?php endif; ?>
<?php if (isset($__componentOriginal69dc84650370d1d4dc1b42d016d7226b)): ?>
<?php $component = $__componentOriginal69dc84650370d1d4dc1b42d016d7226b; ?>
<?php unset($__componentOriginal69dc84650370d1d4dc1b42d016d7226b); ?>
<?php endif; ?><?php /**PATH C:\laragon\www\surveyZI\resources\views/public/profile/history.blade.php ENDPATH**/ ?>