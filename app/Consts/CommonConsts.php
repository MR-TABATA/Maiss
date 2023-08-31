<?php
namespace App\Consts;

class CommonConsts
{
  public const FLASH_MESSAGE = [
    'SUCCESS_key' => 'successMessage',
    'ERROR_key' => 'errorMessage',
    'CREATE_SUCCESS' => '登録に成功しました！',
    'CREATE_ERROR' => '登録に失敗しました',
    'EDIT_SUCCESS' => '更新に成功しました！',
    'EDIT_ERROR' => '更新に失敗しました',
    'DELETE_SUCCESS' => '削除に成功しました！',
    'DELETE_ERROR' => '削除に失敗しました',
    'IMPORT_SUCCESS' => 'インポートに成功しました！',
    'IMPORT_ERROR' => 'インポートに失敗しました',
  ];

  public const DATE_FORMAT = '「2023-01-01 18:00:00」形式でお願いします';
}
