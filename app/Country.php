<?php
namespace App;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Country extends Model {
	use SoftDeletes;
    protected $primaryKey = 'id';
    protected $table = 'countries';
    public $timestamps = false;
	
	public function states(){
		return $this->hasMany('App\State','country_id');
	}
	
        public function allcities(){
            $allcities = \  DB::table('countries')->where('countries.id','101')->join('states', 'states.country_id', '=', 'countries.id')->join('cities', 'cities.state_id', '=', 'states.id')->select('cities.*','states.name as statename', 'countries.name As countryname');
        return $allcities;
	}
        
}