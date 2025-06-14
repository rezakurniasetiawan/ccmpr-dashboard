<?php

namespace App\Imports;

use Illuminate\Support\Collection;
use Maatwebsite\Excel\Concerns\ToCollection;

class AnswerImport implements ToCollection
{
    /**
     * @param Collection $collection
     */
    public function collection(Collection $collection)
    {
        foreach ($collection as $row) {
            // Assuming the first column is 'thema_text'
            // You can adjust this based on your actual data structure
            if (isset($row[0])) {
                \App\Models\Answers::create([
                    'answer_text' => $row[0],
                    'theme_id' => session('theme_id'), // Assuming you have a theme_id in session
                ]);
            }
        }
    }
}
