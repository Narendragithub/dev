<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

//use Illuminate\Database\Eloquent\SoftDeletes;

class Project extends Model {

    //use SoftDeletes;

    public function category() {
        return $this->belongsTo('App\Category', 'category_id', 'id');
    }

    public function projectimages() {
        return $this->hasMany('App\Projectimage', 'project_id');
    }

    public function projectassets() {
        return $this->hasMany('App\Assetsbundle', 'project_id')->orderBy('id','DESC');
    }

    public function projectlayouts() {
        return $this->hasMany('App\Projectlayouts', 'project_id');
    }

    public function renderimages() {
        return $this->hasMany('App\Renderimages', 'project_id');
    }

    public function projectratings() {
        return $this->hasMany('App\Projectratings', 'project_id');
    }

    public function projectxmldetail() {
        return $this->hasOne('App\Projectxmldetail', 'project_id', 'id');
    }

    public function featuredimages() {
        return $this->hasMany('App\Projectimage', 'project_id')->where('img_category_id', 1)->get();
    }

    public function thumbnails() {
        return $this->hasMany('App\Projectimage', 'project_id')->where('img_category_id', 2)->get();
    }
	
	
    public function department() {
        return $this->belongsTo('App\Departments', 'status', 'id');
    }

    public function projectfiles() {
        return $this->hasMany('App\Projectfiles', 'project_id');
    }

}
