<?php

namespace App\Http\Controllers;

use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Input;
use App\Category;
use App\Country;
use App\State;
use App\City;
use App\Contactcategory;
use App\Customer;
use App\User;
use App\Contact;
use App\Template;
use App\Groupsms;
use App\Smsdetail;
use App\Smsrequest;
use Hash;
use Clickatell\Api\ClickatellHttp;

class ApiController extends BaseController {

    use AuthorizesRequests,
        DispatchesJobs,
        ValidatesRequests;

    // categories api
    var $categoryid = null;

    public function index() {
        $data = json_decode(file_get_contents('php://input'), true);
        $customer_id = $data['user_id'];
        $tree = $this->getCategoryTree($parent = 0, $customer_id);
        $response = array('status' => 1, 'data' => $tree);
        return response()->json($response);
    }

    public function getCategoryTree($parent, $customer_id) { // to do - add in helpers
        $categories = array();

        $result = Category::where('parent', $parent)->where('user_id', $customer_id)->get();
        foreach ($result as $mainCategory) {
            $category = array();
            $category['id'] = $mainCategory->id;
            $category['name'] = $mainCategory->name;
            $category['parent'] = $mainCategory->parent;
            $category['sub_categories'] = $this->getCategoryTree($category['id'], $customer_id);
            $categories[] = $category;
        }
        return $categories;
    }

    public function add() {
        $data = json_decode(file_get_contents('php://input'), true);
        $customerid = $data['user_id'];
        $categoryname = $data['category_name'];
        $categoryid = $data['category_id'];
        $category = new Category();
        $category->name = $categoryname;
        $category->user_id = $customerid;
        $category->parent = $categoryid;
        $category->save();

        $response = array('status' => 1, 'data' => 'Category added successfully');
        return response()->json($response);
    }

    public function updatecategory() {
        $response = array();
        $data = json_decode(file_get_contents('php://input'), true);
        $category_id = $data['category_id'];
        $userid = $data['user_id'];
        $categoryname = $data['category_name'];
        $user = Customer::find($userid);
        if ($user) {
            $category = Category::find($category_id);
            if ($category) {
                $category->name = $categoryname;
                $category->save();
                $response = array('status' => 1, 'data' => 'Category has been updated successfully');
            } else {
                $response = array('status' => 0, 'data' => 'Cannot found the requested category');
            }
        } else {
            $response = array('status' => 0, 'data' => 'Invalid user');
        }
        return response()->json($response);
    }

    public function deletecategory() {
        $response = array();
        $data = json_decode(file_get_contents('php://input'), true);
        $category_id = $data['category_id'];
        $userid = $data['user_id'];

        $user = Customer::find($userid);
        if ($user) {
            $category = Category::find($category_id);
            if ($category) {
                $category->delete();
                $response = array('status' => 1, 'data' => 'Category has been deleted successfully');
            } else {
                $response = array('status' => 0, 'data' => 'Cannot found the requested category');
            }
        } else {
            $response = array('status' => 0, 'data' => 'Invalid user');
        }
        return response()->json($response);
    }

    // categories api ends
    // authetication api starts
    public function login() {
        $data = json_decode(file_get_contents('php://input'), true);
        $email = $data['email'];
        $pass = $data['password'];
        $customer = Auth::guard('customer')->attempt(['email' => $email, 'password' => $pass]);
        if ($customer == true) {
            $details = Customer::where('email', $email)->first();
            $response = array('status' => 1, 'data' => $details);
            return response()->json($response);
        }
    }

    // authetication api ends
    // user api starts
    public function details() {
        $data = json_decode(file_get_contents('php://input'), true);
        $customer_id = $data['user_id'];
        $details = Customer::find($customer_id);
        if ($details) {
            $response = array('status' => 1, 'data' => $details);
            return response()->json($response);
        } else {
            $response = array('status' => 0, 'error' => 'No records found');
            return response()->json($response);
        }
    }

    public function dashboard() {
        $data = json_decode(file_get_contents('php://input'), true);
        $dashboardarray = array();
        //$test = generatePassword();
        $customer_id = $data['user_id'];
        $details = Customer::find($customer_id);
        $totalusers = count($details->contacts);
        $url = "http://gateway.leewaysoftech.com/creditapi.php?username=" . $details->apiuser . "&password=" . $details->apipass; // 
        $ch = curl_init($url);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        $curl_scraped_page = curl_exec($ch);

        array_push($dashboardarray, array('id' => $details->id, 'name' => $details->name, 'email' => $details->email, 'mobile' => $details->mobile, 'address' => $details->address, 'apiuser' => $details->apiuser, 'apipass' => $details->apipass, 'senderid' => $details->senderid, 'smsalloted' => $details->smsalloted, 'remaining_sms' => $curl_scraped_page, 'totalusers' => $totalusers, 'sentsms' => 0));

        $response = array('status' => 1, 'data' => $dashboardarray);

        return response()->json($response);
    }

    public function addcontact() {
        $data = json_decode(file_get_contents('php://input'), true);
        $categoryid = $data['category_id'];
        $customerid = $data['user_id'];
        $name = $data['name'];
        $address = $data['address'];
        $mobile = $data['mobile'];

        $user = new Contact();
        //$user->category_id = $categoryid;
        $user->customer_id = $customerid;
        $user->name = $name;
        $user->address = $address;
        $user->mobile = $mobile;
        $user->save();
        $contactcategory = new Contactcategory();
        $contactcategory->user_id = $user->id;
        $contactcategory->category_id = $categoryid;
        $contactcategory->save();
        $response = array('status' => 1, 'data' => 'User added successfully');
        return response()->json($response);
    }

    public function updatecontact() {
        $response = array();
        $data = json_decode(file_get_contents('php://input'), true);
        $customerid = Customer::find($data['user_id']);
        if ($customerid) {
            $contact = Contact::where('id', $data['contact_id'])->where('customer_id', $data['user_id'])->first();
            if ($contact) {
                $contact->name = $data['name'];
                $contact->address = $data['address'];
                $contact->mobile = $data['mobile'];
                $contact->save();
                $response = array('status' => 1, 'data' => 'Contact has been added successfully');
            } else {
                $response = array('status' => 0, 'data' => 'Contact not found');
            }
        } else {
            $response = array('status' => 1, 'data' => 'Invalid user');
        }
        return response()->json($response);
    }

    public function deletecontact() {
        $response = array();
        $data = json_decode(file_get_contents('php://input'), true);
        $customerid = Customer::find($data['user_id']);
        if ($customerid) {
            $contact = Contact::where('id', $data['contact_id'])->where('customer_id', $data['user_id'])->first();
            if ($contact) {
                $contact->delete();
                $response = array('status' => 1, 'data' => 'Contact has been deleted successfully');
            } else {
                $response = array('status' => 0, 'data' => 'Contact not found');
            }
        } else {
            $response = array('status' => 1, 'data' => 'Invalid user');
        }
        return response()->json($response);
    }

    public function allcontacts() {
        $response = array();
        $data = json_decode(file_get_contents('php://input'), true);
        $customer = Customer::find($data['user_id']);
        if ($customer) {
            $contacts = $customer->contacts;
            if (count($contacts) > 0) {
                $response = array('status' => 1, 'data' => $contacts);
            } else {
                $response = array('status' => 1, 'data' => 'No contacts found');
            }
        } else {
            $response = array('status' => 1, 'data' => 'Invalid user');
        }
        return response()->json($response);
    }

    public function allwithcategory() {
        $response = array();
        $data = json_decode(file_get_contents('php://input'), true);
        $customer = Customer::find($data['user_id']);
        $userarray = array();
        $cids = array();
        $cids[] = $data['category_id'];
        if ($customer) {
            $category = new Category();
            $subcat = $category->where('parent', $data['category_id'])->where('parent', '!=', 0)->get();

            foreach ($subcat as $cat1) {
                $cids[] = $cat1->id;
            }
            $users = $category->contacts($cids);
            if (count($users) > 0) {
                foreach($users as $val1){
                    $val = Contact::find($val1->user_id);
		   if($val)
                    $userarray[]=$val;
                }
            }
            $response = array('status' => 1, 'data' => $userarray);
            /* $contacts = $customer->contacts()->where('category_id', $data['category_id'])->get();
              if (count($contacts) > 0) {
              $response = array('status' => 1, 'data' => $contacts);
              } else {
              $response = array('status' => 1, 'data' => 'No contacts found');
              } */
        } else {
            $response = array('status' => 1, 'data' => 'Invalid user');
        }
        return response()->json($response);
    }

    // user api ends
    public function sendsms() {

        $data = json_decode(file_get_contents('php://input'), true);

        $template_id = 0;
        $template = null;

        $contact = null;
        $smstext = null;
        $group_id = 0;
        $contact_id = array();
        $user_id = 0; // Contact ID
        $user = null;
        $mobile = array(); // Contact Mobile
        $schedule_date = null;
        $schedule_time = null;
        $schedule_array = array();

        if (isset($data['schedule_datetime']) && $data['schedule_datetime'] !=null) {
            $date = explode(" ", $data['schedule_datetime']);
            $schedule_array = array('schedualdate' => $date[0], 'schedualtime' => $date[1]);
        }
        if (isset($data['schedule_date'])) {
            $schedule_date = $data['schedule_date'];
        }
        if (isset($data['schedule_time'])) {
            $schedule_time = $data['schedule_time'];
        }
        if ($schedule_date && $schedule_time) {
            $schedule_array = array('schedualdate' => $schedule_date, 'schedualtime' => $schedule_time);
        }
        //print_r($schedule_array);die();
        if (isset($data['group_id'])) {
            $group_id = $data['group_id'];
        }

        if (isset($data['smstext'])) {
            $smstext = $data['smstext'];
        }
        if (isset($data['user_id'])) {
            $user_id = $data['user_id'];
        }
        if (isset($data['contact_id'])) {
            if (!is_array($data['contact_id'])) {
                if (strpos($data['contact_id'], ',')) {
                    $contact_id = explode(',', $data['contact_id']);
                } else {
                    $contact_id[] = $data['contact_id'];
                }
            }
        }
        if (isset($data['contact_id[]'])) {
            if (count($data['contact_id[]']) == 1) {
                $contact_id[] = $data['contact_id[]'];
            } else {
                $contact_id = $data['contact_id[]'];
            }
        }
        if (isset($data['mobile'])) {
            if (!is_array($data['mobile'])) {
                if (strpos($data['mobile'], ',')) {
                    $mobile = explode(',', $data['mobile']);
                } else {
                    $mobile[] = $data['mobile'];
                }
            }
        }
        if (isset($data['mobile[]'])) {
            $mobile[] = $data['mobile[]'];
        }
        if (isset($data['template_id'])) {
            $template_id = $data['template_id'];
            $template = Template::where('id', $template_id)->where('user_id', $user_id)->get();
            $smstext = $template->content;
        }

        $customer = Customer::find($data['user_id']);
        if ($group_id > 0) {
            $group = Category::where('id', $group_id)->where('user_id', $user_id)->first();
            if ($group) {
                $contacts = $group->contacts(array($group_id));
                // Insert into group tables
                $groupsms = new Groupsms();
                $groupsms->group_id = $group_id;
                $groupsms->customer_id = $user_id;
                $groupsms->template_id = $template_id;
                $groupsms->smstext = $smstext;
                $groupsms->status = 0;
                $groupsms->save();

                foreach ($contacts as $val) {
                    $user = Contact::find($val->user_id);
                    if($user){
                    $smsdetails = new Smsdetail();
                    $smsdetails->groupsms_id = $groupsms->id;
                    $smsdetails->customer_id = $customer->id;
                    $smsdetails->template_id = $template_id;
                    $smsdetails->status = 0;
                    $smsdetails->user_id = $user->id;
                    $smsdetails->mobile = $user->mobile;
                    $smsdetails->smstext = $smstext;
                    if (count($schedule_array) > 0) {
                        $schedule = implode(" ", $schedule_array);
                        $schedule = $schedule . ":00";
                        $smsdetails->scheduled_at = $schedule;
                    }

                    $clickatell = new ClickatellHttp($customer->apiuser, $customer->apipass, $customer->senderid);

                    $response = $clickatell->sendMessage(array($user->mobile), $smstext, $schedule_array);

                    $guid = $response[0]->GUID; //leeway_trans-e8c155d118c0a723
                    $smsdetails->responsecode = $guid;
                    if ($guid == 'INVALID-NUM') {
                        //$smsdetails->status = -1;
                    }
                    $smsdetails->save();
                    //$mobilesend[]=$user->mobile;
                    }
                }
            }
        } else {
            $groupsms_id = time();
            if (count($contact_id) > 0) {

                foreach ($contact_id as $key => $value) {
                    $contact = Contact::find($value);
                    $contactmobile = $contact->mobile;
                    $smsdetails = new Smsdetail();
                    $smsdetails->groupsms_id = $groupsms_id;
                    $smsdetails->customer_id = $user_id;
                    $smsdetails->template_id = $template_id;
                    $smsdetails->status = 0;
                    $smsdetails->user_id = $contact->id;
                    $smsdetails->mobile = $contactmobile;
                    $smsdetails->smstext = $smstext;
                    //$smsdetails->save();
                    $clickatell = new ClickatellHttp($customer->apiuser, $customer->apipass, $customer->senderid);

                    $response = $clickatell->sendMessage(array($contactmobile), $smstext, $schedule_array);

                    $guid = $response[0]->GUID; //leeway_trans-e8c155d118c0a723
                    $smsdetails->responsecode = $guid;
                    if ($guid == 'INVALID-NUM') {
                       // $smsdetails->status = -1;
                    }

                    $smsdetails->save();
                }
            }
            if (count($mobile) > 0) {
                foreach ($mobile as $key => $value) {
                    $contact_id = 0;
                    $contact = new Contact();
                    $iscontact = $contact->getContactByMobile($value, $user_id);
                    if ($iscontact) {
                        $contact_id = $iscontact->id;
                        $mobile = $iscontact->mobile;
                    } else {
                        $mobile = $value;
                    }
                    //$mobile = $contact->mobile;
                    $smsdetails = new Smsdetail();
                    $smsdetails->groupsms_id = 0;
                    $smsdetails->customer_id = $user_id;
                    $smsdetails->template_id = $template_id;
                    $smsdetails->status = 0;
                    $smsdetails->user_id = $contact_id;
                    $smsdetails->mobile = $value;
                    $smsdetails->smstext = $smstext;
                    //$smsdetails->save();
                    
                    $clickatell = new ClickatellHttp($customer->apiuser, $customer->apipass, $customer->senderid);
                    $response = $clickatell->sendMessage(array($mobile), $smstext, $schedule_array);

                    $guid = $response[0]->GUID; //leeway_trans-e8c155d118c0a723
                    $smsdetails->responsecode = $guid;
                    if ($guid == 'INVALID-NUM') {
                       // $smsdetails->status = -1;
                    }

                    $smsdetails->save();
                }
            }
        }
        $customer->sendlists()->delete();
        $response = array('status' => 1, 'data' => 'Your messages have been send.Delivery status will be updated shortly.');
        return response()->json($response);
    }

    public function alltemplates() {
        $response = array();
        $data = json_decode(file_get_contents('php://input'), true);
        $userid = $data['user_id'];
        $user = Customer::find($userid);
        if ($user) {
            $templates = $user->templates;
            $response = array('status' => 1, 'data' => $templates);
        } else {
            $response = array('status' => 0);
        }
        return response()->json($response);
    }

    public function templatedetails() {
        $response = array();
        $data = json_decode(file_get_contents('php://input'), true);
        $userid = $data['user_id'];
        $template_id = $data['template_id'];
        $user = Customer::find($userid);
        if ($user) {
            $templates = $user->templates()->where('id', $template_id)->first();
            $response = array('status' => 1, 'data' => $templates);
        } else {
            $response = array('status' => 0);
        }
        return response()->json($response);
    }

    public function addtemplate() {
        $data = json_decode(file_get_contents('php://input'), true);
        $template = new Template();
        $template->user_id = $data['user_id'];
        $template->title = $data['title'];
        $template->content = $data['content'];
        $template->save();
        $response = array('status' => 1, 'data' => 'New template has been added successfully');
        return response()->json($response);
    }

    public function updatetemplate() {
        $response = array();
        $data = json_decode(file_get_contents('php://input'), true);
        $template = Template::find($data['template_id']);
        if ($template) {
            //$template->user_id = $data['user_id'];
            $template->title = $data['title'];
            $template->content = $data['content'];
            $template->save();
            $response = array('status' => 1, 'data' => 'Template has been updated ');
        } else {
            $response = array('status' => 0, 'data' => 'Template not found');
        }
        return response()->json($response);
    }

    public function deletetemplate() {
        $data = json_decode(file_get_contents('php://input'), true);
        $user = Customer::find($data['user_id']);
        $template = $user->templates()->where('id', $data['template_id'])->first();
        $template->delete();
        $response = array('status' => 1, 'data' => 'Template has been deleted successfully');
        return response()->json($response);
    }

    public function requestsms() {
        $data = json_decode(file_get_contents('php://input'), true);
        $smsrequest = new Smsrequest();
        $smsrequest->customer_id = $data['user_id'];
        $smsrequest->status = 0;
        $smsrequest->requested_sms = $data['requested_sms'];
        $smsrequest->save();
        $response = array('status' => 1, 'data' => 'You request has been submitted.Please wait for the admins response');
        return response()->json($response);
    }

    public function smsrequests() {
        $data = json_decode(file_get_contents('php://input'), true);
        $user = Customer::find($data['user_id']);
        $smsrequests = $user->smsrequests;
        $response = array('status' => 1, 'data' => $smsrequests);
        return response()->json($response);
    }
	public function getreport() {
   
        $response = array();
        $data = json_decode(file_get_contents('php://input'), true);
        $userid = $data['user_id'];
        $user = Customer::find($userid);
        if ($user) {
            $smsdetails = $user->senddetails()->orderBy('id', 'desc')->get();
            $response = array('status' => 1, 'data' => $smsdetails);
        } else {
            $response = array('status' => 0);
        }
        return response()->json($response);
    }
	public function getstates(){
		$countryid = Input::get('countryid');
		$country = Country::find($countryid);
		$states = $country->states;
		$statehtml = '<select id="state" onchange="getcities(this.value)" name="state">';
		foreach($states as $state){
			 $statehtml.= '<option value='.$state->id.'>'.$state->name.'</option>';
		}
		$statehtml.='</select>';
		$response = array('status'=>1,'statehtml'=>$statehtml);
		return response()->json($response);
		die;
	}
	public function getcities(){
		$stateid = Input::get('stateid');
		$states = State::find($stateid);
		$cities = $states->cities;
		$cityhtml = '<select id="city" name="city">';
		foreach($cities as $city){
			 $cityhtml.= '<option value='.$city->id.'>'.$city->name.'</option>';
		}
		$cityhtml.='</select>';
		$response = array('status'=>1,'cityhtml'=>$cityhtml);
		return response()->json($response);
		die;
	}
}