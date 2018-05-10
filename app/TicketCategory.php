<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class TicketCategory extends Model
{
 protected $table = 'ticket_categories';
  public function ticket(){
        return $this->hasMany('App\Tickets','department','id');
    }
}
