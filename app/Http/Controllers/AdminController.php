<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Admin;
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
          return redirect()->back()->with('failed', 'Email already exist');
      }
      else{
        
          $Admin = new Admin();
          $Admin->name = $request->name;
          $Admin->email = $request->email;
          $Admin->password = md5($request->password);
          $Admin->admin_type = "Mod";
          
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