<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Consts\CommonConsts;
use App\Consts\RuleConsts;
use App\Exports\RulesExport;
use App\Imports\RulesImport;
use App\Http\Requests\RuleRequest;
use App\Models\Rule;
use Maatwebsite\Excel\Facades\Excel;


class RuleController extends Controller
{
  public function index(Request $request, $type) {
    $Rule = new Rule();
    $rules = $Rule::where('type', $type)->get()->sortBy(['chapter', 'asc'], ['section', 'asc'], ['paragraph', 'asc']);
    $title = $this->__getType($type);

    return view('rule.index', compact('rules', 'title'));
  }

  public function index_board(Request $request, $type) {
    $Rule = new Rule();
    if( empty($request['type']) ) {
      $type = 'manage';
    }
    $rules = $Rule::where('type', $type)->get()->sortBy(['chapter', 'asc'], ['section', 'asc'], ['paragraph', 'asc']);
    $title = $this->__getType($type);

    return view('board_members.rule.index', compact('rules', 'title'));
  }
  /*
  public function register_board(Request $request) {

    if ($Rule) {
        $messageKey =  CommonConsts::FLASH_MESSAGE['SUCCESS_key'];
        $flashMessage =  $rule->title.'の'.CommonConsts::FLASH_MESSAGE['CREATE_SUCCESS'];
    } else {
        $messageKey =  CommonConsts::FLASH_MESSAGE['ERROR_key'];
        $flashMessage =  $rule->title.'の'.CommonConsts::FLASH_MESSAGE['CREATE_ERROR'];
    }
    return redirect()->route('rule-index-board')->with($messageKey, $flashMessage);
  }
  */

  public function show_edit_board(Request $request, $id, $type) {
    $rule = Rule::find($id);
    $title = $this->__getType($type);
    return view('board_members.rule.edit', compact('rule', 'title'));
  }

  public function edit_board(RuleRequest $request, $id) {
    $rule = Rule::find($id);
    $rule->chapter = $request->chapter;
    $rule->chapter_str = $request->chapter_str;
    $rule->section = $request->section;
    $rule->section_str = $request->section_str;
    $rule->paragraph = $request->paragraph;
    $rule->paragraph_text = $request->paragraph_text;

    $Rule = $rule->save();

    if ($Rule) {
      $messageKey =  CommonConsts::FLASH_MESSAGE['SUCCESS_key'];
      $flashMessage =  $rule->paragraph.'条の'.CommonConsts::FLASH_MESSAGE['EDIT_SUCCESS'];
    } else {
      $messageKey =  CommonConsts::FLASH_MESSAGE['ERROR_key'];
      $flashMessage =  $rule->paragraph.'条の'.CommonConsts::FLASH_MESSAGE['EDIT_ERROR'];
    }
    return redirect()->route('rule-index-board', $rule->type)->with($messageKey, $flashMessage);
  }

  public function import_export_board() {
    return view('board_members.rule.import_export');
  }

  public function export_board(){
    $timestamp = date_format(now(), 'YmdHis');
    return Excel::download(new RulesExport, 'rules_'.$timestamp.'.xlsx');
  }

  public function import_board(Request $request){
    $file = $request->file('file');
    DB::beginTransaction();
      $rule = Rule::all();
      $Rule_delete = $rule->each->delete();
      $Rule_import = Excel::import(new RulesImport, $file);

    if ($Rule_delete && $Rule_import) {
      $messageKey =  CommonConsts::FLASH_MESSAGE['SUCCESS_key'];
      $flashMessage =  CommonConsts::FLASH_MESSAGE['IMPORT_SUCCESS'];
      DB::commit();
    } else {
      $messageKey =  CommonConsts::FLASH_MESSAGE['ERROR_key'];
      $flashMessage =  CommonConsts::FLASH_MESSAGE['IMPORT_ERROR'];
      DB::rollBack();
    }
    return redirect()->route('rule-import-export-board')->with($messageKey, $flashMessage);
  }

  /*
  public function delete_board(Request $request, $id) {

    if ($Rule) {
      $messageKey =  CommonConsts::FLASH_MESSAGE['SUCCESS_key'];
      $flashMessage = $Rule->title.'の'.CommonConsts::FLASH_MESSAGE['DELETE_SUCCESS'];
    } else {
      $messageKey =  CommonConsts::FLASH_MESSAGE['ERROR_key'];
      $flashMessage = $Rule->title.'の'.CommonConsts::FLASH_MESSAGE['DELETE_ERROR'];
    }
    return redirect(route('rule-index-board'))->with($messageKey, $flashMessage);
  }
  */

  private function __getType($type) {
    $title = RuleConsts::TITLE_MANAGE_INDEX;
    switch($type) {
      case 'handbook':
        $title = RuleConsts::TITLE_HANDBOOK_INDEX;
        break;
      case 'car':
        $title = '駐車場 '. RuleConsts::TITLE_HANDBOOK_INDEX;
        break;
      case 'bike':
        $title = '駐輪場 '. RuleConsts::TITLE_HANDBOOK_INDEX;
        break;
      case 'delivery_box':
        $title = '宅配ボックス '. RuleConsts::TITLE_HANDBOOK_INDEX;
        break;
      case 'meeting_room':
        $title ='集会室 '.  RuleConsts::TITLE_HANDBOOK_INDEX;
        break;
    }
    return $title;
  }
}
