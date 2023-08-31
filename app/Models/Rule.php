<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Rule extends Model
{
  use HasFactory;
  use SoftDeletes;

    protected $fillable = [
       'ID',
       'type',
       'chapter',
       'chapter_str',
       'section',
       'section_str',
       'paragraph',
       'paragraph_text',
    ];

    protected $table = 'rules';
}
