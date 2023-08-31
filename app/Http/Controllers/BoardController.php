<?php

namespace App\Http\Controllers;

use App\Consts\CommonConsts;
use App\Consts\BoardConsts;
use App\Models\Board;
use App\Models\User;
use App\Http\Requests\BoardRequest;
use Illuminate\Http\Request;

class BoardController extends Controller
{
  public function index(Board $board) {
    $boards = Board::with('user')->get()->sortBy(['start_date', 'asc']);
    return view('board.index', compact('boards'));
  }

  public function index_board(Board $board) {
    $boards = Board::with('user')->get()->sortBy(['start_date', 'asc']);
    return view('board_members.board.index', compact('boards'));
  }

  public function show_register_board() {
    $User = new User();
    $users = $User->getUserSelectLists();
    return view('board_members.board.register', compact('users'));
  }

  public function register_board(Request $request) {
    $regist = [
      'team'=>$request['team'],
      'start_date'=>$request['start_date'],
      'end_date'=>$request['end_date'],
      'user_id'=>$request['user_id'],
    ];
    $board = Board::query()->create($regist);

    if ($board) {
        $messageKey =  CommonConsts::FLASH_MESSAGE['SUCCESS_key'];
        $flashMessage =  '役員の'.CommonConsts::FLASH_MESSAGE['CREATE_SUCCESS'];
    } else {
        $messageKey =  CommonConsts::FLASH_MESSAGE['ERROR_key'];
        $flashMessage =  '役員の'.CommonConsts::FLASH_MESSAGE['CREATE_ERROR'];
    }
    return redirect()->route('board-index-board')->with($messageKey, $flashMessage);
  }


  public function show_edit_board(Request $request, $id) {
    $board = Board::find($id);
    $User = new User();
    $users = $User->getUserSelectLists();
    return view('board_members.board.edit', compact('board', 'users'));
  }

  public function edit_board(BoardRequest $request, $id) {
    $board = Board::find($id);
    $board->team = $request->team;
    $board->start_date = $request->start_date;
    $board->end_date = $request->end_date;
    $board->user_id = $request->user_id;

    $Board = $board->save();

    if ($Board) {
      $messageKey =  CommonConsts::FLASH_MESSAGE['SUCCESS_key'];
      $flashMessage =  CommonConsts::FLASH_MESSAGE['EDIT_SUCCESS'];
    } else {
      $messageKey =  CommonConsts::FLASH_MESSAGE['ERROR_key'];
      $flashMessage =  CommonConsts::FLASH_MESSAGE['EDIT_ERROR'];
    }
    return redirect()->route('board-index-board')->with($messageKey, $flashMessage);
  }

  public function delete_board(Request $request, $id) {
    $board = Board::find($id);
    $Board = $board->delete();
    if ($Board) {
      $messageKey =  CommonConsts::FLASH_MESSAGE['SUCCESS_key'];
      $flashMessage = $board->user->family_name.'さんの役員'.CommonConsts::FLASH_MESSAGE['DELETE_SUCCESS'];
    } else {
      $messageKey =  CommonConsts::FLASH_MESSAGE['ERROR_key'];
      $flashMessage = $board->user->family_name.'さんの役員'.CommonConsts::FLASH_MESSAGE['DELETE_ERROR'];
    }
    return redirect(route('board-index-board'))->with($messageKey, $flashMessage);
  }
}
