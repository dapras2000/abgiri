<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Content extends Model
{
    protected $table = 'contents';
    public $incrementing = false;

    public function categories(){
        return $this->belongsTo('App\Models\Category','category','id');
    }
}
