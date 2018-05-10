<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Attributes extends Model
{
  public function themes(){
        return $this->hasMany('App\Themes','attribute_id');
    }
   
    public function attributetheme($pid,$lid,$attribute_id) {
        $themes = \DB::table('pro_layoutthemes')->where('project_id', $pid)->where('layout_id', $lid)->where('attribute_id', $attribute_id)->get();
        return $themes;
    }
}
