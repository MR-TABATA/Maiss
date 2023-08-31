<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Auth;
use App\Rules\UserPasswordRule;

class UserPasswordRequest extends FormRequest
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
      'current_pasword' => 'required',
      'password' => 'required|min:8|max:50|regex:/^(?=.*[0-9])(?=.*[a-z])[0-9a-zA-Z\-_@+$%&#?]{8,50}$/|confirmed',
      'password_confirmation' => 'required|min:8|max:50|regex:/^(?=.*[0-9])(?=.*[a-z])[0-9a-zA-Z\-_@+$%&#?]{8,50}$/',
    ];
  }
  public function attributes()
  {
    return [
      'current_pasword' => '現在のパスワード',
      'password' => 'パスワード',
      'password_confirmation' => '新しいパスワード確認',
    ];
  }
  public function messages()
  {
    return [
      'current_pasword.required' => ':attributeを入力してください',
      'password.required' => ':attributeを入力してください',
      'password.min' => ':attributeは8文字以上で入力ください',
      'password.max' => ':attributeは50文字以下で入力してください',
      'password.regex' => ':attributeは半角英数字が必要、記号は-@+$%&#?のみ使用可能です',
      'password.confirmed' => ':attributeとパスワード（確認）ガ一致しません',
      'password_confirmation.required' => ':attributeを入力してください',
      'password_confirmation.min' => ':attributeを8文字以上入力してください',
      'password_confirmation.max' => ':attributeは50文字以下で入力してください',
      'password_confirmation.regex' => ':attributeは半角英数字が必要、記号は-@+$%&#?のみ使用可能です',
    ];
  }
}
