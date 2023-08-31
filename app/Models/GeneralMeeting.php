<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class GeneralMeeting extends Model
{
  use HasFactory;

  use SoftDeletes;

  protected $fillable = [
    'title',
    'open_date',
    'place',
    'meeting_filename',
    'minutes_filename',
  ];

  protected $table = 'general_meetings';
}
