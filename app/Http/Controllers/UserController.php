<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests\ProfileRequest;
use App\User;

class UserController extends Controller
{
    public function show($id)
    {
        $user = User::findorFail($id);

        return view('users.show')->with('user', $user);
    }

    public function edit($id)
    {
        $user = User::findorFail($id);

        return view('users.edit')->with('user', $user);
    }

    public function update(ProfileRequest $request, $id)
    {
        $user = User::findorFail($id);

        if(!$request['img_name']){
            $image_file = $request['img_name'];

            // サービスクラスからの呼び出し
            $list = FileUploadServices::fileUpload($imageFile);
            list($extension, $fileNameToStore, $fileData) = $list;

            // サービスクラスからの呼び出し
            $data_url = CheckExtensionServices::checkExtension($fileData, $extension);
            $image = Image::make($data_url);
            $image->resize(400,400)->save(storage_path() . '/app/public/images/' . $fileNameToStore);

            $user->img_name = $fileNameToStore;
        }

        $user->name = $request->name;
        $user->email = $request->email;
        $user->gender = $request->gender;
        $user->self_introduction = $request->self_introduction;

        $user->save();

        return redirect('home');
    }
}
