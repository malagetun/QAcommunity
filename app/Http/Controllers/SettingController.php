<?php
namespace App\Http\Controllers;
use Illuminate\Http\Request;
class SettingController extends Controller
{
    public function index()
    {
        return view('users.setting');
    }
    public function store(Request $request)
    {
        //$setting=array_merge(user()->settings,array_only($request->all(),['city','bio']));
        //user()->update(['setting'=>$setting]);
        user()->settings()->merge($request->all());
        return back();
    }
}
