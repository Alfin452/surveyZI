@extends('layouts.superadmin')

@section('content')
{{-- Style Animasi --}}
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

    /* Tooltip Chart */
    .apexcharts-tooltip {
        z-index: 9999 !important;
    }
</style>

<div class="relative min-h-screen overflow-hidden">
    {{-- Background Aurora --}}
    <div class="absolute top-0 left-0 w-full h-full overflow-hidden -z-10 pointer-events-none">
        <div class="absolute top-0 left-1/4 w-96 h-96 bg-indigo-400/20 rounded-full mix-blend-multiply filter blur-3xl animate-blob"></div>
        <div class="absolute top-0 right-1/4 w-96 h-96 bg-purple-400/20 rounded-full mix-blend-multiply filter blur-3xl animate-blob animation-delay-2000"></div>
        <div class="absolute -bottom-8 left-1/3 w-96 h-96 bg-pink-400/20 rounded-full mix-blend-multiply filter blur-3xl animate-blob animation-delay-4000"></div>
    </div>

    <div class="relative z-10 space-y-8">

        {{-- 1. Hero Header --}}
        <div class="bg-white/60 backdrop-blur-xl rounded-3xl px-6 py-5 border border-white/40 shadow-lg relative overflow-hidden group hover:shadow-indigo-100/50 transition-all duration-500">
            <div class="absolute inset-0 bg-gradient-to-r from-indigo-500/5 via-purple-500/5 to-pink-500/5 opacity-0 group-hover:opacity-100 transition-opacity duration-500"></div>
            <div class="relative flex flex-col md:flex-row items-start md:items-center justify-between gap-4">
                <div>
                    <div class="flex items-center gap-2 mb-1 text-indigo-600 font-bold text-[10px] uppercase tracking-widest">
                        <span class="relative flex h-2 w-2">
                            <span class="animate-ping absolute inline-flex h-full w-full rounded-full bg-indigo-400 opacity-75"></span>
                            <span class="relative inline-flex rounded-full h-2 w-2 bg-indigo-500"></span>
                        </span>
                        Live Dashboard
                    </div>
                    <div class="flex items-center gap-3">
                        <h1 class="text-2xl md:text-3xl font-black text-slate-800 tracking-tight">
                            @php
                            $hour = date('H');
                            $greeting = $hour < 12 ? 'Selamat Pagi' : ($hour < 15 ? 'Selamat Siang' : ($hour < 18 ? 'Selamat Sore' : 'Selamat Malam' ));
                                @endphp
                                {{ $greeting }}, <span class="text-transparent bg-clip-text bg-gradient-to-r from-indigo-600 to-purple-600">{{ Auth::user()->username }}</span>
                        </h1>
                        <div class="waving-hand -mt-1">
                            <img src="https://raw.githubusercontent.com/Tarikul-Islam-Anik/Animated-Fluent-Emojis/master/Emojis/Hand%20gestures/Waving%20Hand.png" alt="Waving Hand" width="45" height="45" />
                        </div>
                    </div>
                    <p class="text-slate-500 text-sm mt-1 font-medium">Ringkasan performa sistem survei hari ini.</p>
                </div>
                <div class="flex gap-3 mt-2 md:mt-0">
                    <a href="{{ route('superadmin.programs.create') }}" class="flex items-center gap-2 px-4 py-2.5 bg-slate-900 hover:bg-slate-800 text-white rounded-xl font-bold shadow-lg hover:shadow-xl hover:-translate-y-1 transition-all duration-300 text-xs md:text-sm">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4" />
                        </svg>
                        Buat Survei
                    </a>
                    <a href="{{ route('superadmin.users.index') }}" class="flex items-center gap-2 px-4 py-2.5 bg-white hover:bg-slate-50 text-slate-700 border border-slate-200 rounded-xl font-bold shadow-sm hover:shadow-md hover:-translate-y-1 transition-all duration-300 text-xs md:text-sm">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 text-slate-500" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4.354a4 4 0 110 5.292M15 21H3v-1a6 6 0 0112 0v1zm0 0h6v-1a6 6 0 00-9-5.197M13 7a4 4 0 11-8 0 4 4 0 018 0z" />
                        </svg>
                        User
                    </a>
                </div>
            </div>
        </div>

        {{-- 2. Stats Grid --}}
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6">
            <x-dashboard-stat-card title="Total Program" value="{{ $totalPrograms }}" subtext="Program Survei" icon="collection" color="indigo" link="{{ route('superadmin.programs.index') }}" />
            <x-dashboard-stat-card title="Unit Kerja" value="{{ $totalUnitKerja }}" subtext="Terdaftar Sistem" icon="office-building" color="emerald" link="{{ route('superadmin.unit-kerja.index') }}" />
            <x-dashboard-stat-card title="Total Pengguna" value="{{ $totalUsers }}" subtext="Admin & User" icon="users" color="amber" link="{{ route('superadmin.users.index') }}" />
            <x-dashboard-stat-card title="Responden Unik" value="{{ $totalRespondents }}" subtext="Total Partisipan" icon="chart-bar" color="rose" link="#" />
        </div>

        {{-- 3. Charts & Analytics Section --}}
        <div class="grid grid-cols-1 lg:grid-cols-3 gap-8 items-stretch">

            {{-- Main Chart: Trend (ELASTIS HEIGHT) --}}
            <div class="lg:col-span-2 bg-white rounded-3xl shadow-sm border border-slate-100 overflow-hidden flex flex-col h-full">
                {{-- Header --}}
                <div class="flex items-center justify-between p-6 pb-2 shrink-0">
                    <div>
                        <h3 class="text-lg font-bold text-slate-800">Tren Responden</h3>
                        <p class="text-sm text-slate-500">Aktivitas pengisian survei 7 hari terakhir</p>
                    </div>
                    <div class="bg-indigo-50 text-indigo-600 px-3 py-1 rounded-lg text-xs font-bold uppercase tracking-wide">
                        Realtime
                    </div>
                </div>

                {{-- Grafik Elastis (Isi Sisa Ruang) --}}
                <div class="w-full flex-1 min-h-[300px] relative">
                    <div id="trendChart" class="w-full h-full"></div>
                </div>

                {{-- Footer Summary (Data Tambahan) --}}
                <div class="bg-slate-50 border-t border-slate-100 p-4 grid grid-cols-2 gap-4 shrink-0">
                    <div class="flex items-center gap-3">
                        <div class="p-2 bg-blue-100 text-blue-600 rounded-lg">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 7h8m0 0v8m0-8l-8 8-4-4-6 6" />
                            </svg>
                        </div>
                        <div>
                            <p class="text-xs text-slate-500 font-bold uppercase">Total 7 Hari</p>
                            <p class="text-lg font-black text-slate-800" id="summaryTotal">0</p>
                        </div>
                    </div>
                    <div class="flex items-center gap-3">
                        <div class="p-2 bg-purple-100 text-purple-600 rounded-lg">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 19v-6a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2a2 2 0 002-2zm0 0V9a2 2 0 012-2h2a2 2 0 012 2v10m-6 0a2 2 0 002 2h2a2 2 0 002-2m0 0V5a2 2 0 012-2h2a2 2 0 012 2v14a2 2 0 01-2 2h-2a2 2 0 01-2-2z" />
                            </svg>
                        </div>
                        <div>
                            <p class="text-xs text-slate-500 font-bold uppercase">Rata-rata / Hari</p>
                            <p class="text-lg font-black text-slate-800" id="summaryAvg">0</p>
                        </div>
                    </div>
                </div>
            </div>

            {{-- Side Chart --}}
            <div class="space-y-8 flex flex-col h-full">
                <div class="bg-white p-6 rounded-3xl shadow-sm border border-slate-100 shrink-0">
                    <h3 class="text-lg font-bold text-slate-800 mb-1">Status Program</h3>
                    <p class="text-sm text-slate-500 mb-4">Distribusi program aktif vs arsip</p>
                    <div id="statusChart" class="flex justify-center h-48"></div>
                </div>

                <div class="bg-white p-6 rounded-3xl shadow-sm border border-slate-100 flex-1">
                    <h3 class="text-lg font-bold text-slate-800 mb-4">Aktivitas Terkini</h3>
                    <div class="space-y-4">
                        @forelse($recentActivities as $activity)
                        <div class="flex items-center gap-3 p-3 rounded-xl hover:bg-slate-50 transition-colors border border-transparent hover:border-slate-100">
                            <div class="w-10 h-10 rounded-full bg-indigo-100 text-indigo-600 flex items-center justify-center font-bold text-sm">
                                {{ substr($activity->user->username ?? 'A', 0, 1) }}
                            </div>
                            <div class="flex-1 min-w-0">
                                <p class="text-sm font-semibold text-slate-800 truncate">{{ $activity->user->username ?? 'Anonim' }}</p>
                                <p class="text-xs text-slate-500 truncate">Mengisi survei baru</p>
                            </div>
                            <span class="text-xs text-slate-400 font-medium whitespace-nowrap">{{ $activity->created_at->diffForHumans() }}</span>
                        </div>
                        @empty
                        <div class="text-center py-6 text-slate-400 text-sm">Belum ada aktivitas terbaru.</div>
                        @endforelse
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

@push('scripts')
<script src="https://cdn.jsdelivr.net/npm/apexcharts"></script>
<script>
    document.addEventListener('DOMContentLoaded', function() {

        // Setup Data Anti-Crash
        const chartData = @json($chartData ?? []);
        const chartLabels = @json($chartLabels ?? []);
        const activeCount = @json($activePrograms ?? 0);
        const inactiveCount = @json($inactivePrograms ?? 0);

        // --- Update Footer Summary ---
        if (Array.isArray(chartData) && chartData.length > 0) {
            const sum = chartData.reduce((a, b) => a + b, 0);
            const avg = Math.round(sum / chartData.length);
            document.getElementById('summaryTotal').innerText = sum + " Orang";
            document.getElementById('summaryAvg').innerText = avg + " / Hari";
        }

        // 1. Trend Chart (Elastic Height)
        if (document.querySelector("#trendChart")) {
            const trendOptions = {
                series: [{
                    name: 'Responden',
                    data: chartData
                }],
                chart: {
                    type: 'area',
                    height: '100%', // KUNCI: Set 100% agar mengikuti container parent
                    width: '100%',
                    toolbar: {
                        show: false
                    },
                    parentHeightOffset: 0,
                    fontFamily: 'inherit'
                },
                colors: ['#6366f1'],
                fill: {
                    type: 'gradient',
                    gradient: {
                        shadeIntensity: 1,
                        opacityFrom: 0.4,
                        opacityTo: 0.05,
                        stops: [0, 90, 100]
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
                    categories: chartLabels,
                    axisBorder: {
                        show: false
                    },
                    axisTicks: {
                        show: false
                    },
                    labels: {
                        style: {
                            colors: '#94a3b8'
                        }
                    },
                    tooltip: {
                        enabled: false
                    }
                },
                yaxis: {
                    labels: {
                        style: {
                            colors: '#94a3b8'
                        }
                    }
                },
                grid: {
                    borderColor: '#f1f5f9',
                    strokeDashArray: 4,
                    padding: {
                        top: 0,
                        right: 0,
                        bottom: 0,
                        left: 10
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

        // 2. Status Chart
        if (document.querySelector("#statusChart")) {
            const statusOptions = {
                series: [activeCount, inactiveCount],
                labels: ['Aktif', 'Tidak Aktif'],
                chart: {
                    type: 'donut',
                    height: 240,
                    fontFamily: 'inherit'
                },
                colors: ['#10b981', '#cbd5e1'],
                plotOptions: {
                    pie: {
                        donut: {
                            size: '75%',
                            labels: {
                                show: true,
                                total: {
                                    show: true,
                                    label: 'Total',
                                    fontSize: '14px',
                                    fontWeight: 600,
                                    color: '#64748b',
                                    formatter: function(w) {
                                        return w.globals.seriesTotals.reduce((a, b) => a + b, 0)
                                    }
                                }
                            }
                        }
                    }
                },
                dataLabels: {
                    enabled: false
                },
                legend: {
                    position: 'bottom'
                },
                stroke: {
                    show: false
                }
            };
            new ApexCharts(document.querySelector("#statusChart"), statusOptions).render();
        }
    });
</script>
@endpush
@endsection