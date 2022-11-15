<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Admin;
use Illuminate\Support\Str;
use Session;
use DateTime;


class AdminController extends Controller
{
    public function AdminLogSubmit(Request $request){

        $loginCheck = Admin::where('email',$request->email)->where('password',md5($request->password))->first();

        if($loginCheck){
            $request->session()->put('id',$loginCheck->id);
            $request->session()->put('name',$loginCheck->name);
            $request->session()->put('email',$loginCheck->email);
            $request->session()->put('password',$loginCheck->password);
            $request->session()->put('admin_type',$loginCheck->admin_type);
            return  redirect()->route('home');
        }
        else{
            return redirect()->back()->with('failed', 'Invalid Email or password');
        }

    }
    
    public function logout(){
        session()->forget('id');
        session()->forget('name');
        session()->forget('email');
        session()->forget('password');
        session()->forget('admin_type');
        return redirect()->route('AdminLogin');
    }
    
}