<?php
namespace App\Consts;

class UserConsts
{
  public const TITLE_INDEX = '組合員一覧';
  public const TITLE_REGIST = '組合員新規登録';
  public const TITLE_EDIT = '組合員更新';
  public const TITLE_EDIT_PASSWORD = 'パスワード更新';
  public const TITLE_DELETE = '組合員登録解除';

  public const PASSWORD_ALLOW = '使える文字の種類：半角英数字、-_@+$%&#?、8文字以上・50文字以下';
  public const ACCOUNT_ALLOW = '使える文字の種類：半角英数字、-_、8文字以上・50文字以下';

  public const ROLE_LIST = [
    '1' => '組合員',
    '2' => '大規模修繕委員',
    '10' => '理事',
    '11'=> '理事長',
    '20'=> '管理会社',
    '50'=> 'システム管理',
  ];
}
