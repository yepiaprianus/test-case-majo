<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    //
    protected $table = 'products';
    protected $primaryKey = 'id';
    protected $fillable = ['id','name', 'description', 'category_id', 'image', 'price'];

    public function category() {
        return $this->belongsTo('App\Models\Category');
    }
    public static $rules = array(       
        'name' => 'name|required|unique:products,id'
    );
}
