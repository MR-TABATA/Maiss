<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class EnqueteRequest extends FormRequest
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
      'title' => 'required',
      'start_at' => 'required|date_format:Y-m-d H:i:s',
      'expired_at' => 'required|date_format:Y-m-d H:i:s',
      'detail' =>'required|max:1000',
    ];
  }
  public function attributes()
  {
    return [
      'title' => 'アンケートタイトル',
      'start_at' => '回答開始日',
      'expired_at' => '回答期限日',
      'detail' => '具体的な内容',
    ];
  }
  public function messages()
  {
    return [
      'title.required' => ':attributeを入力してください。',
      'start_at.required' => ':attributeを入力してください。',
      'start_at.date_format' => ':attributeを正しい日時形式（2023-01-01 23:00:00）で入力してください。',
      'expired_at.required' => ':attributeを入力してください。',
      'expired_at.date_format' => ':attributeを正しい日時形式（2023-01-01 23:00:00）で入力してください。',
      'detail.required' => ':attributeを入力してください。',
      'detail.max' => ':attributeは1000文字以下で入力してください。',
    ];
  }
}
