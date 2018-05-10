<?php

namespace App\Http\Controllers\Auth;

use App\User;
use Validator;
use Socialize;
use Hash;
use App\Socialsettings;
use App\Http\Controllers\Controller;
/*use Illuminate\Foundation\Auth\AuthenticatesAndRegistersUsers;*/
use Sarav\Multiauth\Foundation\AuthenticatesAndRegistersUsers;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cookie;
class AuthController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Registration & Login Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles the registration of new users, as well as the
    | authentication of existing users. By default, this controller uses
    | a simple trait to add these behaviors. Why don't you explore it?
    |
    */

    use AuthenticatesAndRegistersUsers;

    protected $redirectAfterLogout = "/";

    /**
     * Create a new authentication controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->user = "user";
        $this->middleware('guest', ['except' => ['getLogout','resend']]);
        $fbsettings=  Socialsettings::where('provider','facebook')->first();
        if($fbsettings && $fbsettings->client_id && $fbsettings->client_secret && $fbsettings->redirect){
            \Session::put('showfb',true);
        }else{
            \Session::put('showfb',false);
        }
        $gplussettings=  Socialsettings::where('provider','google')->first();
        if($gplussettings && $gplussettings->client_id && $gplussettings->client_secret && $gplussettings->redirect){
            \Session::put('showgplus',true);
        }else{
            \Session::put('showgplus',false);
        }
    }

    /**
     * Get a validator for an incoming registration request.
     *
     * @param  array  $data
     * @return \Illuminate\Contracts\Validation\Validator
     */
    protected function validator(array $data)
    {
        return Validator::make($data, [
            'firstname' => 'required|max:255',
            'lastname' => 'required|max:255',
            'email' => 'required|email|max:255|unique:users',
            'password' => 'required|confirmed|min:6',
        ]);
    }

    /**
     * Create a new user instance after a valid registration.
     *
     * @param  array  $data
     * @return User
     */
    protected function create(array $data)
    {
        $settings = \App\Settings::findOrfail(1);
        $token  = str_random(30);
        $user = new \App\User;
        $user->title    =   $data['title'];
        $user->firstname    =   $data['firstname'];
        $user->lastname     =   $data['lastname'];
        $user->email        =   $data['email'];
        $user->password     =   Hash::make($data['password']);
        $user->token        =   $token;
         
        
        if(Cookie::get('referral')){
           $user->referal_id        =   Cookie::get('referral'); 
        }
       $user->save();
        $userprofile = new \App\Userprofile;
        $userprofile->user_id = $user->id;
        $userprofile->city        =   $data['city'];
        $userprofile->state        =   $data['state'];
        $userprofile->country        =   $data['country'];
        $userprofile->phone        =   $data['mobile'];
         $userprofile->save();
        
        $verification_link  =   url('register/verify?token='.encrypt($user->id.'/'.$token));
        //\Activity::log(encrypt($user->id.'/'.$token));
        $template   = \App\Emailtemplates::find(1);//Welcome Email
        sendemail($user->email,$user->firstname,$user->lastname,$template,array('ACTIVATION_LINK'=>$verification_link));
        
        
        $admintemplate = \App\Emailtemplates::find(4);
        sendemail($settings->admin_email,'Admin','',$admintemplate,array('MEMBER_EMAIL'=>$user->email));
        \Session::put('newuser',1);
        return $user;
        
        
        /*return User::create([
            'firstname' => $data['firstname'],
            'lastname' => $data['lastname'],
            'email' => $data['email'],
            'password' => bcrypt($data['password']),
        ]);*/
        //$template = \App\Emailtemplates::where('title', 'Mail to Admin On New Member Registration')->first();
        
    }
    /**
     * Redirect the user to the GitHub authentication page.
     *
     * @return Response
     */
    public function github_redirect()
    {
        return Socialize::driver('github')->redirect();
    }

    /**
     * Obtain the user information from GitHub.
     *
     * @return Response
     */
    public function github()
    {
        $user = Socialize::driver('github')->user();

        // $user->token;
    }
    public function google_redirect()
    {
        
        return Socialize::driver('google')->redirect();
    }

    /**
     * Obtain the user information from GitHub.
     *
     * @return Response
     */
    public function google()
    {
        $user = Socialize::driver('google')->user();
        $settings = \App\Settings::findOrfail(1);
        if($user){
            $dbuser= User::where('email',$user->email)->first();
            if($dbuser){
                if ($dbuser->googleid==$user->id){
                    \Auth::login($dbuser);
                    return \Redirect::to('/member');
                }else{
                    $dbuser->googleid = $user->id;
                    $dbuser->save();
                    \Auth::login($dbuser);
                    return \Redirect::to('/member');
                }
            }else{
                $newuser = new User();
                $newuser->firstname = $user->user['name']['givenName'];
                $newuser->lastname =$user->user['name']['familyName'];
                $newuser->email = $user->email;
                $newuser->googleid = $user->id;
                $newuser->verified = 1;
                $newuser->save();
                \Auth::login($newuser);
                //$template = \App\Emailtemplates::where('title', 'Mail to Member On Registration/Login With Google or Facebook')->first();
                $template = \App\Emailtemplates::find('3');
                sendemail($newuser->email,$newuser->firstname,$newuser->lastname,$template,array('LOGIN_TYPE'=>'Google +','LOGIN_URL'=>url('user/login')));
                //$template = \App\Emailtemplates::where('title', 'Mail to Admin On New Member Registration')->first();
                $admintemplate = \App\Emailtemplates::find('4');
                sendemail($settings->admin_email,'Admin','',$admintemplate,array('FIRST_NAME'=>$newuser->firstname,'LAST_NAME'=>$newuser->firstname,'MEMBER_EMAIL'=>$newuser->email));
                
                
                return \Redirect::to('/member')->with('message', 'Your account has been successfully created');
            }
        }
        
        // $user->token;
    }
    public function facebook_redirect()
    {
        return Socialize::driver('facebook')->redirect();
    }
    public function facebook(){
        $user = Socialize::driver('facebook')->user();
        $settings = \App\Settings::findOrfail(1);
        if($user){
            $dbuser= User::where('email',$user->email)->first();
            if($dbuser){
                if($dbuser->facebookid==$user->id){
                    \Auth::login($dbuser);
                    return \Redirect::to('/member');
                }else{
                    $dbuser->facebookid = $user->id;
                    $dbuser->save();
                    \Auth::login($dbuser);
                    return \Redirect::to('/member');
                }
            }else{
                $newuser = new User();
                $name=$user->user['name'];
                $name=  explode(' ', $name);
                $newuser->firstname = $name[0];
                $newuser->lastname = isset($name[1])?$name[1]:'';
                $newuser->email = $user->email;
                $newuser->facebookid = $user->id;
                $newuser->verified = 1;
                $newuser->save();
                \Auth::login($newuser);
                //$template = \App\Emailtemplates::where('title', 'Mail to Member On Registration/Login With Google or Facebook')->first();
                $template = \App\Emailtemplates::find('3');
                sendemail($newuser->email,$newuser->firstname,$newuser->lastname,$template,array('LOGIN_TYPE'=>'Facebook','LOGIN_URL'=>url('user/login')));
                //$template = \App\Emailtemplates::where('title', 'Mail to Admin On New Member Registration')->first();
                $admintemplate = \App\Emailtemplates::find('4');
                sendemail($settings->admin_email,'Admin','',$admintemplate,array('FIRST_NAME'=>$newuser->firstname,'LAST_NAME'=>$newuser->firstname,'MEMBER_EMAIL'=>$newuser->email));
                return \Redirect::to('/member')->with('message', 'Your account has been successfully created');
            }
        }
    }
    public function resend(Request $request){
        $user= \App\User::where('email',$request->email)->first();
        $token  = str_random(30);
        if($user->token){
            $token=$user->token;
        }else{
            $user->token=$token;
            $user->save();
        }
        if($user){
            $verification_link  =   url('register/verify?token='.encrypt($user->id.'/'.$token));
            //\Activity::log(encrypt($user->id.'/'.$user->token));
            $template   = \App\Emailtemplates::find(5);//Welcome Email
            sendemail($user->email,$user->firstname,$user->lastname,$template,array('ACTIVATION_LINK'=>$verification_link,'SUPPORT_URL'=>url('support/create')));
            return view('user/accountverified')->with('resend','yes');
        }else{
            return \Redirect::to('/resend/activation')->with('error','Invalid Email Address');
        }
    }
    
}
