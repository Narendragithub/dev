<?php namespace App\Handlers\Events;

use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldBeQueued;
use Illuminate\Http\Request;
use App\Admin;
use App\User;

class AuthLoginEventHandler {

    /**
     * Create the event handler.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }

    /**
     * Handle the event.
     *
     * @param  User $user
     * @param  $remember
     * @return void
     */
    public function handle($user, $remember)
    {
        if(\Auth::user('admin')){
        date_default_timezone_set('Asia/Kolkata');
        $user->last_login_ip = \Request::getClientIp();
        $user->last_login = date("Y-m-d H:i:s");
        $user->save();
        }
    }

}