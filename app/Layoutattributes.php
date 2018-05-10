<?php
namespace App;

use Illuminate\Database\Eloquent\Model;

class Layoutattributes extends Model
{
    public function attributes(){
        return $this->belongsTo('App\Attributes','attribute_id');
    }
    
}
