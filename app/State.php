<?php
namespace App;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class State extends Model {
	use SoftDeletes;
    protected $primaryKey = 'id';
    protected $table = 'states';
    public $timestamps = false;
	
	public function countries(){
		return $this->belongsTo('App\Country','country_id');
	}
	public function cities(){
		return $this->hasMany('App\City','state_id');
	}
	
}