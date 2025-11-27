

<?php $__env->startSection('content'); ?>

<style>
    @keyframes wave {
        0% {
            transform: rotate(0.0deg)
        }

        10% {
            transform: rotate(14.0deg)
        }

        20% {
            transform: rotate(-8.0deg)
        }

        30% {
            transform: rotate(14.0deg)
        }

        40% {
            transform: rotate(-4.0deg)
        }

        50% {
            transform: rotate(10.0deg)
        }

        60% {
            transform: rotate(0.0deg)
        }

        100% {
            transform: rotate(0.0deg)
        }
    }

    .waving-hand {
        animation-name: wave;
        animation-duration: 2.5s;
        animation-iteration-count: infinite;
        transform-origin: 70% 70%;
        display: inline-block;
    }

    .apexcharts-tooltip {
        z-index: 9999 !important;
    }
</style>


<div class="absolute top-0 left-0 w-full h-full overflow-hidden -z-10 pointer-events-none">
    <div class="absolute top-0 left-1/4 w-96 h-96 bg-teal-400/20 rounded-full mix-blend-multiply filter blur-3xl animate-blob"></div>
    <div class="absolute top-0 right-1/4 w-96 h-96 bg-cyan-400/20 rounded-full mix-blend-multiply filter blur-3xl animate-blob animation-delay-2000"></div>
    <div class="absolute -bottom-8 left-1/3 w-96 h-96 bg-emerald-400/20 rounded-full mix-blend-multiply filter blur-3xl animate-blob animation-delay-4000"></div>
</div>

<div class="relative z-10 space-y-8">

    
    <div class="bg-white/60 backdrop-blur-xl rounded-3xl px-6 py-5 border border-white/40 shadow-lg relative overflow-hidden group hover:shadow-teal-100/50 transition-all duration-500">
        <div class="absolute inset-0 bg-gradient-to-r from-teal-500/5 via-cyan-500/5 to-emerald-500/5 opacity-0 group-hover:opacity-100 transition-opacity duration-500"></div>

        <div class="relative flex flex-col md:flex-row items-start md:items-center justify-between gap-4">
            <div>
                <div class="flex items-center gap-2 mb-1 text-teal-600 font-bold text-[10px] uppercase tracking-widest">
                    <span class="relative flex h-2 w-2">
                        <span class="animate-ping absolute inline-flex h-full w-full rounded-full bg-teal-400 opacity-75"></span>
                        <span class="relative inline-flex rounded-full h-2 w-2 bg-teal-500"></span>
                    </span>
                    Unit Dashboard
                </div>
                <div class="flex items-center gap-3">
                    <h1 class="text-2xl md:text-3xl font-black text-slate-800 tracking-tight">
                        Halo, <span class="text-transparent bg-clip-text bg-gradient-to-r from-teal-600 to-emerald-600"><?php echo e(Auth::user()->username); ?></span>
                    </h1>
                    <div class="waving-hand -mt-1">
                        <img src="https://raw.githubusercontent.com/Tarikul-Islam-Anik/Animated-Fluent-Emojis/master/Emojis/Hand%20gestures/Waving%20Hand.png" alt="Wave" width="45" height="45">
                    </div>
                </div>
                <p class="text-slate-500 text-sm mt-1 font-medium">
                    Anda login sebagai admin: <span class="text-teal-600 font-bold"><?php echo e($unitKerja->unit_kerja_name ?? 'Unit Tidak Dikenal'); ?></span>
                </p>
            </div>

            <div class="flex items-center gap-3 mt-2 md:mt-0">
                <a href="<?php echo e(route('unitkerja.admin.programs.index')); ?>" class="flex items-center gap-2 px-4 py-2.5 bg-teal-600 hover:bg-teal-700 text-white rounded-xl font-bold shadow-lg hover:shadow-teal-500/30 transition-all text-sm">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2" />
                    </svg>
                    Lihat Program
                </a>
            </div>
        </div>
    </div>

    
    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">

        
        <div class="group relative bg-white/60 backdrop-blur-xl p-6 rounded-3xl border border-white/50 shadow-lg hover:shadow-indigo-100/50 transition-all duration-500 overflow-hidden">
            <div class="absolute top-0 right-0 p-4 opacity-10 group-hover:opacity-20 group-hover:scale-110 transition-all duration-500">
                <img src="https://raw.githubusercontent.com/Tarikul-Islam-Anik/Animated-Fluent-Emojis/master/Emojis/Objects/Spiral%20Notepad.png" class="w-24 h-24 object-contain">
            </div>
            <div class="relative z-10">
                <p class="text-sm font-bold text-slate-400 uppercase tracking-wider mb-1">Program Ditugaskan</p>
                <h3 class="text-4xl font-black text-slate-800 group-hover:text-indigo-600 transition-colors"><?php echo e($totalPrograms); ?></h3>
                <p class="text-xs text-slate-500 mt-2 bg-slate-100 inline-block px-2 py-1 rounded-lg">Survei aktif untuk unit ini</p>
            </div>
        </div>

        
        <div class="group relative bg-white/60 backdrop-blur-xl p-6 rounded-3xl border border-white/50 shadow-lg hover:shadow-teal-100/50 transition-all duration-500 overflow-hidden">
            <div class="absolute top-0 right-0 p-4 opacity-10 group-hover:opacity-20 group-hover:scale-110 transition-all duration-500">
                <img src="https://raw.githubusercontent.com/Tarikul-Islam-Anik/Animated-Fluent-Emojis/master/Emojis/People/Busts%20in%20Silhouette.png" class="w-24 h-24 object-contain">
            </div>
            <div class="relative z-10">
                <p class="text-sm font-bold text-slate-400 uppercase tracking-wider mb-1">Total Responden</p>
                <h3 class="text-4xl font-black text-slate-800 group-hover:text-teal-600 transition-colors"><?php echo e($totalResponden); ?></h3>
                <p class="text-xs text-slate-500 mt-2 bg-slate-100 inline-block px-2 py-1 rounded-lg">Mahasiswa/Dosen/Tendik</p>
            </div>
        </div>

    </div>

    
    <div class="grid grid-cols-1 lg:grid-cols-3 gap-8">

        
        <div class="lg:col-span-2 bg-white rounded-3xl shadow-sm border border-slate-100 overflow-hidden flex flex-col h-[420px]">
            <div class="px-6 pt-6 pb-2 flex items-center justify-between">
                <div>
                    <h3 class="text-lg font-bold text-slate-800">Tren Responden Unit</h3>
                    <p class="text-sm text-slate-500">Aktivitas 7 hari terakhir di <?php echo e(Str::limit($unitKerja->unit_kerja_name ?? '', 20)); ?></p>
                </div>
                <div class="bg-teal-50 text-teal-600 px-3 py-1 rounded-lg text-xs font-bold uppercase tracking-wide">Realtime</div>
            </div>
            <div class="flex-1 w-full relative min-h-0">
                <div id="trendChart" class="w-full h-full"></div>
            </div>
        </div>

        
        <div class="bg-white p-6 rounded-3xl shadow-sm border border-slate-100">
            <h3 class="text-lg font-bold text-slate-800 mb-4">Aktivitas Terkini</h3>
            <div class="space-y-4">
                <?php $__empty_1 = true; $__currentLoopData = $recentActivities; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $activity): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
                <div class="flex items-center gap-3 p-2 rounded-xl hover:bg-slate-50 transition-colors border border-transparent hover:border-slate-100">
                    <div class="w-9 h-9 rounded-full bg-teal-100 text-teal-600 flex items-center justify-center font-bold text-xs">
                        <?php echo e(substr($activity->user->username ?? 'A', 0, 1)); ?>

                    </div>
                    <div class="flex-1 min-w-0">
                        <p class="text-sm font-semibold text-slate-800 truncate"><?php echo e($activity->user->username ?? 'Anonim'); ?></p>
                        <p class="text-[10px] text-slate-500 truncate">Mengisi survei unit ini</p>
                    </div>
                    <span class="text-[10px] text-slate-400 font-medium whitespace-nowrap"><?php echo e($activity->created_at->diffForHumans()); ?></span>
                </div>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
                <div class="text-center py-8">
                    <div class="w-16 h-16 bg-slate-50 rounded-full flex items-center justify-center mx-auto mb-2 text-slate-300">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-8 w-8" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z" />
                        </svg>
                    </div>
                    <p class="text-xs text-slate-400">Belum ada aktivitas baru.</p>
                </div>
                <?php endif; ?>
            </div>
        </div>

    </div>
</div>

<?php $__env->stopSection(); ?>

<?php $__env->startPush('scripts'); ?>
<script src="https://cdn.jsdelivr.net/npm/apexcharts"></script>
<script>
    document.addEventListener('DOMContentLoaded', function() {
        const rawData = <?php echo json_encode($chartData ?? [], 15, 512) ?>;
        const rawLabels = <?php echo json_encode($chartLabels ?? [], 15, 512) ?>;

        if (document.querySelector("#trendChart")) {
            const trendOptions = {
                series: [{
                    name: 'Responden',
                    data: rawData
                }],
                chart: {
                    type: 'area',
                    height: '100%',
                    width: '100%',
                    toolbar: {
                        show: false
                    },
                    parentHeightOffset: 0,
                    fontFamily: 'inherit',
                    zoom: {
                        enabled: false
                    }
                },
                colors: ['#0d9488'], // Teal-600
                fill: {
                    type: 'gradient',
                    gradient: {
                        shadeIntensity: 1,
                        opacityFrom: 0.4,
                        opacityTo: 0.05,
                        stops: [0, 100]
                    }
                },
                dataLabels: {
                    enabled: false
                },
                stroke: {
                    curve: 'smooth',
                    width: 3
                },
                xaxis: {
                    categories: rawLabels,
                    axisBorder: {
                        show: false
                    },
                    axisTicks: {
                        show: false
                    },
                    labels: {
                        style: {
                            colors: '#94a3b8',
                            fontSize: '11px'
                        },
                        offsetY: 0
                    },
                    tooltip: {
                        enabled: false
                    }
                },
                yaxis: {
                    labels: {
                        style: {
                            colors: '#94a3b8',
                            fontSize: '11px'
                        },
                        formatter: (val) => Math.floor(val)
                    }
                },
                grid: {
                    show: true,
                    borderColor: '#f1f5f9',
                    strokeDashArray: 4,
                    padding: {
                        top: 0,
                        right: 20,
                        bottom: 0,
                        left: 20
                    }
                },
                tooltip: {
                    theme: 'light',
                    y: {
                        formatter: function(val) {
                            return val + " Orang"
                        }
                    }
                }
            };
            new ApexCharts(document.querySelector("#trendChart"), trendOptions).render();
        }
    });
</script>
<?php $__env->stopPush(); ?>
<?php echo $__env->make('layouts.unit_kerja_admin', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\laragon\www\surveyZI\resources\views/unit_kerja_admin/dashboard.blade.php ENDPATH**/ ?>