<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Ip extends Model
{
    use HasFactory;
    protected $fillable = ['ip','name','userid','desigation','dept','wstation','unit','physical_address','issue_date'];
    public function scopeSearch($query, $term){
        $term = "%$term%";
        $query->where(function($query) use ($term){
           $query->where('ip','like',$term)
           ->orWhere('name','like',$term)
           ->orWhere('desigation','like',$term)
           ->orWhere('dept','like',$term)
           ->orWhere('wstation','like',$term)
           ->orWhere('unit','like',$term)
           ->orWhere('physical_address','like',$term)
           ->orWhere('issue_date','like',$term);
        });
    }
    public $timestamps = false;
}
