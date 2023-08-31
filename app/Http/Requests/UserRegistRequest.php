<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Auth;
use App\Rules\UserPasswordRule;

class UserRegistRequest extends FormRequest
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
      'role' => 'required|integer',
      'room' => 'required|integer|max:10000',
      'family_name' => 'max:255',
      'given_name' => 'max:255',
      'account' => 'required|regex:/^(?=.*[0-9])(?=.*[a-z])[0-9a-zA-Z\-_]{4,50}$/',
      'email' => 'email',
      'password' => 'required|min:8|max:50|regex:/^(?=.*[0-9])(?=.*[a-z])[0-9a-zA-Z\-_@+$%&#?]{8,50}$/',
    ];
  }
  public function attributes()
  {
    return [
      'role' => '役割',
      'room' => '部屋番号',
      'family_name' => '名前（姓）',
      'given_name' => '名前（名）',
      'account' => 'アカウント',
      'email' => 'メール',
      'password' => 'パスワード',
    ];
  }
  public function messages()
  {
    return [
      'role.required' => ':attributeを入力してください',
      'role.integer' => ':attributeは数字のみ入力可能です',
      'room.required' => ':attributeを入力してください',
      'room.integer' => ':attributeは数字のみ入力可能です',
      'room.max' => ':attributeの桁の上限は10,000です',
      'family_name.max' => ':attributeは255文字以下で入力してください',
      'given_name.max' => ':attributeは255文字以下で入力してください',
      'account.required' => ':attributeを入力してください',
      'account.regex' => ':attributeは4文字以上、50文字以下、半角英数字、-_のみ使用可能',
      'email.email' => ':attributeは、正しいメールアドレス形式で入力してください',
      'password.required' => ':attributeを入力してください',
      'password.min' => ':attributeは8文字以上で入力ください',
      'password.max' => ':attributeは50文字以下で入力してください',
      'password.regex' => ':attributeは半角英数字が必要、記号は-@+$%&#?のみ使用可能です',
      'password.confirmed' => ':attributeとパスワード（確認）ガ一致しません',
    ];
  }
}
