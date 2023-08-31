<?php

namespace App\Http\Controllers;

use App\Http\Requests\EnqueteAnswerRequest;
use App\Models\Enquete;
use App\Models\EnqueteAnswer;
use App\Models\EnqueteItem;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Redirect;

class EnqueteAnsweController extends Controller
{
  public function store(EnqueteAnswerRequest $request) {
    try {
      DB::beginTransaction();
      $EnqueteAnswer = new EnqueteAnswer();
      $EnqueteAnswer->enquete_item_id = $request->safe()->enquete_item_id;
      $EnqueteAnswer->comment = $request->comment;
      $EnqueteAnswer->enquete_id = $request->safe()->enquete_id;
      $EnqueteAnswer->user_id = Auth::id();
      $EnqueteAnswer->save();

      $EnqueteItem = new EnqueteItem();
      $enquete_item = $EnqueteItem::find($request->safe()->enquete_item_id);
      $enquete_item->total = +1;
      $enquete_item->save();
      DB::commit();
    } catch (Throwable $e) {
      DB::rollBack();
    }

    $Enquete = new Enquete();
    $enquete = Enquete::find($request->enquete_id);
    return redirect()->route('enquete-show', $enquete->id);
  }
}
