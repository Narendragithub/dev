<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Tickets extends Model
{
   public function user(){
	   return $this->belongsTo('App\User','user_id');
   }
   public function responses(){
	   return $this->hasMany('App\Ticketresponses','ticket_id','ticket_id');
   }
   public function lastresponsetime($id){
       $lastresponse = \DB::table('ticketresponses')->orderBy('id','desc')->where('ticket_id',$id)->first();
        if($lastresponse){
       return $lastresponse->created_at;
	   }else{
		   return false;
	   }
   }
   public function department(){
        return $this->hasOne('App\TicketCategory','id','department');
    }
}
