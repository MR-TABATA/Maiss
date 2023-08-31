<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Schedule extends Model
{
  use HasFactory;
  use SoftDeletes;

  protected $fillable = [
    'enquete_id',
    'notification_id',
    'start_date',
    'end_date',
    'event_name',
    'url',
  ];

  protected $table = 'schedules';

  public function enquetes(): BelongsToMany
  {
    return $this->belongsToMany(Enquete::class, 'schedules');
  }

  public function notifications(): BelongsToMany
  {
    return $this->belongsToMany(Notification::class, 'schedules');
  }

}
