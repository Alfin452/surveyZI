

<?php $__env->startSection('content'); ?>
<div class="space-y-3">
    <div class="bg-white rounded-lg p-5 border border-gray-200 shadow-sm">
        <div class="flex flex-col md:flex-row md:justify-between md:items-start">
            <div>
                
                <nav class="text-sm mb-2 font-medium text-gray-500" aria-label="Breadcrumb">
                    <ol class="list-none p-0 inline-flex">
                        <li class="flex items-center"><a href="<?php echo e(route('unitkerja.admin.dashboard')); ?>" class="hover:text-teal-600">Dashboard</a><span class="mx-2">/</span></li>
                        <li class="flex items-center"><a href="<?php echo e(route('unitkerja.admin.programs.index')); ?>" class="hover:text-teal-600">Program Survei</a><span class="mx-2">/</span></li>
                        <li class="flex items-center"><span class="text-gray-700">Hasil Survei</span></li>
                    </ol>
                </nav>
                <div class="flex items-start gap-3">
                    <div class="flex-shrink-0 bg-teal-500 text-white p-2 rounded-md">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M9 19v-6a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2a2 2 0 002-2zm0 0V9a2 2 0 012-2h2a2 2 0 012 2v10m-6 0a2 2 0 002 2h2a2 2 0 002-2m0 0V5a2 2 0 012-2h2a2 2 0 012 2v14a2 2 0 01-2 2h-2a2 2 0 01-2-2z" />
                        </svg>
                    </div>
                    <div>
                        
                        <h1 class="text-xl font-bold text-gray-800">Hasil Survei</h1>
                        <p class="text-sm text-gray-500 mt-1">Program: <span class="font-semibold"><?php echo e($program->title); ?></span></p>
                        <p class="text-sm text-gray-500">Unit: <span class="font-semibold"><?php echo e($unitKerja->unit_kerja_name); ?></span></p>
                    </div>
                </div>
            </div>
            <div class="mt-4 md:mt-0 flex space-x-2 self-start md:self-end">
                
                <a href="<?php echo e(route('unitkerja.admin.programs.index')); ?>" class="bg-white text-gray-700 px-4 py-2 rounded-lg font-medium hover:bg-gray-100 transition border border-gray-300 shadow-sm">
                    Kembali
                </a>
            </div>
        </div>
    </div>

    
    <div class="bg-white p-5 rounded-lg shadow-sm border border-gray-200">
        <form action="<?php echo e(route('unitkerja.admin.programs.results', $program)); ?>" method="GET">
            <div class="grid grid-cols-1 md:grid-cols-3 gap-4">
                <div>
                    <label for="gender" class="block text-sm font-medium text-gray-700">Filter Jenis Kelamin</label>
                    <select id="gender" name="gender" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-teal-500 focus:ring-teal-500 sm:text-sm">
                        <option value="">Semua Jenis Kelamin</option>
                        <?php $__currentLoopData = $filterOptions['genders']; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $gender): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <option value="<?php echo e($gender); ?>" <?php echo e(request('gender') == $gender ? 'selected' : ''); ?>><?php echo e($gender); ?></option>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                    </select>
                </div>
                <div>
                    <label for="status" class="block text-sm font-medium text-gray-700">Filter Status Responden</label>
                    <select id="status" name="status" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-teal-500 focus:ring-teal-500 sm:text-sm">
                        <option value="">Semua Status</option>
                        <?php $__currentLoopData = $filterOptions['statuses']; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $status): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <option value="<?php echo e($status); ?>" <?php echo e(request('status') == $status ? 'selected' : ''); ?>><?php echo e($status); ?></option>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                    </select>
                </div>
                <div class="flex items-end space-x-2">
                    <button type="submit" class="w-full inline-flex justify-center rounded-md border border-transparent bg-teal-600 py-2 px-4 text-sm font-medium text-white shadow-sm hover:bg-teal-700">
                        Filter
                    </button>
                    <a href="<?php echo e(route('unitkerja.admin.programs.results', $program)); ?>" class="w-full inline-flex justify-center rounded-md border border-gray-300 bg-white py-2 px-4 text-sm font-medium text-gray-700 shadow-sm hover:bg-gray-50">
                        Reset
                    </a>
                </div>
            </div>
        </form>
    </div>

    
    <div class="bg-white p-6 rounded-lg shadow-sm border border-gray-200">
        <h3 class="text-lg font-semibold text-gray-800">Ringkasan Responden</h3>
        <div class="mt-4">
            <p class="text-4xl font-bold text-teal-600"><?php echo e($totalRespondents); ?></p>
            <p class="text-gray-500">Total Responden Unik (sesuai filter untuk unit Anda)</p>
        </div>
    </div>

    
    <div class="space-y-6">
        <?php $__empty_1 = true; $__currentLoopData = $chartData; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $index => $questionData): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
        <div class="bg-white rounded-lg shadow-sm p-6 border border-gray-200">
            <h3 class="font-bold text-lg text-gray-800 flex">
                <span class="mr-2"><?php echo e($loop->iteration); ?>.</span>
                <span class="flex-1"><?php echo e($questionData['question_body']); ?></span>
            </h3>

            <?php if($totalRespondents > 0): ?>
            <div class="mt-6 grid grid-cols-1 lg:grid-cols-5 gap-6">
                <div class="lg:col-span-3">
                    <canvas id="chart-<?php echo e($questionData['question_id']); ?>"></canvas>
                </div>
                
                <div class="lg:col-span-2">
                    <div class="overflow-x-auto border rounded-lg">
                        <table class="min-w-full divide-y divide-gray-200">
                            <thead class="bg-teal-50">
                                <tr>
                                    <th scope="col" class="px-6 py-3 text-left text-sm font-semibold text-gray-900">Opsi Jawaban</th>
                                    <th scope="col" class="px-6 py-3 text-left text-sm font-semibold text-gray-900">Jumlah</th>
                                    <th scope="col" class="px-6 py-3 text-left text-sm font-semibold text-gray-900">%</th>
                                </tr>
                            </thead>
                            <tbody class="divide-y divide-gray-200 bg-white">
                                <?php $__currentLoopData = $questionData['options']; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $optionIndex => $option): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                <?php
                                $count = $questionData['data'][$optionIndex];
                                $totalAnswersForThisQuestion = $questionData['data']->sum();
                                $percentage = $totalAnswersForThisQuestion > 0 ? ($count / $totalAnswersForThisQuestion) * 100 : 0;
                                ?>
                                <tr>
                                    <td class="whitespace-nowrap px-6 py-4 text-sm font-medium text-gray-900"><?php echo e($option->option_body); ?></td>
                                    <td class="whitespace-nowrap px-6 py-4 text-sm text-gray-500"><?php echo e($count); ?></td>
                                    <td class="whitespace-nowrap px-6 py-4 text-sm text-gray-500"><?php echo e(number_format($percentage, 1)); ?>%</td>
                                </tr>
                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
            <?php else: ?>
            <p class="mt-6 text-gray-500">Belum ada data responden untuk pertanyaan ini (sesuai filter).</p>
            <?php endif; ?>
        </div>
        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
        <div class="bg-white rounded-lg shadow-sm p-8 text-center border-2 border-dashed">
            <p class="mt-4 font-semibold text-gray-600">Program survei ini belum memiliki pertanyaan.</p>
        </div>
        <?php endif; ?>
    </div>
</div>
<?php $__env->stopSection(); ?>

<?php $__env->startPush('scripts'); ?>
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<script>
    document.addEventListener('DOMContentLoaded', function() {
        const chartData = <?php echo json_encode($chartData, 15, 512) ?>;

        function getColors(count) {
            const colors = [];
            const hueStart = 160; 
            const hueStep = 30 / count;
            for (let i = 0; i < count; i++) {
                colors.push(`hsla(${hueStart + (i * hueStep)}, 60%, 70%, 0.7)`);
            }
            return colors;
        }

        chartData.forEach(questionData => {
            const ctx = document.getElementById(`chart-${questionData['question_id']}`);
            if (!ctx) return; 
            const dataArray = Object.values(questionData.data);

            new Chart(ctx.getContext('2d'), {
                type: 'doughnut',
                data: {
                    labels: questionData.labels,
                    datasets: [{
                        label: 'Jumlah Jawaban',
                        data: dataArray, 
                        backgroundColor: getColors(questionData.labels.length),
                        borderColor: '#ffffff',
                        borderWidth: 2,
                    }]
                },
                options: {
                    responsive: true,
                    plugins: {
                        legend: {
                            position: 'bottom',
                        },
                        tooltip: {
                            callbacks: {
                                label: function(context) {
                                    let label = context.label || '';
                                    let value = context.raw || 0;
                                    let dataSetArray = Object.values(context.chart.data.datasets[0].data);
                                    let total = dataSetArray.reduce((a, b) => a + b, 0);

                                    let percentage = total > 0 ? (value / total * 100).toFixed(1) : 0;
                                    return `${label}: ${value} (${percentage}%)`;
                                }
                            }
                        }
                    }
                }
            });
        });
    });
</script>
<?php $__env->stopPush(); ?>
<?php echo $__env->make('layouts.unit_kerja_admin', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\laragon\www\surveyZI\resources\views/unit_kerja_admin/results/show.blade.php ENDPATH**/ ?>