<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class EnqueteAnswerRequest extends FormRequest
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
      'enquete_id' => 'required',
      'enquete_item_id' => 'required',
      'comment' =>'max:1000',
    ];
  }
  public function attributes()
  {
    return [
      'enquete_id' => 'アンケート',
      'enquete_item_id' => '回答選択肢',
      'comment' => '意見・コメント',
    ];
  }
  public function messages()
  {
    return [
      'enquete_id.required' => ':attributeを入力してください。',
      'enquete_item_id.required' => ':attributeを入力してください。',
      'comment.max' => ':attributeは1000文字以下で入力してください。',
    ];
  }
}
