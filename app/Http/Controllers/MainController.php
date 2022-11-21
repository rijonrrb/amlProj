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
