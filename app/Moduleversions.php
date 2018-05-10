<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Moduleversions extends Model
{
    
    public function productmodules(){
        return $this->belongsTo('App\Productmodules','module_id');
    }
    
}
