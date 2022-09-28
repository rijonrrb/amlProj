<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Invoice;
use Session;

class InvoiceController extends Controller
{
    public function invoice(){

        $value = Session::get('id');
        $invoice = Invoice::where('t_id',$value)->first();
        date_default_timezone_set('Asia/Dhaka');
        $time =  date('d F Y');
        return view('receipt')->with('invoice', $invoice)->with('time', $time);

    }
}
