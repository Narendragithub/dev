<?php
namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Product;
use App\User;
use App\Category;
use Mail; 
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cookie;
class HomeController extends Controller {

    /**
     * Create a new authentication controller instance.
     *
     * @return void
     */
    
    public function index(Request $request) {
        //$products=  Product::all();
        //$categories = Category::all();
        if($request->ref && $request->ref > 0){
            echo $request->ref;
            Cookie::queue('referral',$request->ref, 60);
           
        }
       
        return view('welcome');
        /*echo "Logged In<br/>";
        echo "<a href='" . action('Auth\AuthController@getLogout') . "'>Logout</a>";
        dd(\Auth::user('user'));*/
        
    }
     public function checkemail($email){
		$checkemail = User::where('email',$email)->first();
		if($checkemail!=null){
			$response = array('status'=>1);
		}else{
			$response = array('status'=>0);
		}
		echo json_encode($response);
	}

    public function mail()
    {
        $user = User::find(43)->toArray();
        \Mail::send('emails.mailEvent', $user, function($message) use ($user) {
            $message->to('rajputnarendra62@gmail.com');
            $message->subject('Mailgun Testing');

        });

        dd('Mail Send Successfully');

    }
    

}
