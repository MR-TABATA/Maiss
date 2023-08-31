<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

use App\Models\User;

class Board extends Model
{
  use HasFactory;
  use SoftDeletes;

  protected $fillable = [
    'team',
    'start_date',
    'end_date',
    'user_id',
  ];

  protected $table = 'boards';
  public function user()
  {
    return $this->belongsTo(User::class);
  }
}
