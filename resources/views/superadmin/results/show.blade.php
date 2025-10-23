@extends('layouts.superadmin')

@section('content')
<div class="p-4 sm:p-6">
    {{-- Header Halaman --}}
    <div class="mb-8 bg-white rounded-xl p-4 md:p-6 border-l-4 border-purple-500 shadow-sm">
        <div class="flex flex-col md:flex-row md:justify-between md:items-start">
            <div>
                {{-- Breadcrumbs --}}
                <nav class="text-sm mb-2 font-medium text-gray-500" aria-label="Breadcrumb">
                    <ol class="list-none p-0 inline-flex">
                        <li class="flex items-center"><a href="{{ route('superadmin.dashboard') }}" class="hover:text-purple-600">Dashboard</a><span class="mx-2">/</span></li>
                        <li class="flex items-center"><a href="{{ route('superadmin.programs.index') }}" class="hover:text-purple-600">Program Survei</a><span class="mx-2">/</span></li>
                        <li class="flex items-center"><a href="{{ route('superadmin.programs.show', $survey->surveyProgram) }}" class="hover:text-purple-600">Detail Program</a><span class="mx-2">/</span></li>
                        <li class="flex items-center"><span class="text-gray-700">Hasil Survei</span></li>
                    </ol>
                </nav>
                <div class="flex items-center gap-4">
                    <div class="flex-shrink-0 bg-purple-500 text-white p-3 rounded-lg shadow-md">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M9 19v-6a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2a2 2 0 002-2zm0 0V9a2 2 0 012-2h2a2 2 0 012 2v10m-6 0a2 2 0 002 2h2a2 2 0 002-2m0 0V5a2 2 0 012-2h2a2 2 0 012 2v14a2 2 0 01-2 2h-2a2 2 0 01-2-2z" />
                        </svg>
                    </div>
                    <div>
                        <h1 class="text-2xl md:text-3xl font-bold text-gray-800">Hasil Survei</h1>
                        <p class="text-sm text-gray-500 mt-1">Survei: <span class="font-semibold">{{ $survey->title }}</span></p>
                    </div>
                </div>
            </div>
            <div class="mt-4 md:mt-0 flex space-x-2 self-start md:self-end">
                <a href="{{ route('superadmin.programs.show', $survey->surveyProgram) }}" class="bg-white text-gray-700 px-4 py-2 rounded-lg font-medium hover:bg-gray-100 transition border">Kembali ke Detail Program</a>
            </div>
        </div>
    </div>

    {{-- Kartu Statistik Ringkasan --}}
    <div class="mb-8 bg-white p-6 rounded-xl shadow-md border">
        <h3 class="text-lg font-semibold text-gray-800">Ringkasan Responden</h3>
        <div class="mt-4">
            <p class="text-4xl font-bold text-indigo-600">{{ $totalRespondents }}</p>
            <p class="text-gray-500">Total Responden Unik</p>
        </div>
    </div>

    {{-- Analisis per Pertanyaan --}}
    <div class="space-y-8">
        @forelse ($chartData as $index => $questionData)
        <div class="bg-white rounded-xl shadow-lg p-6 border border-gray-200">
            <h3 class="font-bold text-lg text-gray-800 flex">
                <span class="mr-2">{{ $loop->iteration }}.</span>
                <span class="flex-1">{{ $questionData['question_body'] }}</span>
            </h3>

            @if($totalRespondents > 0)
            <div class="mt-6 grid grid-cols-1 lg:grid-cols-5 gap-6">
                {{-- Grafik --}}
                <div class="lg:col-span-3">
                    <canvas id="chart-{{ $questionData['question_id'] }}"></canvas>
                </div>
                {{-- Tabel Data --}}
                <div class="lg:col-span-2">
                    <div class="overflow-x-auto">
                        <table class="min-w-full divide-y divide-gray-300">
                            <thead class="bg-gray-50">
                                <tr>
                                    <th scope="col" class="py-3.5 pl-4 pr-3 text-left text-sm font-semibold text-gray-900 sm:pl-0">Opsi Jawaban</th>
                                    <th scope="col" class="px-3 py-3.5 text-left text-sm font-semibold text-gray-900">Jumlah</th>
                                    <th scope="col" class="px-3 py-3.5 text-left text-sm font-semibold text-gray-900">%</th>
                                </tr>
                            </thead>
                            <tbody class="divide-y divide-gray-200">
                                @foreach($questionData['options'] as $optionIndex => $option)
                                @php
                                $count = $questionData['data'][$optionIndex];
                                $percentage = $totalRespondents > 0 ? ($count / $totalRespondents) * 100 : 0;
                                @endphp
                                <tr>
                                    <td class="whitespace-nowrap py-4 pl-4 pr-3 text-sm font-medium text-gray-900 sm:pl-0">{{ $option->option_body }}</td>
                                    <td class="whitespace-nowrap px-3 py-4 text-sm text-gray-500">{{ $count }}</td>
                                    <td class="whitespace-nowrap px-3 py-4 text-sm text-gray-500">{{ number_format($percentage, 1) }}%</td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
            @else
            <p class="mt-6 text-gray-500">Belum ada data responden untuk pertanyaan ini.</p>
            @endif
        </div>
        @empty
        <div class="bg-white rounded-xl shadow-lg p-8 text-center border-2 border-dashed">
            <p class="mt-4 font-semibold text-gray-600">Survei ini belum memiliki pertanyaan.</p>
        </div>
        @endforelse
    </div>
</div>
@endsection

@push('scripts')
{{-- Memuat library Chart.js --}}
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<script>
    document.addEventListener('DOMContentLoaded', function() {
        const chartData = @json($chartData);

        // Fungsi untuk menghasilkan warna pelangi yang lebih lembut
        function getColors(count) {
            const colors = [];
            const hueStep = 360 / count;
            for (let i = 0; i < count; i++) {
                colors.push(`hsla(${i * hueStep}, 60%, 70%, 0.7)`); // HSL: (Hue, Saturation, Lightness, Alpha)
            }
            return colors;
        }

        chartData.forEach(questionData => {
            const ctx = document.getElementById(`chart-${questionData.question_id}`).getContext('2d');
            new Chart(ctx, {
                type: 'doughnut', // Menggunakan diagram donat
                data: {
                    labels: questionData.labels,
                    datasets: [{
                        label: 'Jumlah Jawaban',
                        data: questionData.data,
                        backgroundColor: getColors(questionData.labels.length),
                        borderColor: '#ffffff',
                        borderWidth: 2,
                    }]
                },
                options: {
                    responsive: true,
                    plugins: {
                        legend: {
                            position: 'bottom', // Pindahkan legenda ke bawah
                        },
                        tooltip: {
                            callbacks: {
                                label: function(context) {
                                    let label = context.label || '';
                                    let value = context.raw || 0;
                                    let total = context.chart.data.datasets[0].data.reduce((a, b) => a + b, 0);
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
@endpush