<?php

namespace App\Exports;

use App\Models\Rule;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;

class RulesExport implements FromCollection, WithHeadings
{
  /**
  * @return \Illuminate\Support\Collection
  */
  public function collection()
  {
    return Rule::all();
  }

  public function headings():array
  {
    return [
      'ID',
      '種類',
      '章',
      '章文',
      '節',
      '節文',
      '条',
      '条文',
      '生成日',
      '更新日',
    ];
  }
}
