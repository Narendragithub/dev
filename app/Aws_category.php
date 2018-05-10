<?php
namespace App;

use Illuminate\Database\Eloquent\Model;
//use Illuminate\Database\Eloquent\SoftDeletes;
class Aws_category extends Model
{
    ///use SoftDeletes; 
    public function parentcategory()
    {
        return $this->hasOne('App\Aws_category','id','parent_id');
    }
    
}
