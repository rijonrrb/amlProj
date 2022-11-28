<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Itcus extends Model
{
    use HasFactory;
    protected $fillable = [
       'item','laptop_name','asset_no','serial_no','previous_user','entry_date','p_issue_date', 'configuration', 'condition','warrenty_start','warrenty_end','vendor'
     ];

     public function scopeSearch($query, $term){
         $term = "%$term%";
         $query->where(function($query) use ($term){
            $query->where('item','like',$term)
            ->orWhere('laptop_name','like',$term)
            ->orWhere('asset_no','like',$term)
            ->orWhere('serial_no','like',$term)
            ->orWhere('previous_user','like',$term)
            ->orWhere('entry_date','like',$term)
            ->orWhere('p_issue_date','like',$term)
            ->orWhere('configuration','like',$term)
            ->orWhere('warrenty_start','like',$term)
            ->orWhere('warrenty_end','like',$term)
            ->orWhere('vendor','like',$term)
            ->orWhere('condition','like',$term);
         });
     }
}
