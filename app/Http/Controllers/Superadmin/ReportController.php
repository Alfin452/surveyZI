<?php

namespace App\Http\Controllers\Superadmin;

use App\Http\Controllers\Controller;
use App\Models\SurveyProgram;
use App\Models\UnitKerja;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Maatwebsite\Excel\Facades\Excel;
use App\Exports\AggregateReportExport;
use App\Services\ReportService;

class ReportController extends Controller
{
    protected $reportService;
    public function __construct(ReportService $reportService)
    {
        $this->reportService = $reportService;
    }

    public function index(Request $request)
    {
        $programs = SurveyProgram::where('is_active', true)
            ->orderBy('title')
            ->get();

        $selectedProgram = null;
        $reportData = [];

        if ($request->filled('program_id')) {
            $selectedProgram = SurveyProgram::with([
                'targetedUnitKerjas' => fn($q) => $q->orderBy('unit_kerja_name'),
                'questionSections' => fn($q) => $q->orderBy('order_column'),
                'unitKerja' 
            ])
                ->findOrFail($request->program_id);

            $reportData = $this->reportService->getAggregateReport($selectedProgram);
        }
        
        return view('superadmin.reports.index', compact(
            'programs',
            'selectedProgram',
            'reportData'
        ));
    }

    public function showUnitDetail($program_id, $unit_kerja_id)
    {
        $program = SurveyProgram::findOrFail($program_id);
        $unitKerja = UnitKerja::findOrFail($unit_kerja_id);
        
        $sections = $program->questionSections()->orderBy('order_column')->get();

        $reportData = $this->reportService->getUnitDetailReport($program, $unitKerja);

        return view('superadmin.reports.show_unit', compact(
            'program',
            'unitKerja',
            'sections',
            'reportData'
        ));
    }

    public function export(Request $request)
    {
        $request->validate([
            'program_id' => 'required|exists:survey_programs,id',
        ]);
        $program = SurveyProgram::findOrFail($request->program_id);
        $fileName = 'Laporan Agregat - ' . Str::slug($program->title) . '.xlsx';
        return Excel::download(new AggregateReportExport($program), $fileName);
    }
}