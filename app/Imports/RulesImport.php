<?php

namespace App\Imports;

use App\Models\Rule;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithStartRow;


class RulesImport implements ToModel, WithStartRow
{
    /**
    * @param array $row
    *
    * @return \Illuminate\Database\Eloquent\Model|null
    */
    public function model(array $row)
    {
        return new Rule([
            'id'=>$row['0'],
            'type' => $row['1'],
            'chapter' => $row['2'],
            'chapter_str' => $row['3'],
            'section' => $row['4'],
            'section_str' => $row['5'],
            'paragraph' => $row['6'],
            'paragraph_text' => $row['7'],
        ]);
    }
    public function startRow(): int
    {
        return 2;
    }

}
