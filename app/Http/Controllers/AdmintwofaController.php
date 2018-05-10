<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Admin;
use App\Emailtemplates;
use Illuminate\Http\Request;

class AdmintwofaController extends Controller {

    public function __construct() {
        if(!\Auth::user('admin')){
            return \Redirect::to('/admin/login')->send();
        }
    }

    /**
     * Create a new authentication controller instance.
     *
     * @return void
     */
    public function index() {
        $user = Admin::find(\Auth::user('admin')->id);
        $view = '';

        if ($user->google2fa == 1) {
            $this->data['customauthtype'] = 'g2fa';
            $view = 'admin/google2fa';
            if ($user->google2fakey == null) {
                $key = \Google2FA::generateSecretKey();
                $user->google2fakey = $key;
                $user->save();
                $google2fa_url = \Google2FA::getQRCodeGoogleUrl(
                                'Support', $user->email, $user->google2fakey
                );
                $this->data['google2fa_url'] = $google2fa_url;
            } else {
                $key = $user->google2fakey;
            }
            $this->data['authkey'] = $key;
        } elseif ($user->emailotp == 1) {
            $this->data['customauthtype'] = 'emailotp';
            $view = 'admin/emailotp';
            $user->otp = rand(11111111, 99999999);
            $user->save();
            
            $template = Emailtemplates::where('title', 'Admin Login Email OTP')->first();
            sendemail($user->email,$user->name,'',$template,array('LOGIN_OTP' => $user->otp));
        }

        return view($view)->with($this->data);
    }

    public function check(Request $request) {
        $user = Admin::find(\Auth::user('admin')->id);

        if ($user->google2fa == 1) {
            $authkey = $request->authkey;

            $valid = \Google2FA::verifyKey($user->google2fakey, $authkey);
            //dd($valid);
            if ($valid) {
                \Session::put('admincustomauthorized', 1);
                return \Redirect::to(adminurl('home'));
            } else {
                return \Redirect::to(adminurl('twofa'))->with('message', 'Inavlid authorization key.');
            }
        }
        if ($user->emailotp == 1) {
            $otp = $request->otp;
            if ($user->otp == $otp) {
                //dd(\Session::get('customauthorized'));
                \Session::put('admincustomauthorized', 1);
                return \Redirect::to(adminurl('home'));
            } else {
                return \Redirect::to(adminurl('twofa'))->with('message', 'Inavlid OTP.');
            }
        }
    }

    public function iprestricted(Request $request) {
        return view('user/iprestricted')->with(array('ip_address' => $request->getClientIp()));
    }

    public function verifyip(Request $request) {
        $verifyuser = decrypt($request->token);
        $pos = strpos($verifyuser, '/');
        $id = substr($verifyuser, 0, $pos);
        $ip = substr($verifyuser, $pos + 1);
        if (\Auth::user('admin')->id == $id) {
            $userip = new \App\Userips();
            $userip->user_id = $id;
            $userip->ip_address = $ip;
            $userip->is_admin = 1;
            $userip->save();
        }
        return redirect(adminurl('home'))->with('message', 'Ip address verified successfully');
    }


}
