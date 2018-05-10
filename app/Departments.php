<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Departments extends Model
{
  public function getnextdepartment($id) {
        $department = \DB::table('departments')->where('id','>', $id)->first();
        return $department;
    }
}
