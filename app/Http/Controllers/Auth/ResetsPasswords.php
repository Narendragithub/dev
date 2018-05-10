<?php

namespace App\Http\Controllers\Auth;

use Illuminate\Http\Request;
use Illuminate\Mail\Message;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Password;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;

trait ResetsPasswords
{   

    protected $user = null;

    /**
     * Returns the type of user
     * 
     * @return string
     */
    protected function user() { 

        $this->checkUser();
        
        return $this->user;
    }

    /**
     * Checks User has been set or not. If not throw an exception
     * @return null
     */
    public function checkUser() {

        if (!$this->user) {
            throw new \InvalidArgumentException('First parameter should not be empty');
        }

        $app = app();

        if (!array_key_exists($this->user, $app->config['auth.multi'])) {
            throw new \InvalidArgumentException('Undefined property '.$this->user.' not found in auth.php multi array');
        }

    }

    /**
     * Display the form to request a password reset link.
     *
     * @return \Illuminate\Http\Response
     */
    public function getEmail()
    {
        return view($this->user().'.password');
    }

    /**
     * Send a reset link to the given user.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function postEmail(Request $request)
    {
        $this->validate($request, ['email' => 'required|email']);

        $app = app();
        
        $user = \App\User::where('email',$request->email)->first();
       
        if (is_null($user)) {
            return redirect('password/email')->with('error','User with entered email not found.');
        }
        $token  = str_random(30);
        // Once we have the reset token, we are ready to send the message out to this
        // user with a link to reset their password. We will then redirect back to
        // the current URI having nothing set in the session to indicate errors.
        
        $user->password_token=$token;
        $user->save();
        $verification_link  =   url('password/reset/'.encrypt($user->id.'/'.$token));
        //\Activity::log('Password reset requested.',$user->id);
        $template   = \App\Emailtemplates::find(6);//Welcome Email
        sendemail($user->email,$user->firstname,$user->lastname,$template,array('SUPPORT_URL'=>url('support/create'),'MEMBER_IP'=>$request->getClientIp(),'MEMBER_EMAIL'=>$user->email,'PASSWORD_LINK'=>$verification_link));
        return view('user/resetlink');
    }

    /**
     * Get the e-mail subject line to be used for the reset link email.
     *
     * @return string
     */
    protected function getEmailSubject()
    {
        return isset($this->subject) ? $this->subject : 'Your Password Reset Link';
    }

    /**
     * Display the password reset view for the given token.
     *
     * @param  string  $token
     * @return \Illuminate\Http\Response
     */
    public function getReset($token = null)
    {
        if (is_null($token)) {
            return redirect('password/email')->with('error','Invalid request token not found.');
        }

        return view($this->user().'.reset')->with('token', $token);
    }

    /**
     * Reset the given user's password.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function postReset(Request $request)
    {
        $this->validate($request, [
            'token'    => 'required',
            'email'    => 'required|email',
            'password' => 'required|confirmed|min:6',
        ]);
        $verifyuser = decrypt($request->token);
        $pos = strpos($verifyuser, '/');
        $id = substr($verifyuser, 0, $pos);
        $token = substr($verifyuser, $pos + 1);
        $credentials = $request->only(
            'email', 'password', 'password_confirmation', 'token'
        );
        
        $user = \App\User::where('email',$request->email)->where('password_token',$token)->first();
        if (is_null($user)) {
            return redirect('password/reset/'.$request->token)->with('error','Invalid email or password.');
        }else{
            $this->resetPassword($user, $request->password);
            \Activity::log('Password changed successfully.',$user->id);
            return redirect('home');
        }

       

        
    }

    /**
     * Reset the given user's password.
     *
     * @param  \Illuminate\Contracts\Auth\CanResetPassword  $user
     * @param  string  $password
     * @return void
     */
    protected function resetPassword($user, $password)
    {
        $user->password = bcrypt($password);

        $user->save();

        Auth::login($this->user(), $user);
    }

    /**
     * Get the post register / login redirect path.
     *
     * @return string
     */
    public function redirectPath()
    {
        if (property_exists($this, 'redirectPath')) {
            return $this->redirectPath;
        }

        return property_exists($this, 'redirectTo') ? $this->redirectTo : $this->user().'/home';
    }
}
