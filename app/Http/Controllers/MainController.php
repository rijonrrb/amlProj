<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Country;

class MainController extends Controller
{
    function index(){
        return view('countries');
    }
    public function updatez(Request $request){

        $user = Country::where('id',$request->id)->first();
        $p_user = Country::where('id',$request->id)->first();
        date_default_timezone_set('Asia/Dhaka');
        $time =  date('d F Y h:i:s A');

        if( $request->column_name == "user_name")
        {
           
           $user->user_name = $request->value;
           if (empty($p_user->previous_user))
           {
               $user->previous_user = $p_user->user_name;
           }
           else
           {
               $user->previous_user = $p_user->previous_user."  ||  ".$p_user->user_name;
           }
          

           $user->issue_date = $time;
           if (empty($p_user->p_issue_date))
           {
               $user->p_issue_date = $p_user->issue_date;
           }
           else
           {
               $user->p_issue_date = $p_user->p_issue_date."  ||  ".$p_user->issue_date;
           }

           $user->save();
   
        }
        elseif ( $request->column_name == "desigation")
        {
           if(empty($request->value))
           {
              $user->desigation = '';
              $user->save();
           }
           else
           {
              $user->desigation = $request->value;
              $user->save();
           } 
     
        }
        elseif ( $request->column_name == "dept")
        {
           if(empty($request->value))
           {
              $user->dept = '';
              $user->save();
           }
           else
           {
              $user->dept = $request->value;
              $user->save();
           } 
  
        }
        elseif ( $request->column_name == "unit")
        {
           if(empty($request->value))
           {
              $user->unit = '';
              $user->save();
           }
           else
           {
              $user->unit = $request->value;
              $user->save();
           } 
  
        }
        elseif ( $request->column_name == "item")
        {
           if(empty($request->value))
           {
              $user->item = '';
              $user->save();
           }
           else
           {
              $user->item = $request->value;
              $user->save();
           } 
  
        }
        elseif ( $request->column_name == "laptop_name")
        {
           if(empty($request->value))
           {
              $user->laptop_name = '';
              $user->save();
           }
           else
           {
              $user->laptop_name = $request->value;
              $user->save();
           } 

        }
        elseif ( $request->column_name == "asset_no")
        {
           if(empty($request->value))
           {
              $user->asset_no = '';
              $user->save();
           }
           else
           {
              $user->asset_no = $request->value;
              $user->save();
           }   

        }
        elseif ( $request->column_name == "serial_no")
        {
           if(empty($request->value))
           {
              $user->serial_no = '';
              $user->save();
           }
           else
           {
              $user->serial_no = $request->value;
              $user->save();
           }          

        }
        elseif ( $request->column_name == "previous_user")
        {
           
           if(empty($request->value))
           {
              $user->previous_user = '';
              $user->save();
           }
           else
           {
              $user->previous_user = $request->value;
              $user->save();
           }          

        }
        elseif ( $request->column_name == "issue_date")
        {
           
           if(empty($request->value))
           {
              $user->issue_date = '';
              $user->save();
           }
           else
           {
              $user->issue_date = $request->value;
              $user->save();
           }
           
  
        }
        elseif ( $request->column_name == "p_issue_date")
        {
           if(empty($request->value))
           {
              $user->p_issue_date = '';
              $user->save();
           }
           else
           {
              $user->p_issue_date = $request->value;
              $user->save();
           }

  
        }
        elseif  ( $request->column_name == "configuration")
        {

           if(empty($request->value))
           {
              $user->configuration = '';
              $user->save();
           }
           else
           {
              $user->configuration = $request->value;
              $user->save();
           }
 
        }

    }
}
