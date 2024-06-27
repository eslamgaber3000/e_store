<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    use HasFactory;
    protected $fillable=[
        'name','desc','price','quantity','image','category_id'
    ];
    //more than product may belongs to one category
    public function category(){
        return $this->belongsTo(Category::class)->withDefault();
    }
}
