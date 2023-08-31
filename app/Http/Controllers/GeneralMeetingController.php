<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\File;
use App\Consts\CommonConsts;
use App\Consts\GeneralMeetingConsts;
use App\Http\Requests\GeneralMeetingRequest;
use App\Models\GeneralMeeting;

class GeneralMeetingController extends Controller
{
  public function index() {
    $GeneralMeeting = new GeneralMeeting();
    $general_meetings = $GeneralMeeting::all()->sortByDesc('open_date');
    return view('general_meeting.index', compact('general_meetings'));
  }

  public function meeting_pdf_show(Request $request, $id) {
    $GeneralMeeting = new GeneralMeeting();
    $general_meeting = $GeneralMeeting::find($id);

    $file_path = storage_path('app/'.GeneralMeetingConsts::MEETING_PDF_PATH.'/'.$general_meeting->meeting_filename);

    if( File::exists($file_path)) {
      $headers = ['Content-disposition' => 'inline; filename=".$general_meeting->meeting_filename."'];
      return response()->file($file_path, $headers);
    } else {
      return view('general_meeting.no_pdf');
    }
  }

  public function minutes_pdf_show(Request $request, $id) {
    $GeneralMeeting = new GeneralMeeting();
    $general_meeting = $GeneralMeeting::find($id);
    $file_path = storage_path( 'app/'.GeneralMeetingConsts::MINUTES_PDF_PATH.'/'.$general_meeting->minutes_filename);
    if( file_exists($file_path)) {
      $headers = ['Content-disposition' => 'inline; filename=".$general_meeting->minutes_filename."'];
      return response()->file($file_path, $headers);
    } else {
      return view('general_meeting.no_pdf');
    }
  }

  public function index_board() {
    $general_meetings = GeneralMeeting::all()->sortByDesc('open_date');
    return view('board_members.general_meeting.index', compact('general_meetings'));
  }

  public function show_edit_board(Request $request, $id) {
    $general_meeting = GeneralMeeting::find($id);
    return view('board_members.general_meeting.edit', compact('general_meeting'));
  }

  public function show_register_board() {
    return view('board_members.general_meeting.register');
  }

  public function register_board(GeneralMeetingRequest $request) {
    $regist = [
      'title'=>$request['title'],
      'open_date'=>$request['open_date'],
      'place'=>$request['place'],
    ];
    $regist = $this->__saveFile($regist);

    $general_meeting = GeneralMeeting::query()->create($regist);

    if ($general_meeting) {
      $messageKey =  CommonConsts::FLASH_MESSAGE['SUCCESS_key'];
      $flashMessage =  $general_meeting->title.'の'.CommonConsts::FLASH_MESSAGE['CREATE_SUCCESS'];
    } else {
      $messageKey =  CommonConsts::FLASH_MESSAGE['ERROR_key'];
      $flashMessage =  $general_meeting->title.'の'.CommonConsts::FLASH_MESSAGE['CREATE_ERROR'];
    }
    return redirect()->route('general_meeting-index-board')->with($messageKey, $flashMessage);
  }

  public function edit_board(GeneralMeetingRequest $request, $id) {
    $general_meeting = GeneralMeeting::find($id);
    $general_meeting->title = $request->title;
    $general_meeting->open_date = $request->open_date;
    $general_meeting->place = $request->place;
    $minutes_filename = $general_meeting->minutes_filename;
    $meeting_filename = $general_meeting->meeting_filename;

    $regist = $this->__saveFile($regist);
    $GeneralMeeting = $general_meeting->save();

    if ($GeneralMeeting) {
      $messageKey =  CommonConsts::FLASH_MESSAGE['SUCCESS_key'];
      $flashMessage =  $general_meeting->title.'の'.CommonConsts::FLASH_MESSAGE['EDIT_SUCCESS'];
    } else {
      $messageKey =  CommonConsts::FLASH_MESSAGE['ERROR_key'];
      $flashMessage =  $general_meeting->title.'の'.CommonConsts::FLASH_MESSAGE['EDIT_ERROR'];
    }
    return redirect()->route('general_meeting-index-board')->with($messageKey, $flashMessage);
  }

  private function __saveFile($regist, $meeting_filename=Null, $minutes_filename=Null) {
    if( $regist['meeting_pdf'] ) {
      $regist = $regist+['meeting_filename'=>$regist['meeting_pdf']->getClientOriginalName()];
      if( $meeting_filename) {
        Storage::delete(GeneralMeetingConsts::MEETING_PDF_PATH.'/'.$meeting_filename);
      }
      Storage::putFileAs(
        GeneralMeetingConsts::MEETING_PDF_PATH,
        $regist['meeting_pdf'],
        $regist['meeting_pdf']->getClientOriginalName()
      );
    }
    if( $regist['minutes_pdf']) {
      $regist = $regist+['minutes_filename'=>$regist['minutes_pdf']->getClientOriginalName(),];
      if( $minutes_filename) {
        Storage::delete(GeneralMeetingConsts::MEETING_PDF_PATH.'/'.$minutes_filename);
      }
      Storage::putFileAs(
        GeneralMeetingConsts::MINUTES_PDF_PATH,
        $regist['minutes_pdf'],
        $regist['minutes_pdf']->getClientOriginalName()
      );
    }
    return $regist;
  }

}
