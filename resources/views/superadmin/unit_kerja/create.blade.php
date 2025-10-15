@extends('layouts.superadmin')

@section('content')
<div class="p-4 sm:p-6">
    {{-- Header Halaman --}}
    <div class="mb-8 bg-white rounded-xl p-4 md:p-6 border-l-4 border-blue-500 shadow-sm">
        <div class="flex items-center gap-4">
            <div class="flex-shrink-0 bg-blue-500 text-white p-3 rounded-lg shadow-md">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M12 4v16m8-8H4" />
                </svg>
            </div>
            <div>
                <h1 class="text-2xl md:text-3xl font-bold text-gray-800">Tambah Unit Kerja Baru</h1>
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
        new TomSelect('#tipe_unit_id', {
            placeholder: 'Pilih tipe unit...',
        });
        new TomSelect('#parent_id', {
            placeholder: 'Pilih induk unit (jika ada)...',
        });
    });
</script>
@endpush