<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class BoardRequest extends FormRequest
{
  /**
   * Determine if the user is authorized to make this request.
   */
  public function authorize(): bool
  {
    return true;
  }

  /**
   * Get the validation rules that apply to the request.
   *
   * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array|string>
   */
  public function rules(): array
  {
    return [
      'team' => 'required|integer',
      'start_date' => 'required|date_format:Y-m-d',
      'end_date' => 'required|date_format:Y-m-d',
      'user_id' =>'required|integer',
    ];
  }
  public function attributes()
  {
    return [
      'team' => '組',
      'start_date' => '開始日',
      'end_date' => '終了日',
      'user_id' =>'ユーザーID',
    ];
  }
  public function messages()
  {
    return [
      'team.required' => ':attributeを入力してください',
      'start_date.required' => ':attributeを入力してください',
      'end_date.required' => ':attributeを入力してください',
      'user_id.required' =>':attributeを入力してください',
      'team.integer' => ':attributeは数字のみ入力できます',
      'start_date.date_format' => ':attributeを正しい日時形式（2023-01-01）で入力してください',
      'end_date.date_format' => ':attributeを正しい日時形式（2023-01-01）で入力してください',
      'user_id.integer' =>':attributeは数字のみ入力できます',
    ];
  }
}
