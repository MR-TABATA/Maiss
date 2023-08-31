<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use App\Consts\CommonConsts;
use App\Http\Requests\NotificationRequest;
use App\Models\Notification;
use App\Models\Schedule;

class NotificationController extends Controller
{
  public function index(Request $request) {
    $object = new Notification();
    $notifications = $object->getNotificationAll();
    return view('notification.index', compact('notifications'));
  }

  public function show(Notification $notification, $id) {
    $notification = Notification::with('schedules')->find($id);
    return view('notification.show', compact('notification'));
  }

  public function index_board(Request $request) {
    $object = new Notification();
    $notifications = $object->getNotificationAll();
    return view('board_members.notification.index', compact('notifications'));
  }
  public function show_board(Notification $notification, $id) {
    $notification = Notification::with('schedules')->find($id);
    return view('board_members.notification.show', compact('notification'));
  }

  public function show_register_board() {
    return view('board_members.notification.register');
  }

  public function register_board(NotificationRequest $request) {
    $regist_notification = [
      'title'=>$request['title'],
      'content'=>$request['content'],
      'user_id'=>Auth::id(),
    ];
    DB::beginTransaction();
    $notification = Notification::query()->create($regist_notification);
    $lastInsertID = $notification->id;
    $regist_schedule = [
      'event_name'=>$request['title'],
      'start_date'=>$request['start_date'],
      'end_date'=>$request['end_date'],
      'url'=> '/notification/show/'.$lastInsertID,
      'notification_id' => $lastInsertID,
    ];
    $schedule = Schedule::query()->create($regist_schedule);

    if ($notification && $schedule) {
        $messageKey =  CommonConsts::FLASH_MESSAGE['SUCCESS_key'];
        $flashMessage =  $notification->title.'の'.CommonConsts::FLASH_MESSAGE['CREATE_SUCCESS'];
        DB::commit();
    } else {
        $messageKey =  CommonConsts::FLASH_MESSAGE['ERROR_key'];
        $flashMessage =  $notification->title.'の'.CommonConsts::FLASH_MESSAGE['CREATE_ERROR'];
        DB::rollBack();
    }
    return redirect()->route('notification-index-board')->with($messageKey, $flashMessage);
  }

  public function show_edit_board(Request $request, $id) {
    $notification = Notification::with('schedules')->find($id);
    return view('board_members.notification.edit', compact('notification'));
  }

  public function edit_board(NotificationRequest $request, $id) {
    $notification = Notification::with('schedules')->find($id);
    $notification->title = $request->title;
    $notification->content = $request->content;
    $notification->user_id = Auth::id();

    $schedule = Schedule::find($notification->schedules->id);
    $schedule->id = $notification->schedules->id;
    $schedule->event_name = $request->title;
    $schedule->start_date = $request->start_date;
    $schedule->end_date = $request->end_date;
    $schedule->url = '/notification/show/'.$id;

    DB::beginTransaction();
      $Notification = $notification->save();
      $Schedule = $schedule->save();

    if ($Notification && $Schedule) {
      $messageKey =  CommonConsts::FLASH_MESSAGE['SUCCESS_key'];
      $flashMessage =  $notification->title.'の'.CommonConsts::FLASH_MESSAGE['EDIT_SUCCESS'];
      DB::commit();
    } else {
      $messageKey =  CommonConsts::FLASH_MESSAGE['ERROR_key'];
      $flashMessage =  $notification->title.'の'.CommonConsts::FLASH_MESSAGE['EDIT_ERROR'];
      DB::rollBack();
    }
    return redirect()->route('notification-index-board')->with($messageKey, $flashMessage);
  }


  public function delete_board(Request $request, $id) {
    $notification = Notification::with('schedules')->find($id);
    $schedule = Schedule::find($notification->schedules->id);

    $Notification = $notification->delete();
    $Schedule = $schedule->delete();
    if ($Notification && $Schedule) {
      $messageKey =  CommonConsts::FLASH_MESSAGE['SUCCESS_key'];
      $flashMessage = $notification->title.'の'.CommonConsts::FLASH_MESSAGE['DELETE_SUCCESS'];
    } else {
      $messageKey =  CommonConsts::FLASH_MESSAGE['ERROR_key'];
      $flashMessage = $notification->title.'の'.CommonConsts::FLASH_MESSAGE['DELETE_ERROR'];
    }
    return redirect(route('notification-index-board'))->with($messageKey, $flashMessage);
  }
}
