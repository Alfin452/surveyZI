@extends('layouts.superadmin')

@section('content')
<div class="space-y-6">

    <div class="bg-white rounded-lg p-5 border border-gray-200 shadow-sm">
        <h1 class="text-xl font-bold text-gray-800">Laporan Agregat per Bagian</h1>
        <p class="text-sm text-gray-500 mt-1">Ringkasan skor per section (bagian) dari survei.</p>
    </div>

    <div class="bg-white p-5 rounded-lg shadow-sm border border-gray-200">
        <form action="{{ route('superadmin.reports.index') }}" method="GET">
            <label class="block text-sm font-medium text-gray-700 mb-1">Pilih Program Survei</label>
            <select id="program_id" name="program_id" required class="w-full rounded-md">
                <option value="">Pilih program...</option>
                @foreach($programs as $program)
                <option value="{{ $program->id }}" {{ $selectedProgram && $selectedProgram->id == $program->id ? 'selected' : '' }}>
                    {{ $program->title }}
                </option>
                @endforeach
            </select>

            <button class="mt-3 bg-gray-800 text-white px-4 py-2 rounded">Tampilkan Laporan</button>
        </form>
    </div>

    @if($selectedProgram)

    @php
    $sections = $questions->groupBy('section_title');

    // Bersihkan nama section agar tidak ada key kosong
    $cleanSections = $sections->mapWithKeys(function($qs, $title) {
    $clean = trim($title) === '' ? 'Tanpa Bagian' : $title;
    return [$clean => $qs];
    });
    @endphp

    <div class="overflow-x-auto bg-white rounded-lg shadow-sm border border-gray-200">
        <table class="min-w-full divide-y divide-gray-200">

            <thead class="bg-gray-50">
                <tr>
                    <th class="px-6 py-3 text-left text-xs font-semibold text-gray-600 sticky left-0 bg-gray-50 z-10">
                        Unit Kerja
                    </th>

                    @foreach($cleanSections as $sectionTitle => $qs)
                    <th class="px-6 py-3 text-center text-xs font-semibold text-white bg-gray-800">
                        {{ $sectionTitle }}
                    </th>
                    @endforeach

                    <th class="px-6 py-3 text-center text-xs font-semibold text-gray-600 sticky right-0 bg-gray-50 z-10">
                        Rata-rata Total
                    </th>
                </tr>

                <tr>
                    <th class="px-6 py-3 sticky left-0 bg-gray-50 z-10"></th>

                    @foreach($cleanSections as $sectionTitle => $qs)
                    <th class="px-6 py-3 text-center text-xs text-gray-600">
                        Total / Max / Avg
                    </th>
                    @endforeach

                    <th class="px-6 py-3 sticky right-0 bg-gray-50 z-10"></th>
                </tr>
            </thead>

            <tbody class="bg-white divide-y divide-gray-200">

                @foreach($reportData as $row)
                <tr class="hover:bg-gray-50">
                    <td class="px-6 py-4 font-semibold sticky left-0 bg-white">
                        {{ $row['unit_name'] }}
                    </td>

                    @foreach($cleanSections as $sectionTitle => $qs)
                    <td class="px-6 py-4 text-center text-sm">
                        {{ number_format($row['section_totals'][$sectionTitle] ?? 0, 2) }}
                        /
                        {{ $row['section_max'][$sectionTitle] ?? 0 }}
                        /
                        {{ isset($row['section_avg'][$sectionTitle]) ? number_format($row['section_avg'][$sectionTitle], 2) : '-' }}
                    </td>
                    @endforeach

                    <td class="px-6 py-4 text-center font-bold sticky right-0 bg-white">
                        {{ $row['total_avg'] ? number_format($row['total_avg'], 2) : '-' }}
                    </td>
                </tr>
                @endforeach

            </tbody>
        </table>
    </div>

    @endif

</div>
@endsection

@push('scripts')
<script>
    new TomSelect('#program_id', {
        placeholder: 'Pilih program survei...'
    });
</script>
@endpush