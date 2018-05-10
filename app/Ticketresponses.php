<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Ticketresponses extends Model
{
   public function ticket(){
	   return $this->belongsTo('App\Tickets','ticket_id');
   }
   
}
