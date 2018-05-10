<?php
namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Settings;
use App\Socialsettings;

use App\Admin;
use App\Emailsettings;
use App\Emailtemplates;
use Input;
use Illuminate\Http\Request;
class SettingsController extends Controller {

    var $data = null;

    public function __construct() {
        if(!\Auth::user('admin')){
            return \Redirect::to('/admin/login')->send();
        }
        $this->middleware('admin2fa', ['except' => 'getLogout']);
        $this->data['active'] = 'settings';
        $currentuser=\Auth::user('admin');
        //dd(adminurl('unauthorized'));
        if(checkperms($currentuser->permissions,8)===false){
            
            return redirect(adminurl('unauthorized'))->send();
           
        }
    }

    /**
     * Display a listing of the resource.
     *
     * @return Response
     */
    public function index(Request $request) {
        if($request->typ){
            \Session::set('active_tabid',$request->typ);
        }
        $email_settings= Emailsettings::find(1);
        $settings = Settings::findOrfail(1);
        $social_settings = Socialsettings::all();
       
        $emailtemplates=Emailtemplates::orderBy('id','asc')->get();
        $admin=\Auth::user('admin');
        
        if(\Auth::user('admin')->is_main==1){
            $activities=  \DB::table('activity_log')->where('is_admin',1)->where('user_id','>',0)->orderBy('id','desc')->paginate(25);
        }else{
            $activities=  \DB::table('activity_log')->where('user_id',\Auth::user('admin')->id)->where('is_admin',1)->orderBy('id','desc')->get();
        }
        
        $adminusers = Admin::orderBy('id','desc')->paginate(10);
        return view('admin.settings.overview', compact('settings','adminusers','social_settings','email_settings','activities','emailtemplates','admin'))->with($this->data)->with('active_tabid','payment');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return Response
     */
    //public function create() {
    //    $pcategories = Category::where('parent_id', 0)->get();
    //    return view('admin.categories.create', compact('pcategories'))->with($this->data);
    //}

    /**
     * Store a newly created resource in storage.
     *
     * @param Request $request
     * @return Response
     */
    /*public function store(Request $request) {
        $category = new Category();
        $category->category = $request->category;
        $category->parent_id = $request->parent_id;

        $category->save();

        return redirect()->route('admin.categories.index')->with('message', 'Item created successfully.');
    }*/

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return Response
     */
    public function show($id) {
        $category = Category::findOrFail($id);

        return view('categories.show', compact('category'))->with($this->data);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return Response
     */
    /*public function edit($id) {
        $category = Category::findOrFail($id);
        $pcategories = Category::where('parent_id', 0)->get();
        return view('admin.categories.create', compact('category','pcategories'))->with($this->data);
    }*/

    /**
     * Update the specified resource in storage.
     *
     * @param  int  $id
     * @param Request $request
     * @return Response
     */
    public function update(Request $request) {
       
        $settings = Settings::findOrFail(1);
        
        $settings->google_client_id = $request->google_client_id;
        $settings->google_client_secret = $request->google_client_secret;
        $settings->google_redirect = $request->google_redirect;
        $settings->fb_client_id = $request->fb_client_id;
        $settings->fb_client_secret = $request->fb_client_secret;
        $settings->fb_redirect = $request->fb_redirect;
        
        $settings->save();
        \Activity::log('Social settings updated');

        //$category->save();

        return redirect('/admin/settings')->with('message', 'Item updated successfully.');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return Response
     */
    public function delete($id) {
        $category = Category::findOrFail($id);
        if($category->products->count() > 0){
            \Activity::log('Category delete attempted');
            return redirect('/admin/categories')->with('error', 'Cannot delete category.');
        }else{
            $category->delete();
            \Activity::log('Category deleted');
            return redirect('/admin/categories')->with('message', 'Category deleted successfully.');
        }
        
        
    }
    
    
    public function addsocial(Request $request) {
        $socialsetting= new Socialsettings();
        $socialsetting->provider = $request->provider;
        $socialsetting->client_id = $request->client_id;
        $socialsetting->client_secret = $request->client_secret;
        $socialsetting->redirect = $request->redirect;
        
        
        $socialsetting->save();
        \Activity::log('New social settings added');

        //$category->save();

        return redirect('/admin/settings')->with('message', 'Provider added successfully.')->with('active_tabid','social');
    }
    public function updatesocial(Request $request) {
        $socialsetting= Socialsettings::find($request->social_id);
        $socialsetting->provider = $request->provider;
        $socialsetting->client_id = $request->client_id;
        $socialsetting->client_secret = $request->client_secret;
        $socialsetting->redirect = $request->redirect;
        
        
        $socialsetting->save();
        \Activity::log('Social settings updated');

        //$category->save();

        return redirect('/admin/settings')->with('message', 'Provider updated successfully.')->with('active_tabid','social');
    }
  
   
   
    public function socialdelete($id){
        $social= Socialsettings::find($id);
        if($social){
            $social->delete();
            \Activity::log('Social provider method deleted');
            return redirect(adminurl('settings'))->with('message', 'Social provider deleted successfully.')->with('active_tabid','social');
        }
        
    }
    public function socialedit($id){
        $social= Socialsettings::find($id);
        if($social){
            return view('admin.social',compact('social'))->with($this->data);
        }
        
    }
    public function socialadd(){
        $social= null;
        
            return view('admin.social',compact('social'))->with($this->data);
        
        
    }
    public function updateemail(Request $request) {
       
        $settings = Settings::findOrFail(1);
        
        $settings->site_title=$request->site_title;
        $settings->from_name=$request->from_name;
        $settings->from_email=$request->from_email;
        $settings->emailotp=$request->emailotp;
       
        $settings->admin_email=$request->admin_email;
        
        if ($request->hasFile('logo')) {
            $file = Input::file('logo');
            //getting timestamp
            $timestamp = time();
            $name = $timestamp . '-' . $file->getClientOriginalName();

            $settings->logo = $name;

            $file->move(public_path() . '/images/', $name);
        }
        $settings->save();
       
      
        \Activity::log('General /  settings updated');

        //$category->save();

        return redirect('/admin/settings')->with('message', 'Settings updated successfully.')->with('active_tabid',$request->active_tabid);
    }
   
    public function createtemplate($id=null){
        $template=null;
        if($id){
            $template= Emailtemplates::find($id);
        }
        return view('admin.templates.create',compact('template'))->with($this->data);
    }
    public function addtemplate(Request $request){
        $template=new Emailtemplates();
        $template->title=$request->title;
        $template->content=$request->content;
        $template->subject=$request->subject;
        $template->save();
        return redirect('/admin/settings')->with('message', 'Email template created successfully.')->with('active_tabid',$request->active_tabid);
    }
    public function updatetemplate(Request $request){
        $template= Emailtemplates::find($request->template_id);
        $template->title=$request->title;
        $template->content=$request->content;
        $template->subject=$request->subject;
        $template->save();
        return redirect('/admin/settings')->with('message', 'Email template updated successfully.')->with('active_tabid',$request->active_tabid);
    }
    public function updateauth(Request $request) {
        $this->data['active'] = 'profile';
        $update = true;
        $member = Admin::find(\Auth::user('admin')->id);
        $member->ip_restricted=$request->ip_restricted;
        
        $ip_address=$request->getClientIp();
        if(!$member->checkIP($ip_address) && $request->ip_restricted==1){
            $newip= new \App\Userips();
            $newip->user_id=$member->id;
            $newip->ip_address=$ip_address;
            $newip->is_admin=1;
            $newip->save();
            $template = Emailtemplates::where('title', 'Mail to Admin While Admin Set IP Restriction')->first();
            sendemail($template,$member,array('ADMIN_IP'=>\Request::getClientIp()));
            $update = true;
            
        }
        $member->emailotp = $request->emailotp;
        if($request->emailotp == 1 && $request->google2fa==0){
            \Session::put('admincustomauthorized', 1);
        }
        $member->google2fa=$request->google2fa;
        if ($request->google2fa==0) {
            $member->google2fakey=null;
            
        }   
        
        
        if ($update) {
           
            $member->save();
            
            \Activity::log('Profile settings updated');

            return \Redirect::to(adminurl('settings'))->with('message', 'Profile updated successfully.')->with('active_tabid','profile');
        } else {
            return \Redirect::to(adminurl('settings'))->with('active_tabid','profile');
        }
    }
    public function clearlog(){
        if(\Auth::user('admin')->is_main==1){
             $activitylogs=\DB::table('activity_log')->where('is_admin',1);
             $activitylogs->delete();
             return redirect('/admin/settings')->with('message', 'Activity logs deleted.')->with('active_tabid','logs');
        }else{
            return redirect('/admin/settings')->with('error', 'Could not delete activity logs. Permission denied')->with('active_tabid','logs');
        }
    }
}
