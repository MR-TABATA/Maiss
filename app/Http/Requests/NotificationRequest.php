<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class NotificationRequest extends FormRequest
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
      'title' => 'required|max:100',
      'content' => 'required|max:1000',
      'start_date' => 'nullable|date_format:Y-m-d H:i:s',
      'end_date' => 'nullable|after_or_equal:start_date|date_format:Y-m-d H:i:s',
    ];
  }
  public function attributes()
  {
    return [
      'title' => 'タイトル',
      'content' => '内容',
      'start_date' => '開始日時',
      'end_date' => '終了日時',
    ];
  }
  public function messages()
  {
    return [
      'title.required' => ':attributeを入力してください',
      'content.required' => ':attributeを入力してください',
      'user_id.required' =>':attributeを入力してください',
      'title.max' => ':attributeは100字以内で入力ください',
      'content.max' => ':attributeは1000字以内で入力ください',
      'start_date.date_format' => ':attributeを正しい日時形式（2023-01-01 09:00:00）で入力してください',
      'end_date.date_format' => ':attributeを正しい日時形式（2023-01-01 18:00:00）で入力してください',
      'end_date.after_or_equal' => ':attributeは開始日時より後の日時を入力してください',
    ];
  }
}
