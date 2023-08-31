<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Enquete extends Model
{
  use HasFactory;
  use SoftDeletes;

  protected $fillable = [
    'title',
    'start_at',
    'expired_at',
    'detail',
  ];

  protected $table = 'enquetes';

  public function items() {
    return $this->hasMany(EnqueteItem::class, 'enquete_id', 'id');
  }

  public function schedules() {
    return $this->hasOne(Schedule::class, 'enquete_id', 'id');
  }

  public function getEnquetesAll() {
    return Enquete::all()->sortByDesc('id');
  }

}
