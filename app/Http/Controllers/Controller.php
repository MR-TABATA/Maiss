<?php

namespace App\Http\Controllers;

use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Routing\Controller as BaseController;

class Controller extends BaseController
{
  use AuthorizesRequests, ValidatesRequests;

  public function rule_types() {
    $type = [
      'manage'=>'管理規約',
      'handbook'=>'使用細則',
      'car'=>'駐車場使用細則',
      'bike'=>'駐輪場使用細則',
      'delivery_box'=>'宅配ボックス使用細則',
      'meeting_room'=>'集会室使用細則',
    ];
    return $type;
  }
}
