<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Auth;
use Illuminate\Support\Facades\Storage;

class UsersController extends Controller
{
    public function avatar(){
        return view('users.avatar');
    }
    public function changeAvatar(Request $request){
        $file=$request->file('files');
        $filename='avatars/'.md5(time().user()->id).'.'.$file->getClientOriginalExtension();
//        $filename=md5(time().user()->id).'.'.$file->getClientOriginalExtension();//存在本地
        //$file->move(public_path('avatars'),$filename);//存在本地
        Storage::disk('qiniu')->writeStream($filename,fopen($file->getRealPath(),'r'));
//        user()->avatar='avatars/'.$filename;//存在本地
        user()->avatar='https://avatar.ssmuch.com'.config ('filesystem.disks.qiniu.domain').'/'.$filename;
        user()->save();
        return ['url'=>user()->avatar];
    }
}
