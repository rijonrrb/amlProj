<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Country;
use App\Models\Dept;

class MainController extends Controller
{
    function index(){
        return view('Unit.countries');
    }
    function beverages(){
      return view('Unit.beverages');
    }
    function foods(){
      return view('Unit.foods');
    }
    function constructions(){
      return view('Unit.constructions');
    }
    function sugers(){
      return view('Unit.sugers');
    }
    function itcus(){
      return view('Unit.custudys');
    }
    function branOils(){
      return view('Unit.bran-oils');
    }
    function dairys(){
      return view('Unit.dairys');
    }
    function dredgings(){
      return view('Unit.dredgings');
    }
    function userlist(){
      return view('User.userlist');
    }
    function ipaddress(){
      return view('Ip.ipaddress');
    }

    public function dept(){
      $opts = Dept::all();

    }
    

}
