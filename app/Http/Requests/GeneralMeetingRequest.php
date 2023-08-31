<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class GeneralMeetingRequest extends FormRequest
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
        'open_date' => 'required|date_format:Y-m-d h:i:s',
        'place' => 'required|max:100',
        'meeting_pdf' =>'mimes:pdf|max:255',
        'minutes_pdf' =>'mimes:pdf|max:255',
      ];
    }
    public function attributes()
    {
      return [
        'title' => '標題',
        'open_date' => '開催日時',
        'place' => '開催場所',
        'meeting_pdf' =>'総会資料',
        'minutes_pdf' =>'議事録',
      ];
    }
    public function messages()
    {
      return [
        'title.required' => ':attributeを入力してください',
        'title.max' => ':attributeは100文字以内で入力してください',
        'open_date.required' => ':attributeを入力してください',
        'open_date.date_format' => ':attributeを正しい日時形式（2023-01-01 13:10:00）で入力してください',
        'place.required' => ':attributeを入力してください',
        'place.max' => ':attributeは100文字以内で入力してください',
        'meeting_pdf.mimes' =>':attributeのファイル形式はPDFのみです',
        'meeting_pdf.max' =>':attributeのファイル名の文字数は100文字以内です',
        'minutes_pdf.mimes' =>':attributeのファイル形式はPDFのみです',
        'minutes_pdf.max' =>':attributeのファイル名の文字数は100文字以内です',
      ];
    }
  }
