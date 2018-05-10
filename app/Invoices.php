<?php
namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
class Invoices extends Model
{
    public function order(){
		return $this->belongsTo('App\Order','order_id');
	}
}
