<?php
namespace App;

use Illuminate\Database\Eloquent\Model;
//use Illuminate\Database\Eloquent\SoftDeletes;
class Category extends Model
{
    ///use SoftDeletes; 
    public function parentcategory()
    {
        return $this->hasOne('App\Category','id','parent_id');
    }
    public function projects(){
        return $this->hasMany('App\Project','category_id','id');
    }
}
