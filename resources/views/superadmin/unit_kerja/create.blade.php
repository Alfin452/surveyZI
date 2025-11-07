@extends('layouts.superadmin')

@section('content')
<div class="p-2 space-y-6">

    {{-- Header Halaman --}}
    <div class="bg-white rounded-lg p-5 border border-gray-200 shadow-sm">
        <div class="flex items-start gap-3">
            <div class="flex-shrink-0 bg-blue-500 text-white p-2 rounded-md">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M9 13h6m-3-3v6m5 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z" />
                </svg>
            </div>
            <div>
                <h1 class="text-xl font-bold text-gray-800">Tambah Unit Kerja Baru</h1>
                <p class="text-sm text-gray-500 mt-1">Isi detail di bawah untuk mendaftarkan unit kerja baru.</p>
            </div>
        </div>
    </div>

    {{-- Form --}}
    <form action="{{ route('superadmin.unit-kerja.store') }}" method="POST">
        @csrf
        @include('superadmin.unit_kerja._form')
    </form>
</div>
@endsection

@push('scripts')
<script>
    document.addEventListener('DOMContentLoaded', function() {
        // Inisialisasi TomSelect
        new TomSelect('#tipe_unit_id', {
            placeholder: 'Pilih tipe unit...',
        });
        new TomSelect('#parent_id', {
            placeholder: 'Pilih induk unit (jika ada)...',
        });
        // Flatpickr inisialisasi sudah ada di layouts/superadmin.blade.php secara global
    });
</script>
@endpush