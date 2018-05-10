<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Projectlayouts extends Model
{
  public function layout() {
        return $this->belongsTo('App\Layouts', 'layout_id', 'id');
    }
    public function projectlayoutthemes($pid,$lid) {
        $themes = \DB::table('pro_layoutthemes')->where('project_id', $pid)->where('layout_id', $lid)->get();
        return $themes;
    }
}
