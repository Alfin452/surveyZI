@extends('layouts.superadmin')

@section('content')
<div class="p-4 sm:p-6">
    {{-- Header Halaman --}}
    <div class="mb-8 bg-white rounded-xl p-4 md:p-6 border-l-4 border-green-500 shadow-sm">
        <div class="flex items-center gap-4">
            <div class="flex-shrink-0 bg-green-500 text-white p-3 rounded-lg shadow-md">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z" />
                </svg>
            </div>
            <div>
                <h1 class="text-2xl md:text-3xl font-bold text-gray-800">Edit Pertanyaan</h1>
                <p class="text-sm text-gray-500 mt-1">Untuk Survei: <span class="font-semibold">{{ $survey->title }}</span></p>
            </div>
        </div>
    </div>

    <form action="{{ route('superadmin.surveys.questions.update', ['survey' => $survey, 'question' => $question]) }}" method="POST">
        @csrf
        @method('PUT') 
        @include('superadmin.questions._form')
    </form>
</div>
@endsection