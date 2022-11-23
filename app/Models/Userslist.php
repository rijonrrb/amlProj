<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Userslist extends Model
{
    use HasFactory;
    protected $fillable = ['userid','name','email','phone','desigation','dept','wstation','unit','asset_id','asset_no','ip_id','ip','vpn_id','vpn'];
    public function scopeSearch($query, $term){
        $term = "%$term%";
        $query->where(function($query) use ($term){
           $query->where('id','like',$term)
           ->orWhere('userid','like',$term)
           ->orWhere('name','like',$term)
           ->orWhere('email','like',$term)
           ->orWhere('phone','like',$term)
           ->orWhere('desigation','like',$term)
           ->orWhere('dept','like',$term)
           ->orWhere('wstation','like',$term)
           ->orWhere('unit','like',$term)
           ->orWhere('asset_id','like',$term)
           ->orWhere('asset_no','like',$term)
           ->orWhere('ip_id','like',$term)
           ->orWhere('ip','like',$term)
           ->orWhere('vpn_id','like',$term)
           ->orWhere('vpn','like',$term);
        });
    }
    public $timestamps = false;
}
