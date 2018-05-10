<?php

namespace App;

use Illuminate\Auth\Authenticatable;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Auth\Passwords\CanResetPassword;
use Illuminate\Contracts\Auth\Authenticatable as AuthenticatableContract;
use Illuminate\Contracts\Auth\CanResetPassword as CanResetPasswordContract;

class Admin extends Model implements AuthenticatableContract, CanResetPasswordContract
{
    use Authenticatable, CanResetPassword;

    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'admins';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = ['name', 'email', 'password'];

    /**
     * The attributes excluded from the model's JSON form.
     *
     * @var array
     */
    protected $hidden = ['password', 'remember_token'];
   
    public function permissions(){
        return $this->hasMany('App\Modpermissions', 'admin_id', 'id');
        
    }
    public function check($currentpassword){
        $check = \DB::table('admins')->where('password', $currentpassword)->first();
        return $check;
    }
    public function checkIP($ip_address){
        return $this->hasOne('App\Userips','user_id')->where('ip_address',$ip_address)->where('is_admin',1)->first();
    }
    public function department() {
        return $this->belongsTo('App\Departments', 'department_id', 'id');
    }
}
