@extends('layouts.superadmin')

@section('content')
{{-- PERBAIKAN: Menyamakan padding 'p-2 space-y-6' --}}
<div class="space-y-1">
    
    {{-- Header Halaman --}}
    {{-- PERBAIKAN: Menyamakan style header card (padding, border, radius) --}}
    <div class="bg-white rounded-lg p-5 border border-gray-200 shadow-sm">
        <div class="flex items-start gap-3">
            
            {{-- PERBAIKAN: Menyamakan ikon (warna indigo, padding, size) --}}
            <div class="flex-shrink-0 bg-indigo-500 text-white p-2 rounded-md">
                {{-- Mengganti ikon '+' dengan 'document-add' agar lebih relevan & konsisten --}}
                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M9 13h6m-3-3v6m5 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z" />
                </svg>
            </div>
            <div>
                {{-- PERBAIKAN: Menyamakan font size 'text-xl' --}}
                <h1 class="text-xl font-bold text-gray-800">Tambah Pengguna Baru</h1>
                <p class="text-sm text-gray-500 mt-1">Isi detail di bawah untuk mendaftarkan pengguna baru.</p>
            </div>
        </div>
    </div>

    {{-- Form --}}
    <form action="{{ route('superadmin.users.store') }}" method="POST">
        @csrf
        @include('superadmin.users._form')
    </form>
</div>
@endsection

@push('scripts')
<script>
    document.addEventListener('DOMContentLoaded', function() {
        // Skrip TomSelect ini sudah benar
        new TomSelect('#role_id_select', {
            placeholder: 'Pilih peran pengguna...',
        });
        new TomSelect('#unit_kerja_id_select', {
            placeholder: 'Pilih unit kerja (jika admin)...',
        });
    });
</script>
@endpush