@extends('layouts.superadmin')

@section('content')
{{-- PERBAIKAN: Menyamakan padding 'p-2 space-y-6' agar konsisten --}}
<div class="space-y-1">

    {{-- Header Halaman --}}
    {{-- PERBAIKAN: Menyamakan style header card (padding, border, radius) --}}
    <div class="bg-white rounded-lg p-5 border border-gray-200 shadow-sm">
        <div class="flex items-start gap-3">

            {{-- PERBAIKAN: Menyamakan ikon (warna indigo, padding, size) --}}
            <div class="flex-shrink-0 bg-indigo-500 text-white p-2 rounded-md">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z" />
                </svg>
            </div>
            <div>
                {{-- PERBAIKAN: Menyamakan font size 'text-xl' --}}
                <h1 class="text-xl font-bold text-gray-800">Edit Pertanyaan</h1>
                <p class="text-sm text-gray-500 mt-1">Untuk Program: <span class="font-semibold">{{ $program->title }}</span></p>
            </div>
        </div>
    </div>

    {{-- Form --}}
    <form action="{{ route('superadmin.programs.questions.update', ['program' => $program, 'question' => $question]) }}" method="POST">
        @csrf
        @method('PUT') {{-- Penting: Memberitahu Laravel bahwa ini adalah proses update --}}
        @include('superadmin.programs.questions._form', ['program' => $program, 'question' => $question])
    </form>
</div>
@endsection