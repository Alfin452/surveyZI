@extends('layouts.superadmin')

@section('content')
<div class="p-4 sm:p-6">
    {{-- Header Halaman --}}
    <div class="mb-8 bg-white rounded-xl p-4 md:p-6 border-l-4 border-blue-500 shadow-sm">
        <div class="flex items-center gap-4">
            <div class="flex-shrink-0 bg-blue-500 text-white p-3 rounded-lg shadow-md">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z" />
                </svg>
            </div>
            <div>
                <h1 class="text-2xl md:text-3xl font-bold text-gray-800">Edit Unit Kerja</h1>
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
        new TomSelect('#tipe_unit_id', {
            placeholder: 'Pilih tipe unit...',
        });
        new TomSelect('#parent_id', {
            placeholder: 'Pilih induk unit (jika ada)...',
        });
    });
</script>
@endpush