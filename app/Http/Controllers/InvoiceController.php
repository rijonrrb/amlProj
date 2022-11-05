<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Invoice;
use Session;

class InvoiceController extends Controller
{
    public function invoice(){

        $value = Session::get('id');
        $value2 = Session::get('b_area');
        $invoice = Invoice::where('sid',$value)->where('business_area',$value2)->first();
        date_default_timezone_set('Asia/Dhaka');
        $time =  date('d F Y');
        return view('receipt')->with('invoice', $invoice)->with('time', $time);

    }
}

