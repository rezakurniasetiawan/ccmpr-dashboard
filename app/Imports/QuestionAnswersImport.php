<?php

namespace App\Imports;

use Illuminate\Support\Collection;
use Maatwebsite\Excel\Concerns\ToCollection;

class QuestionAnswersImport implements ToCollection
{
    /**
     * @param Collection $collection
     */
    public function collection(Collection $collection)
    {
        foreach ($collection as $row) {
            // Assuming the first column is 'question_text'
            // and the second column is 'answer_text'
            if (isset($row[0]) && isset($row[1])) {
                \App\Models\QuestionsAnswers::create([
                    'question_text' => $row[0],
                    'answer_text' => $row[1],
                    'stage_id' => session('stage_id'),
                    'session_id' => session('stage_session_id'),
                ]);
            }
        }
    }
}
