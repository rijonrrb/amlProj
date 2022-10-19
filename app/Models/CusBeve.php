<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CusBeve extends Model
{
    use HasFactory;
    protected $fillable = [
        'user_name','desigation','dept','unit','item','laptop_name','asset_no','serial_no','previous_user','issue_date', 'p_issue_date', 'configuration'
     ];

     public function scopeSearch($query, $term){
         $term = "%$term%";
         $query->where(function($query) use ($term){
            $query->where('user_name','like',$term)
            ->orWhere('desigation','like',$term)
            ->orWhere('dept','like',$term)
            ->orWhere('unit','like',$term)
            ->orWhere('item','like',$term)
            ->orWhere('laptop_name','like',$term)
            ->orWhere('asset_no','like',$term)
            ->orWhere('serial_no','like',$term)
            ->orWhere('previous_user','like',$term)
            ->orWhere('issue_date','like',$term)
            ->orWhere('p_issue_date','like',$term)
            ->orWhere('configuration','like',$term);
         });
     }
}
