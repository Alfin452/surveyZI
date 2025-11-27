<?php

namespace App\Exports;

use App\Models\SurveyProgram;
use App\Models\Answer;
use App\Models\UnitKerja;
use Illuminate\Contracts\Queue\ShouldQueue;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithMapping;
use Maatwebsite\Excel\Concerns\ShouldAutoSize;
use Maatwebsite\Excel\Concerns\WithStyles;
use Maatwebsite\Excel\Concerns\WithEvents;
use Maatwebsite\Excel\Events\AfterSheet;
use PhpOffice\PhpSpreadsheet\Worksheet\Worksheet;
use PhpOffice\PhpSpreadsheet\Cell\Coordinate;
use Illuminate\Support\Facades\DB;

class ProgramAverageExport implements FromCollection, WithHeadings, WithMapping, ShouldAutoSize, WithStyles, ShouldQueue, WithEvents
{
    protected $programId;
    protected $unitId; // Tambahan Property
    protected $programTitle;
    protected $sections;

    // Tambahkan parameter $unitId = null
    public function __construct($programId, $unitId = null)
    {
        $this->programId = $programId;
        $this->unitId = $unitId; // Simpan Unit ID

        $program = SurveyProgram::find($programId);
        $this->programTitle = $program ? $program->title : '-';

        $this->sections = \App\Models\QuestionSection::where('survey_program_id', $programId)
            ->orderBy('order_column')
            ->get();
    }

    public function collection()
    {
        // Query Dasar
        $query = Answer::where('survey_program_id', $this->programId);

        // FILTER UNIT: Jika ada unitId, filter hanya unit tersebut
        if ($this->unitId) {
            $query->where('unit_kerja_id', $this->unitId);
        }

        $unitIds = $query->distinct()->pluck('unit_kerja_id');

        return UnitKerja::whereIn('id', $unitIds)
            ->orderBy('unit_kerja_name')
            ->get();
    }

    public function headings(): array
    {
        // ... (SAMA SEPERTI SEBELUMNYA, TIDAK BERUBAH) ...
        $metadata = [
            ['LAPORAN ANALISIS SKOR SURVEI'],
            ['Program Survei: ' . $this->programTitle],
            ['Tanggal Export: ' . date('d F Y, H:i') . ' WIB'],
            [''],
        ];

        $tableHeader = ['Unit Kerja', 'Total Responden'];

        foreach ($this->sections as $section) {
            $tableHeader[] = $section->title;
        }

        $tableHeader[] = 'Skor Rata-rata Total';
        $tableHeader[] = 'Kategori Mutu';

        return array_merge($metadata, [$tableHeader]);
    }

    public function map($unit): array
    {
        // Pastikan query penghitungan juga memfilter unit_id jika properti $unitId terisi
        // (Meski logic collection di atas sudah memfilter unitnya, query di dalam map ini independen)

        $respondentCount = Answer::where('survey_program_id', $this->programId)
            ->where('unit_kerja_id', $unit->id)
            ->distinct('user_id')
            ->count('user_id');

        $totalAvg = Answer::where('survey_program_id', $this->programId)
            ->where('unit_kerja_id', $unit->id)
            ->avg('answer_skor');

        $kategori = 'Kurang';
        if ($totalAvg >= 3.26) $kategori = 'Sangat Baik';
        elseif ($totalAvg >= 2.51) $kategori = 'Baik';
        elseif ($totalAvg >= 1.76) $kategori = 'Cukup';

        $row = [];
        $row[] = $unit->unit_kerja_name;
        $row[] = $respondentCount;

        foreach ($this->sections as $section) {
            $sectionAvg = Answer::where('survey_program_id', $this->programId)
                ->where('unit_kerja_id', $unit->id)
                ->whereIn('question_id', $section->questions->pluck('id'))
                ->avg('answer_skor');

            $row[] = $sectionAvg ? number_format($sectionAvg, 2) : '-';
        }

        $row[] = number_format($totalAvg, 2);
        $row[] = $kategori;

        return $row;
    }

    // ... (Metode styles dan registerEvents SAMA SEPERTI SEBELUMNYA) ...
    public function styles(Worksheet $sheet)
    {
        // ... Copy logic style dari file sebelumnya ...
        // Agar tidak kepanjangan, gunakan logika style "Conditional Formatting" yang terakhir kita buat

        $styles = [
            1 => ['font' => ['bold' => true, 'size' => 14]],
            2 => ['font' => ['bold' => true]],
            5 => [
                'font' => ['bold' => true, 'color' => ['argb' => 'FFFFFF']],
                'fill' => ['fillType' => 'solid', 'startColor' => ['argb' => '4F46E5']],
                'alignment' => ['horizontal' => 'center', 'vertical' => 'center'],
            ],
            'A' => ['alignment' => ['horizontal' => 'left']],
        ];

        $highestRow = $sheet->getHighestRow();
        $highestColumn = $sheet->getHighestColumn();
        $highestColumnIndex = Coordinate::columnIndexFromString($highestColumn);

        for ($row = 6; $row <= $highestRow; $row++) {
            for ($col = 3; $col < $highestColumnIndex; $col++) {
                $colString = Coordinate::stringFromColumnIndex($col);
                $cellCoordinate = $colString . $row;
                $cellValue = $sheet->getCell($cellCoordinate)->getValue();

                if (is_numeric($cellValue)) {
                    if ($cellValue > 3.50) {
                        $styles[$cellCoordinate] = ['font' => ['bold' => true, 'color' => ['argb' => 'FF16A34A']], 'alignment' => ['horizontal' => 'center']];
                    } elseif ($cellValue < 2.00) {
                        $styles[$cellCoordinate] = ['font' => ['bold' => true, 'color' => ['argb' => 'FFDC2626']], 'alignment' => ['horizontal' => 'center']];
                    } else {
                        $styles[$cellCoordinate] = ['alignment' => ['horizontal' => 'center']];
                    }
                } else {
                    $styles[$cellCoordinate] = ['alignment' => ['horizontal' => 'center']];
                }
            }
            $lastColString = Coordinate::stringFromColumnIndex($highestColumnIndex);
            $styles[$lastColString . $row] = ['alignment' => ['horizontal' => 'center']];
        }
        $styles['B'] = ['alignment' => ['horizontal' => 'center']];

        return $styles;
    }

    public function registerEvents(): array
    {
        return [
            AfterSheet::class => function (AfterSheet $event) {
                $event->sheet->freezePane('A6');
            },
        ];
    }
}
