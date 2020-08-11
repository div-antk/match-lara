<?php

namespace App\Services;

class FileUploadServices
{
  public static function fileUpload($imageFile){

    // $imageFile からファイル名（拡張子あり）を取得
    $filenameWithExt = $imageFile->getClientOriginalName();

    // 拡張子を除いたファイル名を取得
    $filename = pathinfo($filenameWithExt, PATHINFO_FILENAME);

    // 拡張子を取得
    $extension = $imageFile->getClientOriginalExtension();

    // ファイル名_時間_拡張子として設定
    $fileNameToStore = $filename.'_'.time().'.'.$extension;

    // 画像ファイル取得
    $fileData = file_get_contents($imageFile->getRealPath());

    $list = [
      $extension,
      $fileNameToStore,
      $fileData
    ];

    return $list;
  }
}