<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Layouts extends Model
{
    public function attributes(){
        return $this->hasMany('App\Layoutattributes', 'layout_id');
    }
     public function themes(){
        return $this->hasMany('App\Themes', 'theme_id');
    }
}
