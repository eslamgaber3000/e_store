<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    use HasFactory;

    protected $fillable = [

        'name','desc'
    ];

    //relationship between category and product that one category has many product

    public function products(){

        return $this->hasMany(Product::class);
    }
}
