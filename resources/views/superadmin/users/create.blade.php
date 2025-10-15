@extends('layouts.superadmin')

@section('content')
<div class="p-4 sm:p-6">
    {{-- Header Halaman --}}
    <div class="mb-8 bg-white rounded-xl p-4 md:p-6 border-l-4 border-yellow-500 shadow-sm">
        <div class="flex items-center gap-4">
            <div class="flex-shrink-0 bg-yellow-500 text-white p-3 rounded-lg shadow-md">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" viewBox="0 0 20 20" fill="currentColor">
                    <path fill-rule="evenodd" d="M10 3a1 1 0 011 1v5h5a1 1 0 110 2h-5v5a1 1 0 11-2 0v-5H4a1 1 0 110-2h5V4a1 1 0 011-1z" clip-rule="evenodd" />
                </svg>
            </div>
            <div>
                <h1 class="text-2xl md:text-3xl font-bold text-gray-800">Tambah Pengguna Baru</h1>
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
        new TomSelect('#role_id_select', {
            placeholder: 'Pilih peran pengguna...',
        });
        new TomSelect('#unit_kerja_id_select', {
            placeholder: 'Pilih unit kerja (jika admin)...',
        });
    });
</script>
@endpush