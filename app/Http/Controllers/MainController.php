<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Country;
use App\Models\Dept;

class MainController extends Controller
{
    function index(){
        return view('countries');
    }
    function beverages(){
      return view('beverages');
   }
   function constructions(){
      return view('constructions');
    }
    function sugers(){
      return view('sugers');
    }
    function itcus(){
      return view('custudys');
    }
    function cusIgloo(){
      return view('cus-igloos');
    }
    function cusCon(){
      return view('cuscons');
    }
    function cusBev(){
      return view('cus-bev');
    }

    function hmp(){
      return view('hmps');
    }


    public function dept(){
      $opts = Dept::all();

    }

}
