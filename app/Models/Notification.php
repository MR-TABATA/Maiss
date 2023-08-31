<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;


class Notification extends Model
{
  use HasFactory;
  use SoftDeletes;

  protected $fillable = [
    'title',
    'content',
    'user_id',
  ];

  protected $table = 'notifications';

  public function getNotificationParment($parmanent){
    $data = Notification::all()->where('is_parmanent', $parmanent)->sortByDesc('id')->take(5);
    return $data;
  }

  public function getNotificationAll(){
    $data = Notification::all()->sortByDesc('id');
    return $data;
  }

  public function schedules() {
    return $this->hasOne(Schedule::class, 'notification_id', 'id');
  }
}
