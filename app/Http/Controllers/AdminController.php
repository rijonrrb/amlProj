<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Admin;
use App\Models\Log;
use Illuminate\Support\Str;
use Session;
use DateTime;


class AdminController extends Controller
{

    public function AdminCreateSubmit(Request $request){
        $validate = $request->validate([
          "name"=>"required",
          "email"=>"required",
          'password'=>"required"
          
      ],
      ['name.required'=>"The Name field is required.",
      'email.required'=>"The Email field is required.",
      'password.required'=>"The Password field is required."]
  );
        $userCheck = Admin::where('email',$request->email)->first();
        if($userCheck){
          return redirect()->back()->with('failed', 'This mail is already taken');
      }
      else{
        
          $Admin = new Admin();
          $Admin->name = $request->name;
          $Admin->email = $request->email;
          $Admin->password = md5($request->password);
          $Admin->admin_type = "Mod";
          $Admin->create = $request->create;
          $Admin->update = $request->update;
          $Admin->delete = $request->delete;
          $Admin->issue = $request->issue;
          $Admin->return = $request->return;
          
          $result = $Admin->save();
          if($result){
            return redirect()->back()->with('success', 'Admin Successfully Created');
        }
        else{
          return redirect()->back()->with('failed', 'Admin Creation Failed');
      }
  }
}

public function AdminLogSubmit(Request $request){
    date_default_timezone_set('Asia/Dhaka');
    $time =  date('d F Y h:i:s A');
    $loginCheck = Admin::where('email',$request->email)->where('password',md5($request->password))->first();
    $ip = file_get_contents('https://api.ipify.org/?format=text');
    if($loginCheck){

        if($loginCheck->admin_type == "Mod"){
            $result = Log::insert([
                'name'=>$loginCheck->name,
                'email'=>$loginCheck->email,
                'activity'=>"Logged-In",
                'time'=>$time,
                'ip'=> $ip,
            ]);
            if($result){
                $request->session()->put('id',$loginCheck->id);
                $request->session()->put('name',$loginCheck->name);
                $request->session()->put('email',$loginCheck->email);
                $request->session()->put('password',$loginCheck->password);
                $request->session()->put('admin_type',$loginCheck->admin_type);
                $request->session()->put('create',$loginCheck->create);
                $request->session()->put('update',$loginCheck->update);
                $request->session()->put('delete',$loginCheck->delete);
                $request->session()->put('issue',$loginCheck->issue);
                $request->session()->put('return',$loginCheck->return);
                return  redirect()->route('home');
            }
        }
        else {
            $request->session()->put('id',$loginCheck->id);
            $request->session()->put('name',$loginCheck->name);
            $request->session()->put('email',$loginCheck->email);
            $request->session()->put('password',$loginCheck->password);
            $request->session()->put('admin_type',$loginCheck->admin_type);
            $request->session()->put('create',$loginCheck->create);
            $request->session()->put('update',$loginCheck->update);
            $request->session()->put('delete',$loginCheck->delete);
            $request->session()->put('issue',$loginCheck->issue);
            $request->session()->put('return',$loginCheck->return);
            return  redirect()->route('home');
        }

    }
    else{
        return redirect()->back()->with('failed', 'Invalid Email or password');
    }

}

public function logout(){
    date_default_timezone_set('Asia/Dhaka');
    $time =  date('d F Y h:i:s A');
    $ip = file_get_contents('https://api.ipify.org/?format=text');
    if(Session::get('admin_type') == "Mod"){
        $result = Log::insert([
            'name'=>Session::get('name'),
            'email'=>Session::get('email'),
            'activity'=>"Logged-Out",
            'time'=>$time,
            'ip'=> $ip,
        ]);

        if($result){
            session()->forget('id');
            session()->forget('name');
            session()->forget('email');
            session()->forget('password');
            session()->forget('admin_type');
            return redirect()->route('AdminLogin');
        }
    }
    else{
        session()->forget('id');
        session()->forget('name');
        session()->forget('email');
        session()->forget('password');
        session()->forget('admin_type');
        return redirect()->route('AdminLogin');
    }

}

public function AdminCpass(Request $request){

    $validate = $request->validate([
        "password"=>'required',
        'npassword'=>'required',
        'cnpassword'=>'required'
    ],
    ['password.required'=>"The Password Required.",
    'npassword.required'=>"The New password Required.",
    'cnpassword.required'=>"The Repeated New Password Required."
]
);

    $pass=$request->npassword;
    $rpass=$request->cnpassword;

    if ($rpass == $pass)
    {

        $user = Admin::where('email',$request->session()->get('email'))->where('password',md5($request->password))->first();

        if($user){

            $user->password = md5($request->npassword);
            session()->put('password',md5($request->npassword));
            $result = $user->save();
            if($result){
                return redirect()->back()->with('success', 'Password Successfully Updated');
            }
            else{
                return redirect()->back()->with('failed', 'Failure in Password Updating');
            }

        }
        else{
            return redirect()->back()->with('failed', 'Old Password does not match');
        }
    }
    else{
        return redirect()->back()->with('failed', 'Repeated Password does not match with New Password');
    }
}


}