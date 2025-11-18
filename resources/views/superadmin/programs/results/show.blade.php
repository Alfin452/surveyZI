@extends('layouts.superadmin')

@section('content')
{{-- Background Aurora --}}
<div class="absolute top-0 left-0 w-full h-full overflow-hidden -z-10 pointer-events-none">
    <div class="absolute top-0 left-1/4 w-96 h-96 bg-purple-400/20 rounded-full mix-blend-multiply filter blur-3xl animate-blob"></div>
    <div class="absolute top-0 right-1/4 w-96 h-96 bg-fuchsia-400/20 rounded-full mix-blend-multiply filter blur-3xl animate-blob animation-delay-2000"></div>
    <div class="absolute -bottom-8 left-1/3 w-96 h-96 bg-violet-400/20 rounded-full mix-blend-multiply filter blur-3xl animate-blob animation-delay-4000"></div>
</div>

<div class="relative z-10 space-y-8">

    {{-- 1. Hero Header Section --}}
    <div class="bg-white/60 backdrop-blur-xl rounded-3xl px-6 py-5 border border-white/40 shadow-lg relative overflow-hidden group hover:shadow-purple-100/50 transition-all duration-500">
        <div class="absolute inset-0 bg-gradient-to-r from-purple-500/5 via-fuchsia-500/5 to-violet-500/5 opacity-0 group-hover:opacity-100 transition-opacity duration-500"></div>

        <div class="relative flex flex-col md:flex-row items-start md:items-center justify-between gap-4">
            <div class="flex items-center gap-4">
                {{-- 3D Icon --}}
                <div class="w-16 h-16 flex-shrink-0 drop-shadow-lg">
                    <img src="https://raw.githubusercontent.com/Tarikul-Islam-Anik/Animated-Fluent-Emojis/master/Emojis/Objects/Bar%20Chart.png" alt="Result Icon" class="w-full h-full object-contain">
                </div>
                <div>
                    <nav class="flex items-center text-xs font-medium text-slate-500 mb-1 space-x-2">
                        <a href="{{ route('superadmin.programs.index') }}" class="hover:text-purple-600 transition-colors">Program</a>
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-3 w-3 text-slate-400" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7" />
                        </svg>
                        <span class="text-slate-800">Analisis Hasil</span>
                    </nav>
                    <h1 class="text-2xl font-black text-slate-800 tracking-tight">Analisis Hasil Survei</h1>
                    <p class="text-slate-500 text-sm font-medium mt-0.5 max-w-xl truncate">
                        Data masuk untuk: <span class="text-purple-600 font-bold">{{ $program->title }}</span>
                    </p>
                </div>
            </div>

            <a href="{{ route('superadmin.programs.index') }}"
                class="group flex items-center gap-2 px-5 py-2.5 bg-white text-slate-600 border border-slate-200 rounded-xl font-bold shadow-sm hover:bg-slate-50 hover:text-purple-600 transition-all duration-300 text-sm">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 group-hover:-translate-x-1 transition-transform" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18" />
                </svg>
                <span>Kembali</span>
            </a>
        </div>
    </div>

    {{-- 2. Ringkasan & Filter --}}
    <div class="grid grid-cols-1 lg:grid-cols-4 gap-6">
        {{-- Kartu Ringkasan (Total Responden) --}}
        <div class="bg-gradient-to-br from-purple-600 to-indigo-600 rounded-3xl p-6 shadow-xl shadow-purple-200 text-white relative overflow-hidden">
            <div class="absolute top-0 right-0 -mt-4 -mr-4 w-24 h-24 bg-white/20 rounded-full blur-2xl"></div>
            <div class="absolute bottom-0 left-0 -mb-4 -ml-4 w-20 h-20 bg-black/10 rounded-full blur-xl"></div>

            <div class="relative z-10">
                <p class="text-purple-100 text-sm font-bold uppercase tracking-wider mb-1">Total Responden</p>
                <div class="flex items-baseline gap-2">
                    <h2 class="text-5xl font-black">{{ $totalRespondents }}</h2>
                    <span class="text-lg text-purple-200 font-medium">Orang</span>
                </div>
                <p class="text-xs text-purple-200 mt-4 pt-4 border-t border-white/20">
                    Menampilkan data sesuai filter yang aktif.
                </p>
            </div>
        </div>

        {{-- Kartu Filter Glassmorphism --}}
        <div class="lg:col-span-3 bg-white/60 backdrop-blur-xl border border-white/40 shadow-lg rounded-3xl p-6 flex flex-col justify-center">
            <form action="{{ route('superadmin.programs.results', $program) }}" method="GET" class="grid grid-cols-1 md:grid-cols-3 gap-4 items-end">

                {{-- Filter Gender --}}
                <div class="group">
                    <label for="gender" class="block text-xs font-bold text-slate-500 uppercase mb-2 ml-1">Jenis Kelamin</label>
                    <div class="relative">
                        <select id="gender" name="gender" class="block w-full pl-4 pr-10 py-3 bg-slate-50 border-slate-200 rounded-xl text-sm focus:ring-2 focus:ring-purple-500 focus:border-transparent transition-all shadow-sm cursor-pointer hover:bg-white">
                            <option value="">-- Semua --</option>
                            @foreach($filterOptions['genders'] as $gender)
                            <option value="{{ $gender }}" {{ request('gender') == $gender ? 'selected' : '' }}>{{ $gender }}</option>
                            @endforeach
                        </select>
                    </div>
                </div>

                {{-- Filter Status --}}
                <div class="group">
                    <label for="status" class="block text-xs font-bold text-slate-500 uppercase mb-2 ml-1">Status Responden</label>
                    <div class="relative">
                        <select id="status" name="status" class="block w-full pl-4 pr-10 py-3 bg-slate-50 border-slate-200 rounded-xl text-sm focus:ring-2 focus:ring-purple-500 focus:border-transparent transition-all shadow-sm cursor-pointer hover:bg-white">
                            <option value="">-- Semua Status --</option>
                            @foreach($filterOptions['statuses'] as $status)
                            <option value="{{ $status }}" {{ request('status') == $status ? 'selected' : '' }}>{{ $status }}</option>
                            @endforeach
                        </select>
                    </div>
                </div>

                {{-- Tombol Aksi --}}
                <div class="flex gap-2">
                    <button type="submit" class="flex-1 bg-purple-600 hover:bg-purple-700 text-white py-3 px-4 rounded-xl font-bold text-sm shadow-lg shadow-purple-200 hover:shadow-purple-300 transition-all active:scale-95 flex items-center justify-center gap-2">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 4a1 1 0 011-1h16a1 1 0 011 1v2.586a1 1 0 01-.293.707l-6.414 6.414a1 1 0 00-.293.707V17l-4 4v-6.586a1 1 0 00-.293-.707L3.293 7.293A1 1 0 013 6.586V4z" />
                        </svg>
                        Terapkan
                    </button>
                    <a href="{{ route('superadmin.programs.results', $program) }}" class="px-4 py-3 bg-white text-slate-500 border border-slate-200 rounded-xl hover:bg-slate-50 transition-colors shadow-sm" title="Reset Filter">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 4v5h.582m15.356 2A8.001 8.001 0 004.582 9m0 0H9m11 11v-5h-.581m0 0a8.003 8.003 0 01-15.357-2m15.357 2H15" />
                        </svg>
                    </a>
                </div>
            </form>
        </div>
    </div>

    {{-- 3. Daftar Analisis Pertanyaan --}}
    <div class="space-y-8">
        @forelse ($chartData as $index => $questionData)
        <div class="bg-white rounded-3xl shadow-sm border border-slate-100 overflow-hidden">

            {{-- Header Pertanyaan --}}
            <div class="p-6 bg-slate-50/50 border-b border-slate-100 flex gap-4 items-start">
                <span class="flex-shrink-0 w-8 h-8 rounded-full bg-purple-100 text-purple-600 font-black flex items-center justify-center text-sm">
                    {{ $loop->iteration }}
                </span>
                <h3 class="text-lg font-bold text-slate-800 leading-snug pt-1">
                    {{ $questionData['question_body'] }}
                </h3>
            </div>

            @if($totalRespondents > 0)
            <div class="p-8 grid grid-cols-1 lg:grid-cols-5 gap-10 items-center">

                {{-- Grafik Donut (Kiri) --}}
                <div class="lg:col-span-2 flex justify-center">
                    <div class="relative w-full max-w-[280px] aspect-square">
                        <canvas id="chart-{{ $questionData['question_id'] }}"></canvas>
                        {{-- Tengah Donut --}}
                        <div class="absolute inset-0 flex flex-col items-center justify-center pointer-events-none">
                            <span class="text-3xl font-black text-slate-700">{{ $questionData['data']->sum() }}</span>
                            <span class="text-[10px] uppercase text-slate-400 font-bold tracking-widest">Jawaban</span>
                        </div>
                    </div>
                </div>

                {{-- Tabel Detail (Kanan) --}}
                <div class="lg:col-span-3">
                    <div class="bg-white border border-slate-100 rounded-2xl overflow-hidden shadow-sm">
                        <table class="w-full text-left text-sm">
                            <thead class="bg-slate-50 text-slate-500 font-bold uppercase text-xs">
                                <tr>
                                    <th class="px-5 py-3">Opsi Jawaban</th>
                                    <th class="px-5 py-3 text-center w-24">Jumlah</th>
                                    <th class="px-5 py-3 text-right w-24">Persentase</th>
                                </tr>
                            </thead>
                            <tbody class="divide-y divide-slate-50">
                                @foreach($questionData['options'] as $optionIndex => $option)
                                @php
                                $count = $questionData['data'][$optionIndex];
                                $total = $questionData['data']->sum();
                                $percentage = $total > 0 ? ($count / $total) * 100 : 0;
                                @endphp
                                <tr class="hover:bg-slate-50/80 transition-colors">
                                    <td class="px-5 py-3 font-medium text-slate-700">
                                        <div class="flex items-center gap-2">
                                            <span class="w-2 h-2 rounded-full" style="background-color: {{ ['#818cf8', '#34d399', '#fbbf24', '#f87171', '#a78bfa'][$optionIndex % 5] }}"></span>
                                            {{ $option->option_body }}
                                        </div>
                                    </td>
                                    <td class="px-5 py-3 text-center font-bold text-slate-600">{{ $count }}</td>
                                    <td class="px-5 py-3 text-right">
                                        <span class="inline-block px-2 py-0.5 rounded text-xs font-bold bg-slate-100 text-slate-600">
                                            {{ number_format($percentage, 1) }}%
                                        </span>
                                    </td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>

            </div>
            @else
            <div class="p-12 text-center">
                <div class="w-16 h-16 bg-slate-50 rounded-full flex items-center justify-center mx-auto mb-3 text-slate-300">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-8 w-8" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M20 12H4" />
                    </svg>
                </div>
                <p class="text-slate-400 font-medium">Belum ada data responden yang sesuai filter.</p>
            </div>
            @endif
        </div>
        @empty
        <div class="flex flex-col items-center justify-center py-20 px-4 bg-white/60 backdrop-blur-xl rounded-3xl shadow-sm border-2 border-dashed border-slate-200">
            <div class="w-24 h-24 mb-4 opacity-50">
                <img src="https://raw.githubusercontent.com/Tarikul-Islam-Anik/Animated-Fluent-Emojis/master/Emojis/Objects/Clipboard.png" alt="Empty" class="w-full h-full object-contain">
            </div>
            <p class="text-slate-500 font-medium">Program survei ini belum memiliki pertanyaan untuk dianalisis.</p>
        </div>
        @endforelse
    </div>
</div>
@endsection

@push('scripts')
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<script>
    document.addEventListener('DOMContentLoaded', function() {
        const chartData = @json($chartData);

        // Warna Modern (Tailwind Inspired)
        const colorPalette = [
            '#818cf8', // Indigo-400
            '#34d399', // Emerald-400
            '#fbbf24', // Amber-400
            '#f87171', // Red-400
            '#a78bfa', // Violet-400
            '#22d3ee', // Cyan-400
            '#f472b6', // Pink-400
        ];

        chartData.forEach(questionData => {
            const ctx = document.getElementById(`chart-${questionData['question_id']}`);
            if (!ctx) return;

            const dataArray = Object.values(questionData.data);

            new Chart(ctx.getContext('2d'), {
                type: 'doughnut',
                data: {
                    labels: questionData.labels,
                    datasets: [{
                        data: dataArray,
                        backgroundColor: colorPalette,
                        borderWidth: 0, // Bersih tanpa border
                        hoverOffset: 4
                    }]
                },
                options: {
                    responsive: true,
                    maintainAspectRatio: false,
                    cutout: '75%', // Lubang tengah lebih besar (Modern)
                    plugins: {
                        legend: {
                            display: false
                        }, // Sembunyikan legend bawaan (kita pakai tabel)
                        tooltip: {
                            backgroundColor: 'rgba(255, 255, 255, 0.9)',
                            titleColor: '#1e293b',
                            bodyColor: '#475569',
                            borderColor: '#e2e8f0',
                            borderWidth: 1,
                            padding: 10,
                            displayColors: true,
                            callbacks: {
                                label: function(context) {
                                    let value = context.raw || 0;
                                    let total = context.chart._metasets[context.datasetIndex].total;
                                    let percentage = total > 0 ? (value / total * 100).toFixed(1) : 0;
                                    return ` ${value} Responden (${percentage}%)`;
                                }
                            }
                        }
                    }
                }
            });
        });
    });
</script>
@endpush