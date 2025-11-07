@extends('layouts.superadmin')

@section('content')
<div class="space-y-1">
    {{-- Header Halaman --}}
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

    {{-- Form --}}
    <form action="{{ route('superadmin.programs.store') }}" method="POST">
        @csrf
        @include('superadmin.programs._form')
    </form>
</div>
@endsection

@push('scripts')
{{-- Script untuk mengaktifkan Flatpickr dan TomSelect --}}
<script>
    document.addEventListener('DOMContentLoaded', function() {

        // Perbaikan Flatpickr (Tanggal dengan nama bulan)
        flatpickr(".datepicker", {
            altInput: true,
            altFormat: "d F Y", // Tampilan u/ pengguna: 03 November 2025
            dateFormat: "Y-m-d", // Data u/ server: 2025-11-03
            locale: "id" // Opsional: jika Anda punya file locale flatpickr indonesia
        });

        // DIKEMBALIKAN: Skrip TomSelect untuk 29 unit kerja Anda
        new TomSelect('#targeted_unit_kerjas_select', {
            placeholder: 'Pilih satu atau lebih unit kerja...',
            plugins: ['remove_button'],
        });
    });
</script>
@endpush