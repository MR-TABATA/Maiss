<?php

namespace App\Http\Controllers;

use App\Consts\CommonConsts;
use App\Consts\EnqueteConsts;
use App\Http\Requests\EnqueteAnswerRequest;
use App\Http\Requests\EnqueteRequest;
use App\Models\Enquete;
use App\Models\EnqueteAnswer;
use App\Models\EnqueteItem;
use App\Models\Schedule;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Redirect;


class EnqueteController extends Controller
{
  /**
   * Display a listing of the resource.
   */
  public function __enquetes(Request $request)
  {
    //回答の募集中
    $Enquete = new Enquete();
    $now = now();
    $on_off = $request->code;
    if($on_off == 'on') {
      $enquetes = $Enquete::where('start_at', '<', $now)->where('expired_at', '>=', $now)->get();
    } elseif($on_off == 'off') {
      $enquetes = $Enquete::where('expired_at', '<', $now)->get();
    }
    return view('enquete.index', compact('enquetes', 'on_off'));
  }

  public function index()
  {
    $Enquete = new Enquete();
    $enquetes = $Enquete::get()->sortByDesc('expired_at');
    return view('enquete.index', compact('enquetes'));
  }

  public function index_board()
  {
    $Enquete = new Enquete();
    $enquetes = $Enquete::get()->sortByDesc('expired_at');
    return view('board_members.enquete.index', compact('enquetes'));
  }

  /**
   * Show the form for creating a new resource.
   */
  public function show_register_board()
  {
    return view('board_members.enquete.register');
  }

  /**
   * Store a newly created resource in storage.
   */
  public function register_board(EnqueteRequest $request) {
    $regist_enquete = [
      'title'=>$request['title'],
      'start_at'=>$request['start_at'],
      'expired_at'=>$request['expired_at'],
      'detail'=>$request['detail'],
    ];
    DB::beginTransaction();
      $enquete = Enquete::query()->create($regist_enquete);
      $lastInsertID = $enquete->id;
      $regist_schedule = [
        'event_name'=>$request['title'],
        'start_date'=>$request['start_at'],
        'end_date'=>$request['expired_at'],
        'enquete_id'=>$lastInsertID,
        'url'=> '/enquete/show/'.$lastInsertID,
      ];
      $Schedule = Schedule::query()->create($regist_schedule);

      for( $i = 1; $i <= EnqueteConsts::OPTION_COUNTER; $i++) {
        if( $request['option_'.$i] ) {
          $regist_enquete_items[] = [
            'enquete_id' => $lastInsertID,
            'option' => $request['option_'.$i],
            'created_at' => now(),
            'updated_at' => now(),
           ];
        }
      }
      $enquete_items = EnqueteItem::insert($regist_enquete_items);

      if ($enquete && $enquete_items && $Schedule) {
        $messageKey =  CommonConsts::FLASH_MESSAGE['SUCCESS_key'];
        $flashMessage =  $enquete->title.'の'.CommonConsts::FLASH_MESSAGE['CREATE_SUCCESS'];
        DB::commit();
      } else {
        $messageKey =  CommonConsts::FLASH_MESSAGE['ERROR_key'];
        $flashMessage =  $enquete->title.'の'.CommonConsts::FLASH_MESSAGE['CREATE_ERROR'];
        DB::rollBack();
      }
    return redirect()->route('enquete-index-board')->with($messageKey, $flashMessage);
  }

  /**
   * Display the specified resource.
   */
  public function show(Enquete $enquete, $id)
  {
    $enquete->load('items');
    $enquete = Enquete::find($id);

    $EnqueteAnswer = new EnqueteAnswer();
    $answer = $EnqueteAnswer::where('enquete_id', $id)->where('user_id', Auth::id())->get();

    $aggregated_items = false;
    if($enquete->expired_at < now()) {
      //集計
      $EnqueteItem = new EnqueteItem();
      $aggregated_items = $EnqueteItem::where('enquete_id', $id)->get();
    }
    return view('enquete.show', compact('enquete', 'answer', 'aggregated_items'));

  }

  public function show_board(Enquete $enquete, $id)
  {
    $enquete->load('items');
    $enquete = Enquete::find($id);

    $EnqueteAnswer = new EnqueteAnswer();
    $answer = $EnqueteAnswer::where('enquete_id', $id)->where('user_id', Auth::id())->get();

    //集計
    $EnqueteItem = new EnqueteItem();
    $aggregated_items = $EnqueteItem::where('enquete_id', $id)->get();

    return view('board_members.enquete.show', compact('enquete', 'answer', 'aggregated_items'));

  }

  /**
   * Show the form for editing the specified resource.
   */
  public function show_edit_board(Enquete $enquete, $id)
  {
    $enquete->load('items');
    $enquete = Enquete::find($id);
    $enquete_item_key = -1;
    if( $enquete->start_at = '1970-01-01 00:00:00') {
      $enquete->start_at = Carbon::now()->addWeek(1);
    }
    return view('board_members.enquete.edit', compact('enquete', 'enquete_item_key'));
  }

  /**
   * Update the specified resource in storage.
   */
  public function edit_board(EnqueteRequest $request, $id)
  {
    DB::beginTransaction();
      $enquete = Enquete::with('schedules')->find($id);
      $enquete->title = $request->title;
      $enquete->start_at = $request->start_at;
      $enquete->expired_at = $request->expired_at;
      $enquete->detail = $request->detail;
      $EnqueteSave = $enquete->save();
      if( $enquete->schedules ) {
        $schedule = Schedule::find($enquete->schedules->id);
        $schedule->event_name = $request->title;
        $schedule->start_date = $request->start_at;
        $schedule->end_date = $request->expired_at;
        $schedule->url = '/enquete/show/'.$enquete->schedules->$id;
        $Schedule = $schedule->save();
      } else {
        $regist_schedule = [
          'event_name'=>$request['title'],
          'start_date'=>$request['start_at'],
          'end_date'=>$request['expired_at'],
          'enquete_id'=>$id,
          'url'=> '/enquete/show/'.$id,
        ];
        $Schedule = Schedule::query()->create($regist_schedule);
      }

      $enquete_items = EnqueteItem::where('enquete_id', $id)->get();
      $EnqueteItemDelete = true;
      if( $enquete_items ) {
        foreach( $enquete_items AS $enquete_item) {
          $item = EnqueteItem::find($enquete_item->id);
          $EnqueteItemDelete = $item->delete();
        }
      }

      for( $i = 0; $i < count($request->option); $i++) {
        if( $request->option[$i] ) {
          $regist_enquete_items[] = [
            'enquete_id' => $id,
            'option' => $request->option[$i],
            'created_at' => now(),
            'updated_at' => now(),
          ];
        }
      }
      $EnqueteItemInsert = EnqueteItem::insert($regist_enquete_items);

    if ($EnqueteSave && $EnqueteItemDelete && $EnqueteItemInsert && $Schedule) {
        $messageKey =  CommonConsts::FLASH_MESSAGE['SUCCESS_key'];
        $flashMessage =  $enquete->title.'の'.CommonConsts::FLASH_MESSAGE['EDIT_SUCCESS'];
        DB::commit();
      } else {
        $messageKey =  CommonConsts::FLASH_MESSAGE['ERROR_key'];
        $flashMessage =  $enquete->title.'の'.CommonConsts::FLASH_MESSAGE['EDIT_ERROR'];
        DB::rollBack();
      }
      return redirect()->route('enquete-show-board', $id)->with($messageKey, $flashMessage);
  }

  /**
   * Remove the specified resource from storage.
   */
  public function delete_board(Enquete $enquete, $id)
  {
    $enquete = Enquete::with('schedules')->with('items')->find($id);
    $schedule = Schedule::find($enquete->schedules->id);

    DB::beginTransaction();
    foreach( $enquete->items AS $key => $enquete_item) {
      $enqueteitem = EnqueteItem::find($enquete_item->id);
      $EnqueteItem = $enqueteitem->delete();
      if( !$EnqueteItem ) {
        $messageKey =  CommonConsts::FLASH_MESSAGE['ERROR_key'];
        $flashMessage = $enquete->title.'の'.CommonConsts::FLASH_MESSAGE['DELETE_ERROR'];
        DB::rollBack();
      }
    }
    $Enquete = $enquete->delete();
    $Schedule = $schedule->delete();
    if ($Enquete && $Schedule ) {
      $messageKey =  CommonConsts::FLASH_MESSAGE['SUCCESS_key'];
      $flashMessage = $enquete->title.'の'.CommonConsts::FLASH_MESSAGE['DELETE_SUCCESS'];
      DB::commit();
    } else {
      $messageKey =  CommonConsts::FLASH_MESSAGE['ERROR_key'];
      $flashMessage = $enquete->title.'の'.CommonConsts::FLASH_MESSAGE['DELETE_ERROR'];
      DB::rollBack();
    }
    return redirect(route('enquete-index-board'))->with($messageKey, $flashMessage);
  }
}
