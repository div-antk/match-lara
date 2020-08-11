<?php

namespace App\Services;

class CheckExtensionServices
{
  // public static functionと書くことで外部ファイルから呼び出せる
  public static function checkExtension($fileData, $extension){

    // 拡張子が大文字の場合もあるので下記のメソッドで小文字にする
    $extension = mb_strtolower($extension);

    // 拡張子ごとにbase64エンコード実施
    switch($extention) {
      case 'jpg':
      case 'jpeg':
          $data_url = 'data:image/jpg;base64,'. base64_encode($fileData);
          break;
      case 'png':
          $data_url = 'data:image/png;base64,'. base64_encode($fileData);
          break;
      case 'gif':
          $data_url = 'data:image/gif;base64,'. base64_encode($fileData);
          break;
    }

    return $data_url;
  }
}