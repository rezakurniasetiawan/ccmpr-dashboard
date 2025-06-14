<?php

namespace App\Imports;

use Illuminate\Support\Collection;
use Maatwebsite\Excel\Concerns\ToCollection;

class StatementsAnswersImport implements ToCollection
{
    /**
     * @param Collection $collection
     */
    public function collection(Collection $collection)
    {
        foreach ($collection as $row) {
            if (isset($row[0])) {
                \App\Models\StatementsAnswers::create([
                    'statements_id' => session('statements_id'), // Assuming the ID is stored in session
                    'type' => $row[0] ?? null, // Assuming the second column is 'type'
                    'answer_text' => $row[1] ?? null, // Assuming the third column is 'answer_text
                ]);
            }
        }
    }
}


//  'statements_id',
//         'type',
//         'answer_text',