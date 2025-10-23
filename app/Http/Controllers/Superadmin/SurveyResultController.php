<?php

namespace App\Http\Controllers\Superadmin;

use App\Http\Controllers\Controller;
use App\Models\Survey;
use App\Models\Answer;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class SurveyResultController extends Controller
{
    /**
     * Menampilkan halaman hasil detail dari satu survei pelaksanaan.
     */
    public function show(Survey $survey)
    {
        // 1. Muat survei beserta pertanyaan dan opsi-opsinya
        $survey->load('questions.options');

        // 2. Hitung total responden yang telah berpartisipasi dalam survei ini
        $totalRespondents = Answer::where('survey_id', $survey->id)
            ->distinct('user_id')
            ->count('user_id');

        // 3. Ambil semua jawaban untuk survei ini dan hitung agregatnya
        // Kita akan mengelompokkan berdasarkan question_id, lalu option_id, dan menghitung totalnya
        $answerCounts = Answer::where('survey_id', $survey->id)
            ->select('question_id', 'option_id', DB::raw('count(*) as total'))
            ->groupBy('question_id', 'option_id')
            ->get()
            ->groupBy('question_id'); // Kelompokkan hasil berdasarkan ID pertanyaan

        // 4. Siapkan data untuk dikirim ke view
        $chartData = [];
        foreach ($survey->questions as $question) {
            $labels = $question->options->pluck('option_body');
            $data = $question->options->map(function ($option) use ($answerCounts, $question) {
                // Cari jumlah jawaban untuk opsi ini
                return $answerCounts->get($question->id)
                    ? $answerCounts->get($question->id)->firstWhere('option_id', $option->id)['total'] ?? 0
                    : 0;
            });

            $chartData[] = [
                'question_id' => $question->id,
                'question_body' => $question->question_body,
                'labels' => $labels,
                'data' => $data,
                'options' => $question->options // Kirim juga data opsi untuk tabel
            ];
        }

        return view('superadmin.results.show', compact('survey', 'totalRespondents', 'chartData'));
    }
}
