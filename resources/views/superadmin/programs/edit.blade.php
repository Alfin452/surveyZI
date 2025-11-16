@extends('layouts.superadmin')

@section('content')
<div class="space-y-1">
    {{-- Header Halaman --}}
    <div class="bg-white rounded-lg p-5 border border-gray-200 shadow-sm">
        <div class="flex items-start gap-3">
            <div class="flex-shrink-0 bg-indigo-500 text-white p-2 rounded-md">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z" />
                </svg>
            </div>
            <div>
                <h1 class="text-xl font-bold text-gray-800">Edit Program Survei</h1>
                <p class="text-sm text-gray-500 mt-1">Perbarui detail untuk: <span class="font-semibold">{{ $program->title }}</span></p>
            </div>
        </div>
    </div>

    {{-- Form --}}
    <form action="{{ route('superadmin.programs.update', $program) }}" method="POST">
        @csrf
        @method('PUT')
        @include('superadmin.programs._form')
    </form>
</div>
@endsection

@push('scripts')
<script>
    document.addEventListener('DOMContentLoaded', function() {
        const select = document.getElementById('targeted_unit_kerjas_select');
        if (!select) return;

        const tomSelect = new TomSelect(select, {
            placeholder: 'Pilih minimal satu unit kerja...',
            plugins: ['remove_button'],
            maxOptions: 200,
        });

        // Logika untuk tombol "Pilih Semua" dan "Hapus Semua"
        const btnSelectAll = document.getElementById('select-all-button');
        const btnDeselectAll = document.getElementById('deselect-all-button');

        if (btnSelectAll && btnDeselectAll) {
            btnSelectAll.addEventListener('click', () => {
                const allOptionIds = Object.keys(tomSelect.options);
                tomSelect.setValue(allOptionIds);
            });

            btnDeselectAll.addEventListener('click', () => {
                tomSelect.clear();
            });
        }

        // Hapus style error TomSelect jika pengguna mulai memilih
        tomSelect.on('change', function() {
            if (tomSelect.items.length > 0) {
                tomSelect.wrapper.classList.remove('tomselect-error');
            }
        });

        // Terapkan style error TomSelect HANYA jika ada error dari server (Laravel)
        @if($errors -> has('targeted_unit_kerjas'))
        tomSelect.wrapper.classList.add('tomselect-error');
        @endif
    });
</script>

<style>
    .tomselect-error .ts-control {
        @apply border-red-500 ring-1 ring-red-500;
    }

    #targeted_unit_kerjas_select {
        display: none !important;
    }

    .min-h-5 {
        min-height: 1.25rem;
        /* 20px */
    }
</style>
@endpush