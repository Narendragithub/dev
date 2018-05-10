<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Userprofile extends Model
{
    
    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'userprofile';
    public function user(){
        return $this->belongsTo('App\User','id');
    }//
    public function usercountry(){
        return $this->hasOne('App\Country','id','country');
    }//
    public function userstate(){
        return $this->hasOne('App\State','id','state');
    }//
    public function usercity(){
        return $this->hasOne('App\City','id','city');
    }//
}
