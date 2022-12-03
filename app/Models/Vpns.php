<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Vpns extends Model
{
    use HasFactory;
    protected $fillable = ['userid','name','password','ip','remark'];
    public function scopeSearch($query, $term){
        $term = "%$term%";
        $query->where(function($query) use ($term){
           $query->where('id','like',$term)
           ->orWhere('userid','like',$term)
           ->orWhere('name','like',$term)
           ->orWhere('password','like',$term)
           ->orWhere('ip','like',$term)
           ->orWhere('remark','like',$term);
        });
    }
    public $timestamps = false;
}
