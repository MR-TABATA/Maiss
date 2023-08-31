<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserController;
use App\Http\Controllers\BoardController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\EnqueteAnsweController;
use App\Http\Controllers\EnqueteController;
use App\Http\Controllers\GeneralMeetingController;
use App\Http\Controllers\NotificationController;
use App\Http\Controllers\RuleController;
use App\Http\Controllers\ScheduleController;
use App\Http\Controllers\TopController;


/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

//Route::get('/', function () {
//  return view('welcome');
//});

// '/'：rootがサインイン・サインアウト
Route::get('/',[TopController::class,'showLogin']);
Route::post('/',[TopController::class,'signin'])->name('login');
Route::get('/signout',[TopController::class,'signout'])->name('signout');

//管理組合員に許可
Route::group(['middleware' => ['auth', 'can:user']], function () {
  Route::get('/edit',[UserController::class,'edit']);
  Route::post('/edit',[UserController::class,'edit']);

  Route::get('/edit_password',[UserController::class,'show_edit_password'])->name('show-edit-password');
  Route::post('/edit_password',[UserController::class,'edit_password']);

  //Route::get('/dashboard',[UserController::class,'dashboard']);
  Route::get('/dashboard',[DashboardController::class,'index'])->name('dashboard');

  Route::get('/notification', [NotificationController::class,'index'])->name('notification-index');
  Route::get('/notification/show/{id}', [NotificationController::class,'show'])->name('notification-show');

  Route::get('/enquete',[EnqueteController::class,'index'])->name('enquete-index');
  //Route::get('/enquete/enquetes/{code}',[EnqueteController::class,'enquetes'])->name('enquetes_on_off');
  Route::get('/enquete/show/{id}', [EnqueteController::class,'show'])->name('enquete-show');
  Route::post('/enquete_answer/store',[EnqueteAnsweController::class,'store'])->name('enquete-answer-store');

  Route::get('/rule/{type}', [RuleController::class,'index'])->name('rule-index');
  //manage：管理規約、car：駐車、bike：2輪車（バイク・自転車）、handbook：使用細則、delivery_box：宅配ボックス、meeting_room：集会室

  Route::get('/board', [BoardController::class,'index'])->name('board-index');

  Route::get('/general_meeting', [GeneralMeetingController::class,'index'])->name('general_meeting-index');
  Route::get('/general_meeting/meeting_pdf/{id}', [GeneralMeetingController::class,'meeting_pdf_show'])->name('meeting_pdf-show');
  Route::get('/general_meeting/minutes_pdf/{id}', [GeneralMeetingController::class,'minutes_pdf_show'])->name('minutes_pdf-show');

});

//役員以上に許可
Route::group(['middleware' => ['auth', 'can:board']], function () {
  Route::get('/user/board',[UserController::class,'index'])->name('users-list-board');

  Route::get('/notification/board', [NotificationController::class,'index_board'])->name('notification-index-board');
  Route::get('/notification/show/{id}/board', [NotificationController::class,'show_board'])->name('notification-show-board');
  Route::get('/notification/delete/{id}/board',[NotificationController::class,'delete_board'])->name('notification-delete-board');
  Route::get('/notification/register/board',[NotificationController::class,'show_register_board'])->name('notification-show-register-board');
  Route::post('/notification/register/board',[NotificationController::class,'register_board']);
  Route::get('/notification/edit/{id}/board',[NotificationController::class,'show_edit_board'])->name('notification-show-edit-board');
  Route::post('/notification/edit/{id}/board',[NotificationController::class,'edit_board']);

  Route::get('/enquete/board', [EnqueteController::class,'index_board'])->name('enquete-index-board');
  Route::get('/enquete/show/{id}/board', [EnqueteController::class,'show_board'])->name('enquete-show-board');
  Route::get('/enquete/register/board',[EnqueteController::class,'show_register_board'])->name('enquete-show-register-board');
  Route::post('/enquete/register/board',[EnqueteController::class,'register_board']);
  Route::get('/enquete/edit/{id}/board',[EnqueteController::class,'show_edit_board'])->name('enquete-show-edit-board');
  Route::post('/enquete/edit/{id}/board',[EnqueteController::class,'edit_board']);
  Route::get('/enquete/delete/{id}/board',[EnqueteController::class,'delete_board'])->name('enquete-delete-board');

  Route::get('/board/board_member', [BoardController::class,'index_board'])->name('board-index-board');

});

//理事長以上に許可
Route::group(['middleware' => ['auth', 'can:chairman']], function () {
  Route::get('/user/register/board',[UserController::class,'showRegister'])->name('user-register-board');
  Route::post('/user/register/board',[UserController::class,'register']);
  Route::get('/user/edit/{id}/board',[UserController::class,'show_edit'])->name('user-edit-board');
  Route::post('/user/edit/{id}/board',[UserController::class,'edit']);
  Route::get('/user/delete/{id}/board',[UserController::class,'delete'])->name('user-delete-board');

  Route::get('/rule/board/{type}', [RuleController::class,'index_board'])->name('rule-index-board');
  Route::get('/rule/edit/{id}/{type}/board',[RuleController::class,'show_edit_board'])->name('rule-show-edit-board');
  Route::post('/rule/edit/{id}/{type}/board',[RuleController::class,'edit_board']);

  Route::get('/rule/import_export/board', [RuleController::class,'import_export_board'])->name('rule-import-export-board');
  Route::get('/rule/export/board',[RuleController::class,'export_board'])->name('rule-export-board');
  Route::post('/rule/import/board',[RuleController::class,'import_board'])->name('rule-import-board');

  Route::get('/board/register/board_member', [BoardController::class,'show_register_board'])->name('board-show-register-board');
  Route::post('/board/register/board_member', [BoardController::class,'register_board']);
  Route::get('/board/edit/{id}/board_member', [BoardController::class,'show_edit_board'])->name('board-show-edit-board');
  Route::post('/board/edit/{id}/board_member', [BoardController::class,'edit_board']);
  Route::get('/board/delete/{id}/board_member',[BoardController::class,'delete_board'])->name('board-delete-board');

  Route::get('/general_meeting/board',[GeneralMeetingController::class,'index_board'])->name('general_meeting-index-board');
  Route::get('/general_meeting/pdf_upload/board',[GeneralMeetingController::class,'upload_board'])->name('pdf-upload-board');
  Route::get('/general_meeting/register/board',[GeneralMeetingController::class, 'show_register_board'])->name('general_meeting-show-register-board');
  Route::POST('/general_meeting/register/board',[GeneralMeetingController::class, 'register_board']);
  Route::get('/general_meeting/edit/{id}/board',[GeneralMeetingController::class,'show_edit_board'])->name('general_meeting-edit-board');
  Route::post('/general_meeting/edit/{id}/board',[GeneralMeetingController::class,'edit_board']);
  /*
  Route::get('/rule/register',[RuleController::class,'board_register'])->name('rule-board-register');

  Route::get('/rule/delete/{id}',[RuleController::class,'board_delete'])->name('rule-board-delete');

  Route::get('/general_meeting/register',[GeneralMeetingController::class,'board_register'])->name('general_meeting-board-register');
  Route::get('/general_meeting/edit/{id}',[GeneralMeetingController::class,'board_edit'])->name('general_meeting-board-edit');
  Route::post('/general_meeting/edit/{id}',[GeneralMeetingController::class,'board_edit']);
  Route::get('/general_meeting/delete/{id}',[GeneralMeetingController::class,'dboard_elete'])->name('general_meeting-board-delete');
  */
});
