@extends('layouts.superadmin')

@section('content')
<div class="p-2 space-y-6">

    {{-- Header Halaman --}}
    <div class="bg-white rounded-lg p-5 border border-gray-200 shadow-sm">
        <div class="flex items-start gap-3">
            <div class="flex-shrink-0 bg-blue-500 text-white p-2 rounded-md">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z" />
                </svg>
            </div>
            <div>
                <h1 class="text-xl font-bold text-gray-800">Edit Unit Kerja</h1>
                <p class="text-sm text-gray-500 mt-1">Perbarui detail untuk unit kerja: <span class="font-semibold">{{ $unitKerja->unit_kerja_name }}</span></p>
            </div>
        </div>
    </div>

    {{-- Form --}}
    <form action="{{ route('superadmin.unit-kerja.update', $unitKerja) }}" method="POST">
        @csrf
        @method('PUT')
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