<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Subcategory extends Model
{
    protected $table = 'Subcategories';
    public $incrementing = false;

    public function categories(){
        return $this->belongsTo('App\Models\Category','category','id');
    }
}
