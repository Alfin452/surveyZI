{{-- Menggunakan komponen layout guest.blade.php --}}
<x-guest-layout title="Riwayat Survei Saya">

    <main class="w-full max-w-3xl mx-auto py-12 px-4 mt-10">
        {{-- Header Halaman --}}
        <div class="text-center mb-8 section-title-anim">
            <h1 class="text-3xl font-extrabold text-gray-900">Riwayat Survei</h1>
            <p class="text-gray-600 mt-2">Berikut adalah daftar semua survei yang telah Anda ikuti.</p>
        </div>

        {{-- Daftar Riwayat --}}
        <div class="bg-white rounded-xl shadow-lg border p-6 sm:p-8 section-title-anim">
            <div class="flow-root">
                <div class="-my-8 divide-y divide-gray-200">

                    @forelse ($responses as $response)
                    <div class="py-8">
                        <div class="flex items-center space-x-4">
                            <div class="flex-shrink-0 bg-indigo-100 text-indigo-600 h-12 w-12 rounded-full flex items-center justify-center">
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M9 12l2 2 4-4m6-4a9 9 0 11-18 0 9 9 0 0118 0z" />
                                </svg>
                            </div>
                            <div class="flex-1 min-w-0">
                                <p class="text-base font-semibold text-gray-900 truncate">
                                    {{ $response->surveyProgram->title }}
                                </p>
                                <p class="text-sm text-gray-500 truncate">
                                    Untuk unit: <span class="font-medium">{{ $response->unitKerja->unit_kerja_name }}</span>
                                </p>
                                <p class="text-sm text-gray-400 mt-1">
                                    {{-- PERBAIKAN: Menggunakan Carbon::parse() untuk mengubah string menjadi objek tanggal --}}
                                    Diselesaikan pada: {{ \Carbon\Carbon::parse($response->completed_at)->format('d M Y, H:i') }}
                                </p>
                            </div>
                            <div>
                                <span class="inline-flex items-center px-3 py-1.5 rounded-full text-xs font-medium bg-green-100 text-green-800">
                                    Selesai
                                </span>
                            </div>
                        </div>
                    </div>
                    @empty
                    <div class="py-12 text-center">
                        <svg xmlns="http://www.w3.org/2000/svg" class="mx-auto h-12 w-12 text-gray-400" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="1">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z" />
                        </svg>
                        <h3 class="mt-2 text-lg font-medium text-gray-900">Belum Ada Riwayat</h3>
                        <p class="mt-1 text-sm text-gray-500">Anda belum menyelesaikan survei apapun.</p>
                        <div class="mt-6">
                            <a href="{{ route('home') }}#program-survei" class="inline-flex items-center px-4 py-2 border border-transparent shadow-sm text-sm font-medium rounded-md text-white bg-indigo-600 hover:bg-indigo-700">
                                Mulai Isi Survei
                            </a>
                        </div>
                    </div>
                    @endforelse
                </div>
            </div>
        </div>

        {{-- Paginasi --}}
        <div class="mt-8">
            {{ $responses->links() }}
        </div>
    </main>
</x-guest-layout>