<?php

namespace App\Http\Controllers\Superadmin;

use App\Http\Controllers\Controller;
use App\Models\Survey;
use App\Models\Question;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class QuestionOrderController extends Controller
{
    /**
     * 
     */
    public function __invoke(Request $request, Survey $survey)
    {
        // Validasi data yang masuk
        $request->validate([
            'order' => 'required|array',
            'order.*' => 'exists:questions,id', // Pastikan semua ID ada di tabel questions
        ]);

        // Gunakan transaksi database untuk memastikan semua data aman
        DB::transaction(function () use ($request) {
            // Loop melalui setiap ID pertanyaan yang dikirim dari frontend
            foreach ($request->order as $index => $questionId) {
                // Update 'order_column' berdasarkan posisinya di array
                Question::where('id', $questionId)
                    ->update(['order_column' => $index + 1]);
            }
        });

        // Kembalikan respons JSON yang menandakan sukses
        return response()->json(['status' => 'success', 'message' => 'Urutan pertanyaan berhasil disimpan.']);
    }
}
