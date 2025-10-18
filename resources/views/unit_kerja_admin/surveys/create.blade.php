@extends('layouts.unit_kerja_admin')

@section('content')
<div class="p-4 sm:p-6">
    {{-- Header Halaman --}}
    <div class="mb-8 bg-white rounded-xl   p-4 md:p-6 border-l-4 border-teal-500 shadow-sm">
        <div class="flex items-center gap-4">
            <div class="flex-shrink-0 bg-teal-500 text-white p-3 rounded-lg shadow-md">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M12 4v16m8-8H4" />
                </svg>
            </div>
            <div>
                <h1 class="text-2xl md:text-3xl font-bold text-gray-800">Buat Pelaksanaan Survei</h1>
                <p class="text-sm text-gray-500 mt-1">Untuk Program: <span class="font-semibold">{{ $program->title }}</span></p>
            </div>
        </div>
    </div>

    {{-- Form --}}
    <form action="{{ route('unitkerja.admin.surveys.store') }}" method="POST">
        @csrf
        <input type="hidden" name="survey_program_id" value="{{ $program->id }}">

        @include('unit_kerja_admin.surveys._form')
    </form>
</div>
@endsection

@push('scripts')
<script>
    document.addEventListener('DOMContentLoaded', function() {
        flatpickr(".datepicker", {
            dateFormat: "Y-m-d",
        });
    });
</script>
@endpush