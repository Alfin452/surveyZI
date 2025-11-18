@props(['title', 'value', 'subtext', 'icon', 'color' => 'indigo', 'link' => '#'])

@php
$colors = [
'indigo' => ['bg' => 'bg-indigo-50', 'text' => 'text-indigo-600', 'hover' => 'group-hover:text-indigo-600'],
'emerald' => ['bg' => 'bg-emerald-50', 'text' => 'text-emerald-600', 'hover' => 'group-hover:text-emerald-600'],
'amber' => ['bg' => 'bg-amber-50', 'text' => 'text-amber-600', 'hover' => 'group-hover:text-amber-600'],
'rose' => ['bg' => 'bg-rose-50', 'text' => 'text-rose-600', 'hover' => 'group-hover:text-rose-600'],
];

// Gunakan warna default jika warna yang diminta tidak ada di daftar
$c = $colors[$color] ?? $colors['indigo'];
@endphp

<a href="{{ $link }}" class="group block bg-white p-6 rounded-3xl border border-slate-100 shadow-sm hover:shadow-lg hover:-translate-y-1 transition-all duration-300 relative overflow-hidden">
    <div class="flex items-start justify-between relative z-10">
        <div>
            <p class="text-sm font-bold text-slate-400 uppercase tracking-wider mb-1">{{ $title }}</p>
            <h3 class="text-4xl font-black text-slate-800 {{ $c['hover'] }} transition-colors duration-300">{{ $value }}</h3>
            <p class="text-xs text-slate-500 mt-2 font-medium bg-slate-100 inline-block px-2 py-1 rounded-lg">
                {{ $subtext }}
            </p>
        </div>
        <div class="p-3 rounded-2xl {{ $c['bg'] }} {{ $c['text'] }}">
            {{-- Icon SVG --}}
            <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                @if($icon == 'collection')
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 11H5m14 0a2 2 0 012 2v6a2 2 0 01-2 2H5a2 2 0 01-2-2v-6a2 2 0 012-2m14 0V9a2 2 0 00-2-2M5 11V9a2 2 0 012-2m0 0V5a2 2 0 012-2h6a2 2 0 012 2v2M7 7h10" />
                @elseif($icon == 'office-building')
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4" />
                @elseif($icon == 'users')
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4.354a4 4 0 110 5.292M15 21H3v-1a6 6 0 0112 0v1zm0 0h6v-1a6 6 0 00-9-5.197M13 7a4 4 0 11-8 0 4 4 0 018 0z" />
                @else
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 19v-6a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2a2 2 0 002-2zm0 0V9a2 2 0 012-2h2a2 2 0 012 2v10m-6 0a2 2 0 002 2h2a2 2 0 002-2m0 0V5a2 2 0 012-2h2a2 2 0 012 2v14a2 2 0 01-2 2h-2a2 2 0 01-2-2z" />
                @endif
            </svg>
        </div>
    </div>
    {{-- Decorative Blob --}}
    <div class="absolute -right-6 -bottom-6 w-24 h-24 rounded-full {{ $c['bg'] }} opacity-50 group-hover:scale-150 transition-transform duration-500"></div>
</a>