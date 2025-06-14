<?php

namespace App\Imports;

use Illuminate\Support\Collection;
use Maatwebsite\Excel\Concerns\ToCollection;

class ThemeImport implements ToCollection
{
    /**
     * @param Collection $collection
     */
    public function collection(Collection $collection)
    {
        // Process the imported data
        foreach ($collection as $row) {
            // Assuming the first column is 'thema_text'
            // You can adjust this based on your actual data structure
            if (isset($row[0])) {
                \App\Models\Themes::create([
                    'thema_text' => $row[0],
                    'question_text' => $row[1] ?? null, // Assuming the second column is 'question_text'
                    'stage_id' => session('stage_id'),
                    'session_id' => session('stage_session_id'),
                ]);
            }
        }
    }
}
