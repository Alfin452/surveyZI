@extends('layouts.superadmin')

@section('content')
{{-- Background Aurora --}}
<div class="absolute top-0 left-0 w-full h-full overflow-hidden -z-10 pointer-events-none">
    <div class="absolute top-0 left-1/4 w-96 h-96 bg-amber-400/20 rounded-full mix-blend-multiply filter blur-3xl animate-blob"></div>
    <div class="absolute top-0 right-1/4 w-96 h-96 bg-orange-400/20 rounded-full mix-blend-multiply filter blur-3xl animate-blob animation-delay-2000"></div>
    <div class="absolute -bottom-8 left-1/3 w-96 h-96 bg-yellow-400/20 rounded-full mix-blend-multiply filter blur-3xl animate-blob animation-delay-4000"></div>
</div>

<div class="relative z-10 space-y-6">

    {{-- 1. Hero Header Section --}}
    <div class="bg-white/60 backdrop-blur-xl rounded-3xl px-6 py-5 border border-white/40 shadow-lg relative overflow-hidden group hover:shadow-amber-100/50 transition-all duration-500">
        <div class="absolute inset-0 bg-gradient-to-r from-amber-500/5 via-orange-500/5 to-yellow-500/5 opacity-0 group-hover:opacity-100 transition-opacity duration-500"></div>

        <div class="relative flex flex-col md:flex-row items-start md:items-center justify-between gap-4">
            <div class="flex items-center gap-4">
                {{-- 3D Icon --}}
                <div class="w-14 h-14 flex-shrink-0 drop-shadow-lg">
                    <img src="https://raw.githubusercontent.com/Tarikul-Islam-Anik/Animated-Fluent-Emojis/master/Emojis/Objects/Pencil.png" alt="Edit Icon" class="w-full h-full object-contain">
                </div>
                <div>
                    <h1 class="text-2xl font-black text-slate-800 tracking-tight">Edit Program Survei</h1>
                    <p class="text-slate-500 text-sm font-medium mt-0.5">Perbarui informasi: <span class="font-bold text-amber-600">{{ $program->title }}</span></p>
                </div>
            </div>

            <a href="{{ route('superadmin.programs.index') }}"
                class="group flex items-center gap-2 px-5 py-2.5 bg-white text-slate-600 border border-slate-200 rounded-xl font-bold shadow-sm hover:bg-slate-50 hover:text-amber-600 transition-all duration-300 text-sm">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 group-hover:-translate-x-1 transition-transform" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18" />
                </svg>
                <span>Kembali</span>
            </a>
        </div>
    </div>

    {{-- 2. Form Section --}}
    <form action="{{ route('superadmin.programs.update', $program) }}" method="POST">
        @csrf
        @method('PUT')
        @include('superadmin.programs._form')
    </form>

</div>
@endsection

{{-- SCRIPT PENTING (TomSelect & Select All) --}}
@push('scripts')
<script>
    document.addEventListener('DOMContentLoaded', function() {

        // 1. Inisialisasi TomSelect
        var unitSelect = new TomSelect('#targeted_unit_kerjas_select', {
            plugins: ['remove_button'],
            create: false,
            placeholder: 'Cari dan pilih unit kerja...',
            maxOptions: null,
            render: {
                option: function(data, escape) {
                    return '<div class="flex items-center gap-2 py-1">' +
                        '<span class="w-2 h-2 rounded-full bg-amber-400"></span>' + // Warna Amber untuk Edit
                        '<span>' + escape(data.text) + '</span>' +
                        '</div>';
                }
            }
        });

        // 2. Logika Pilih Semua
        document.getElementById('select-all-button').addEventListener('click', function() {
            var allValues = Object.keys(unitSelect.options);
            unitSelect.setValue(allValues);
        });

        // 3. Logika Hapus Semua
        document.getElementById('deselect-all-button').addEventListener('click', function() {
            unitSelect.clear();
        });

    });
</script>
@endpush