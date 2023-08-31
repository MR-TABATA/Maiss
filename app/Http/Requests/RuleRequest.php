<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class RuleRequest extends FormRequest
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
      'chapter' => 'required|integer',
      'chapter_str' => 'required|max:50',
      'section' => 'required|integer',
      'section_str' =>'required|max:50',
      'paragraph' => 'required|integer',
      'paragraph_text' =>'required|max:1000',
    ];
  }
  public function attributes()
  {
    return [
      'chapter' => '章',
      'chapter_str' => '章文',
      'section' => '節',
      'section_str' => '節文',
      'paragraph' => '条',
      'paragraph_text' =>'条文',
    ];
  }
  public function messages()
  {
    return [
      'chapter.required' => ':attributeを入力してください',
      'chapter.integer' => ':attributeは数字のみ入力できます',
      'chapter_str.required' => ':attributeを入力してください',
      'chapter_str.max' => ':attributeは50文字以下で入力してください',
      'section.required' => ':attributeを入力してください',
      'section.integer' => ':attributeは数字のみ入力できます',
      'section_str.required' => ':attributeを入力してください',
      'section_str.max' => ':attributeは50文字以下で入力してください',
      'paragraph.required' => ':attributeを入力してください',
      'paragraph.integer' => ':attributeは数字のみ入力できます',
      'paragraph_text.required' => ':attributeを入力してください',
      'paragraph_text.max' => ':attributeは1000文字以下で入力してください',
    ];
  }
}
