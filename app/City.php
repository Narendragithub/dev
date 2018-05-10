<?php
namespace App;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class City extends Model {
	use SoftDeletes;
    protected $primaryKey = 'id';
    protected $table = 'cities';
    public $timestamps = false;
	
	public function states(){
		return $this->belongsTo('App\State','state_id');
	}
	
}