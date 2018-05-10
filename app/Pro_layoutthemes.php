<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Pro_layoutthemes extends Model
{
  
   
    public function themes(){
        return $this->hasMany('App\Themes', 'theme_id');
    }
}
