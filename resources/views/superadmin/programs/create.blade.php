@extends('layouts.superadmin') 

@section('content')
<div class="p-4 sm:p-6">
    {{-- Header Halaman --}}
    <div class="mb-8 bg-white rounded-xl p-4 md:p-6 border-l-4 border-indigo-500 shadow-sm">
        <div class="flex items-center gap-4">
            <div class="flex-shrink-0 bg-indigo-500 text-white p-3 rounded-lg shadow-md">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M9 13h6m-3-3v6m5 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z" />
                </svg>
            </div>
            <div>
                <h1 class="text-2xl md:text-3xl font-bold text-gray-800">Buat Program Survei Baru</h1>
                <p class="text-sm text-gray-500 mt-1">Isi detail di bawah ini untuk membuat "wadah" survei baru.</p>
            </div>
        </div>
    </div>

    {{-- Form utama --}}
    <form action="{{ route('superadmin.programs.store') }}" method="POST">
        @csrf
        @include('superadmin.programs._form')
    </form>
</div>
@endsection

@push('scripts')
{{-- Script untuk datepicker dan multi-select --}}
<script>
    document.addEventListener('DOMContentLoaded', function() {
        flatpickr(".datepicker", {
            dateFormat: "Y-m-d",
        });
        new TomSelect('#targeted_unit_kerjas_select', {
            plugins: ['remove_button'],
            placeholder: 'Pilih satu atau lebih unit kerja...',
        });
    });
</script>
@endpush