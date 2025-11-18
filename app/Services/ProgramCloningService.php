<?php

namespace App\Services;

use App\Models\SurveyProgram;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\DB;

class ProgramCloningService
{
    /**
     * Mengkloning sebuah program survei beserta semua relasinya.
     */
    public function clone(SurveyProgram $program): SurveyProgram
    {
        $newTitle = $program->title . ' (Salinan)';
        $newAlias = Str::slug($newTitle);

        // Pastikan alias unik
        if (SurveyProgram::where('alias', $newAlias)->exists()) {
            $newAlias .= '-' . time();
        }

        // Gunakan DB::transaction untuk memastikan semua proses berhasil
        return DB::transaction(function () use ($program, $newTitle, $newAlias) {

            // Muat semua relasi yang diperlukan (nested)
            $program->load('targetedUnitKerjas', 'questionSections.questions.options');

            // 1. Kloning Program utama
            $newProgram = $program->replicate();
            $newProgram->title = $newTitle;
            $newProgram->alias = $newAlias;
            $newProgram->is_featured = false; // Salinan jangan langsung jadi featured
            $newProgram->created_at = now();
            $newProgram->updated_at = now();
            $newProgram->save();

            // 2. Kloning Target Unit Kerja (Relasi Many-to-Many)
            $newProgram->targetedUnitKerjas()->sync($program->targetedUnitKerjas->pluck('id'));

            // 3. Kloning Bagian Soal (Sections)
            foreach ($program->questionSections as $section) {
                $newSection = $section->replicate();
                $newSection->survey_program_id = $newProgram->id;
                $newSection->created_at = now();
                $newSection->updated_at = now();
                $newSection->save();

                // 4. Kloning Pertanyaan (Questions)
                foreach ($section->questions as $question) {
                    $newQuestion = $question->replicate();
                    $newQuestion->question_section_id = $newSection->id;
                    $newQuestion->created_at = now();
                    $newQuestion->updated_at = now();
                    $newQuestion->save();

                    // 5. Kloning Opsi (Options)
                    foreach ($question->options as $option) {
                        $newOption = $option->replicate();
                        $newOption->question_id = $newQuestion->id;
                        $newOption->created_at = now();
                        $newOption->updated_at = now();
                        $newOption->save();
                    }
                }
            }

            return $newProgram;
        });
    }
}
