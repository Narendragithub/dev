<?php

namespace App\Http\Middleware;

use Closure;
use App\Admin;
class Checkg2fa
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        $user = Admin::find(\Auth::user('admin')->id);
        
        if($user->google2fa==1 || $user->emailotp==1){
            if (!\Session::has('admincustomauthorized') == true || \Session::get('admincustomauthorized') !== 1) {
                \Session::put('admincustomauthorized', 0);
                return \Redirect::to(adminurl('twofa'))->send();
            }
            
        }
        
        if($user->ip_restricted == 1 && !$user->checkIP(\Request::getClientIp())){
            $ip_link=adminurl('validate/ipaddress?token='.encrypt($user->id.'/'.\Request::getClientIp()));
            $template = \App\Emailtemplates::where('title', 'Admin IP Address Verification Mail')->first();
            sendemail($template,$user,array('ADMIN_IP'=>\Request::getClientIp(),'IP_ACTIVATION_LINK'=>$ip_link));
            return \Redirect::to(adminurl('iprestricted'))->send();
            
        }
        return $next($request);
    }
}
