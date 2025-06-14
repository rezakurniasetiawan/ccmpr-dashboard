<?php

namespace App\Imports;

use Illuminate\Support\Collection;
use Maatwebsite\Excel\Concerns\ToCollection;

class StatementImport implements ToCollection
{
    /**
     * @param Collection $collection
     */
    public function collection(Collection $collection)
    {
        foreach ($collection as $row) {
            // Assuming the first column is 'statement_text'
            // You can adjust this based on your actual data structure
            if (isset($row[0])) {
                \App\Models\Statements::create([
                    'stage_id' => session('stage_id'),
                    'session_id' => session('stage_session_id'),
                    'box_name' => $row[0] ?? null, // Assuming the second column is 'box_name'
                    'statement_text' => $row[1], // Assuming the first column is 'statement_text'
                ]);
            }
        }
    }
}
