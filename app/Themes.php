<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Themes extends Model
{
  public function attribute()
    {
        return $this->hasOne('App\Attributes','id','attribute_id');
    }
     public function layouts()
    {
        return $this->belongsTo('App\Layouts','theme_id');
    }
   
}
