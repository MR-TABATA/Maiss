<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Models\Enquete;
use App\Models\Notification;
use App\Models\Schedule;

class DashboardController extends Controller
{

  public function index() {
    $object = new Notification();
    $notifications['temp'] = $object->getNotificationParment(0);
    $notifications['permanemt'] = $object->getNotificationParment(1);
    $Enquete = new Enquete;
    $enquetes = $Enquete->getEnquetesAll();

    $start_date = date('Y-m-d', strtotime(now()->startOfMonth()->toDateString()));
    $end_date = date('Y-m-d', strtotime(now()->endOfMonth()->toDateString()));

    $schedules = Schedule::where('end_date', '>', $start_date)->where('start_date', '<', $end_date)
      ->select('start_date', 'end_date', 'event_name', 'url', 'enquete_id')
      ->get();

    return view('dashboard/index', compact('enquetes', 'notifications', 'schedules'));
  }
}
