@extends('layouts.superadmin')

@section('content')
<div class="p-4 sm:p-6" x-data>
    {{-- Header Halaman --}}
    <div class="mb-8 bg-white rounded-xl p-4 md:p-6 border-l-4 border-blue-500 shadow-sm">
        <div class="flex flex-col md:flex-row md:justify-between md:items-start">
            <div>
                {{-- Breadcrumbs --}}
                <nav class="text-sm mb-2 font-medium text-gray-500" aria-label="Breadcrumb">
                    <ol class="list-none p-0 inline-flex">
                        <li class="flex items-center"><a href="{{ route('superadmin.dashboard') }}" class="hover:text-blue-600">Dashboard</a><span class="mx-2">/</span></li>
                        <li class="flex items-center"><a href="{{ route('superadmin.programs.index') }}" class="hover:text-blue-600">Program Survei</a><span class="mx-2">/</span></li>
                        <li class="flex items-center"><a href="{{ route('superadmin.programs.show', $survey->surveyProgram) }}" class="hover:text-blue-600">Detail Program</a><span class="mx-2">/</span></li>
                        <li class="flex items-center"><span class="text-gray-700">Kelola Pertanyaan</span></li>
                    </ol>
                </nav>
                <div class="flex items-center gap-4">
                    <div class="flex-shrink-0 bg-blue-500 text-white p-3 rounded-lg shadow-md">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M8.228 9c.549-1.165 2.03-2 3.772-2 2.21 0 4 1.343 4 3 0 1.4-1.278 2.575-3.006 2.907-.542.104-.994.54-.994 1.093m0 3h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                        </svg>
                    </div>
                    <div>
                        <h1 class="text-2xl md:text-3xl font-bold text-gray-800">Kelola Pertanyaan</h1>
                        <p class="text-sm text-gray-500 mt-1">Survei: <span class="font-semibold">{{ $survey->title }}</span></p>
                    </div>
                </div>
            </div>
            <div class="mt-4 md:mt-0 flex space-x-2 self-start md:self-end">
                <a href="{{ route('superadmin.programs.show', $survey->surveyProgram) }}" class="bg-white text-gray-700 px-4 py-2 rounded-lg font-medium hover:bg-gray-100 transition border">Kembali ke Detail Program</a>

                {{-- PERBAIKAN: Tautan sekarang berfungsi dan mengarah ke route 'questions.create' --}}
                <a href="{{ route('superadmin.surveys.questions.create', $survey) }}" class="bg-indigo-600 text-white px-4 py-2 rounded-lg font-medium hover:bg-indigo-700 transition">Tambah Pertanyaan</a>
            </div>
        </div>
    </div>

    @if(session('success'))
    <div class="bg-green-100 border-l-4 border-green-500 text-green-700 p-4 mb-6 rounded-lg shadow-sm" role="alert">
        <p class="font-semibold">{{ session('success') }}</p>
    </div>
    @endif

    {{-- Daftar Pertanyaan --}}
    <div class="bg-white rounded-xl shadow-lg border p-6">
        <h2 class="text-xl font-bold text-gray-800 mb-4">Daftar Pertanyaan ({{ $survey->questions->count() }})</h2>

        <div class="space-y-4">
            @forelse ($survey->questions as $question)
            <div class="bg-gray-50 border rounded-lg p-4 flex items-center justify-between group">
                <div>
                    <p class="font-semibold text-gray-800">{{ $loop->iteration }}. {{ $question->question_body }}</p>
                    <div class="text-sm text-gray-600 mt-2 space-y-1">
                        @foreach($question->options as $option)
                        <span>- {{ $option->option_body }} (Skor: {{ $option->option_score }})</span><br>
                        @endforeach
                    </div>
                </div>
                <div class="flex items-center space-x-3 opacity-0 group-hover:opacity-100 transition-opacity">
                    <a href="{{ route('superadmin.surveys.questions.edit', ['survey' => $survey, 'question' => $question]) }}" class="text-indigo-600 hover:text-indigo-800" title="Edit Pertanyaan">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z" />
                        </svg>
                    </a>
                    <button type="button" @click="$dispatch('open-delete-modal', { url: '{{ route('superadmin.surveys.questions.destroy', ['survey' => $survey, 'question' => $question]) }}', name: '{{ addslashes($question->question_body) }}' })" class="text-red-600 hover:text-red-800" title="Hapus Pertanyaan">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6M9 7V4a1 1 0 011-1h4a1 1 0 011 1v3M4 7h16" />
                        </svg>
                    </button>
                </div>
            </div>
            @empty
            <div class="text-center py-16 px-4 border-2 border-dashed rounded-lg">
                <svg xmlns="http://www.w3.org/2000/svg" class="mx-auto h-12 w-12 text-gray-400" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="1">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z" />
                </svg>
                <p class="mt-4 font-semibold text-gray-600">Belum Ada Pertanyaan</p>
                <p class="text-gray-500 text-sm mt-1">Klik tombol "Tambah Pertanyaan" untuk memulai.</p>
            </div>
            @endforelse
        </div>
    </div>
</div>
@endsection