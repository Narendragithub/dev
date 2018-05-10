<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\User;
use App\Country;
use App\Departments;
use App\State;
use App\City;
use App\Emailtemplates;
use App\Userprofile;
use App\Tickets;
use App\Ticketresponses;
use App\Testimonial;
use App\TicketCategory;
use Illuminate\Http\Request;
use Illuminate\Routing\Route;
use Hash;

class UserController extends Controller {

    private $paypal_conf = null;

    /**
     * Create a new authentication controller instance.
     *
     * @return void
     */
    var $breadcrumb = '';

    public function __construct(Route $route) 
    {
        list($road, $action) = explode('@', $route->getActionName());
        //$this->paypal_conf = Paymentmethods::where('name', 'paypal')->first();
        if(!\Auth::user('user') && $action != 'getRegister') 
        {
            return \Redirect::to('/user/login')->send();
        }

        if($action != 'getRegister') 
        {

            if(\Auth::user('user')->verified === 0) 
            {
                return redirect(url("home"));// Comment for unverified user login problem in local host
                //return \Redirect::to('account/verification')->send();
            }

            $this->breadcrumb[] = '<a href="' . url('member') . '">Member Area</a>';
            if(\Auth::user()->google2fa == 1 || \Auth::user()->emailotp == 1) 
            {
                if(!\Session::has('customauthorized') == true || \Session::get('customauthorized') !== 1) 
                {
                    \Session::put('customauthorized', 0);
                    return \Redirect::to('/customauth')->send();
                }
            }

            if(\Auth::user()->ip_restricted == 1 && !\Auth::user()->checkIP(\Request::getClientIp())) 
            {
                $ip_link = url('validate/ipaddress?token=' . encrypt(\Auth::user()->id . '/' . \Request::getClientIp()));
                //$template = Emailtemplates::where('title', 'Member IP Address Verification Mail')->first();
                $template = Emailtemplates::where('id', '9')->first();
                sendemail(\Auth::user()->email, \Auth::user()->firstname, \Auth::user()->lastname, $template, array('MEMBER_IP' => \Request::getClientIp(), 'IP_ACTIVATION_LINK' => $ip_link));
                return \Redirect::to('/iprestricted')->send();
            }
        }
    }

    
    public function getHome() 
    {
        $servicecount = 0;
        $this->data['active'] = 'overview';
        $this->breadcrumb[] = '<a href="javascript:void(0);">Overview</a>';
        $this->data['breadcrumb'] = $this->breadcrumb;
        $member = User::find(\Auth::user()->id);
        $projects = $member->projects()->orderBy('id', 'desc')->get();
        $tickets = $member->tickets;
        $opentickets = $member->tickets()->where('status', 0)->get();
        //dd($opentickets);
        return view('user/dashboard', compact('member', 'tickets', 'opentickets', 'projects'))->with($this->data);
        /*echo "Logged In<br/>";
        echo "<a href='" . action('Auth\AuthController@getLogout') . "'>Logout</a>";
        dd(\Auth::user('user')); */
    }

    public function profile() 
    {
        $this->data['active'] = 'profile';
        $this->breadcrumb[] = '<a href="javascript:void(0);">Profile</a>';
        $this->data['breadcrumb'] = $this->breadcrumb;
        $member = User::find(\Auth::user()->id);
        $processor_emails = $member->processors;
        $countries = Country::all();
        $profile = $member->profile;
        $country = Country::find($profile->country);
        $states = $country->states;
        $stat = State::find($profile->state);
        $cities = $stat->cities;
        //dd($member);
        return view('user/profile', compact('member', 'countries', 'states', 'cities', 'profile', 'processor_emails'))->with($this->data);
    }

    public function updateauth(Request $request) 
    {

        $this->data['active'] = 'profile';
        $member = User::find(\Auth::user()->id);
        $update = false;
        if ($request->google2fa) {
            $member->google2fa = $request->google2fa;
            $update = true;
        } else {
            if ($member->google2fa == 1) {
                $member->google2fa = 0;
                $member->google2fakey = null;
                $update = true;
            }
        }

        if ($request->emailotp) {
            $member->emailotp = $request->emailotp;
            \Session::put('customauthorized', 1);
            $update = true;
        } else {
            if ($member->emailotp == 1) {
                $member->emailotp = 0;
                $update = true;
            }
        }

        if($update) 
        {
            $member->save();
            \Activity::log('Authentication Info Updated');
            return \Redirect::to('/profile')->with('message', 'Authentication updated successfully.');
        
        } else {
            
            return \Redirect::to('/profile');
        }
    }

    // add domain after order is placed //
    public function support() {
        $this->breadcrumb[] = '<a href="javascript:void(0);">Support</a>';
        $this->data['breadcrumb'] = $this->breadcrumb;
        $member = User::find(\Auth::user()->id);
        $tickets = $member->tickets;
        $this->data['active'] = 'support';
        return view('user/support', compact('tickets'))->with($this->data);
    }

    public function viewticket($ticket_id) {
        $member = User::find(\Auth::user()->id);
        $ticketdetails = Tickets::where('ticket_id', $ticket_id)->where('user_id', $member->id)->first();
        $ticketresponses = $ticketdetails->responses;
        $this->data['active'] = 'support';
        return view('user/viewticket', compact('ticketdetails', 'ticketresponses'))->with($this->data);
    }

    public function openticket($id) {
        $settings = \App\Settings::find(1);
        $member = User::find(\Auth::user()->id);
        $ticket = Tickets::findOrFail($id);
        $ticket->status = 0;
        $ticket->save();
        \Activity::log('Ticket #' . $ticket->ticket_id . ' reopened.');
        //Member Notification When Support Ticket Is Re-opened 
        $template = \App\Emailtemplates::find(20);
        sendemail($member->email, $member->firstname, $member->lastname, $template, array('SUPPORT_TICKET_ID' => $ticket->ticket_id, 'SUPPORT_TICKET_SUBJECT' => $ticket->subject));
        //Admin Notification When Support Ticket Is Re-opened
        $admintemplate = \App\Emailtemplates::find(21);
        sendemail($settings->admin_email, 'Admin', '', $admintemplate, array('SUPPORT_TICKET_ID' => $ticket->ticket_id, 'SUPPORT_TICKET_SUBJECT' => $ticket->subject));
        return redirect('/support')->with('message', 'Ticket has been reopened now');
    }

    public function closeticket($id) {
        $settings = \App\Settings::find(1);
        //dd($settings);
        $member = User::find(\Auth::user()->id);
        $ticket = Tickets::findOrFail($id);
        $ticket->status = 4;
        $ticket->save();
        \Activity::log('Ticket #' . $ticket->ticket_id . ' closed.');
        //Member Notification When Support Ticket Is Closed
        $template = \App\Emailtemplates::find(18);
        sendemail($member->email, $member->firstname, $member->lastname, $template, array('SUPPORT_TICKET_ID' => $ticket->ticket_id, 'SUPPORT_TICKET_SUBJECT' => $ticket->subject));
        //Admin Notification When Support Ticket Is Closed
        $admintemplate = \App\Emailtemplates::find(19);
        sendemail($settings->admin_email, 'Admin', '', $admintemplate, array('SUPPORT_TICKET_ID' => $ticket->ticket_id, 'SUPPORT_TICKET_SUBJECT' => $ticket->subject));
        return redirect('/support')->with('message', 'Ticket has been closed successfully');
    }

    public function createsupport() {
        $this->breadcrumb[] = '<a href="' . url('support') . '">Support</a>';
        $this->breadcrumb[] = '<a href="javascript:void(0);">Create Support Ticket</a>';
        $this->data['breadcrumb'] = $this->breadcrumb;
        $member = User::find(\Auth::user()->id);
        $projects = $member->projects;
        $departments = TicketCategory::all();
       

        $this->data['active'] = 'support';
        return view('user/createsupport', compact( 'departments', 'projects'))->with($this->data);
    }

   

    public function update(Request $request) {
        //$this->data['active']='profile';
        $dirtymember = array();
        $dirtyprofile = array();
        $member = User::find(\Auth::user()->id);
        $member->title = $request->title;
        $member->firstname = $request->firstname;
        $member->lastname = $request->lastname;
        $member->save();
        if ($member->profile) {

            $profile = $member->profile;
            $profile->address = $request->address;
            $profile->city = $request->city;
            $profile->state = $request->state;
            $profile->zip = $request->zip;
            $profile->country = $request->country;
            $profile->phone = $request->phone;
            $profile->save();
        } else {
            $profile = new Userprofile();
            $profile->user_id = $member->id;
            $profile->address = $request->address;
            $profile->city = $request->city;
            $profile->state = $request->state;
            $profile->zip = $request->zip;
            $profile->country = $request->country;
            $profile->phone = $request->phone;
            $profile->update();
        }

        return \Redirect::to('/profile')->with('message', 'Profile updated successfully.');
    }

    public function addticket(Request $request) 
    {
        $ticket = new Tickets();
        $member = User::find(\Auth::user()->id);
        $settings = \App\Settings::find(1);
        $ticket->ticket_id = time().$member->id;
        $ticket->user_id = $member->id;
        $ticket->project_id = $request->project_id;
        $ticket->department = $request->department;
        $ticket->subject = $request->subject;
        $ticket->message = $request->message;
        $ticket->is_agreed = $request->is_agreed_with_terms;

        //media
        if($request->hasFile('image1')) 
        {
            $file = \Input::file('image1');
            //getting timestamp
            $timestamp = time();
            $name = $timestamp . '-' . $file->getClientOriginalName();
            $ticket->file1 = $name;
            $file->move(public_path() . '/project_images/tickets/', $name);
        }

        $ticket->save();
        //TO-DO  Member Domain needs to ne made dynamic for the product in below email
        $template = \App\Emailtemplates::find(11);
        sendemail($member->email, $member->firstname, $member->lastname, $template, array('MEMBER_DOMAIN' => '', 'SUPPORT_TICKET_ID' => $ticket->ticket_id, 'SUPPORT_TICKET_SUBJECT' => $ticket->subject));
        $admintemplate = \App\Emailtemplates::find(12);
        sendemail($settings->admin_email, 'Admin', '', $admintemplate, array('MEMBER_DOMAIN' => '', 'SUPPORT_TICKET_ID' => $ticket->ticket_id, 'SUPPORT_TICKET_SUBJECT' => $ticket->subject, 'SUPPORT_TICKET_MESSAGE' => $ticket->message));
        \Activity::log('New support ticket raised - #' . $ticket->ticket_id);
        return redirect('/support')->with('message', 'Ticket has been created successfully');
    }

    public function ticketresponse(Request $request) {
        $member = User::find(\Auth::user()->id);
        $settings = \App\Settings::find(1);
        $response = new Ticketresponses();
        $response->ticket_id = $request->ticket_id;
        $response->response_from = $request->response_from;
        $response->response = $request->message;

        // media

        if ($request->hasFile('image1')) {
            $file = \Input::file('image1');
            //getting timestamp
            $timestamp = time();
            $name = $timestamp . '-' . $file->getClientOriginalName();

            $response->file1 = $name;

            $file->move(public_path() . '/project_images/tickets/', $name);
        }

        $response->save();
        $ticket = Tickets::where('ticket_id', $request->ticket_id)->first();

        $template = \App\Emailtemplates::find(14);
        sendemail($member->email, $member->firstname, $member->lastname, $template, array('MEMBER_DOMAIN' => '', 'SUPPORT_TICKET_ID' => $ticket->ticket_id, 'SUPPORT_TICKET_SUBJECT' => $ticket->subject));
        //TO-DO  Member Domain needs to ne made dynamic for the product in below email
        $admintemplate = \App\Emailtemplates::find(15);
        sendemail($settings->admin_email, 'Admin', '', $admintemplate, array('MEMBER_DOMAIN' => '', 'SUPPORT_TICKET_ID' => $ticket->ticket_id, 'SUPPORT_TICKET_SUBJECT' => $ticket->subject, 'SUPPORT_TICKET_MESSAGE' => $request->message));
        \Activity::log('Support ticket response triggered for ticket - #' . $ticket->ticket_id);
        return redirect('/viewticket/' . $request->ticket_id)->with('message', 'Response has been submitted successfully');
    }


    public function updatePassword(Request $request) {
        $user = User::find(\Auth::user()->id);
        $checkpassword = Hash::check($request->currentpassword, $user->password);
        // Validate the new password length...
        if ($checkpassword) {
            $user->fill([
                'password' => Hash::make($request->confirmnewpassword)
            ])->save();
            \Activity::log('Password updated.');
            //$template = \App\Emailtemplates::where('title', 'Password Changed For Member')->first();
            $template = \App\Emailtemplates::find(7);
            sendemail($user->email, $user->firstname, $user->lastname, $template, array('MEMBER_EMAIL' => $user->email, 'LOGIN_URL' => url('user/login')));
            $response['status'] = 1;
            $response['success_msg'] = 'Password has been changed successfully';

            return response()->json($response);
        } else {
            $response['status'] = 0;
            $response['err_msg'] = 'Current password does not matched';
            return response()->json($response);
        }
    }

    public function updateemail(Request $request) {
        $existinguser = User::all()->where('email', $request->newemail)->first();
        $member = User::find(\Auth::user()->id);
        if ($member->email == $request->newemail) {
            $response['status'] = 0;
            $response['message'] = 'You are already registered with this email address';
            return response()->json($response);
        } elseif ($existinguser) {
            $response['status'] = 0;
            $response['message'] = 'This email has been already registered';
            return response()->json($response);
        } else {
            $member->email = $request->newemail;
            $member->save();
            \Activity::log('Email address updated.');
            $response['status'] = 1;
            $response['message'] = 'Your email has been changed successfully';
            return response()->json($response);
        }
    }

    
    public function deletemyaccount($id) {
        $user = User::findOrFail($id);
        //dd($user);
        $user->delete();
        \Activity::log('Deleted account.');
        return redirect('/user/logout')->with('message', 'Your account has been deleted successfully.');
    }

    public function getRegister() {
        $countries = Country::all();
        $country = Country::find('101');
        $states = $country->states;
        $stat = State::find('1');
        $cities = $stat->cities;
        return view('user.register', compact('countries', 'states', 'cities'));
    }

}
