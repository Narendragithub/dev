<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Admin;
use App\Modules;
use App\Modpermissions;
use App\Departments;
use App\User;
use App\Project;
use Hash;

class AdminController extends Controller {

    /**
     * Create a new authentication controller instance.
     *
     * @return void
     */
    var $data = null;
    public function __construct() {
        if(!\Auth::user('admin')){
            return \Redirect::to('/admin/login')->send();
        }
        $this->middleware('admin2fa', ['except' => 'getLogout']);
    }

    public function getHome() {
        $this->data['active'] = 'overview';
        $users=User::orderBy('id', 'desc')->limit(5)->get();
        $projects = Project::orderBy('id', 'desc')->limit(5)->get();
        $usercount=User::count();
        $projectcount = Project::count();
        $user = Admin::find(\Auth::user('admin')->id);
        if($user->is_main==0){
            return redirect('/admin/projects');
        }
        return view('admin/dashboard',compact('users','projects','usercount','projectcount'))->with($this->data);
        //echo "Admin Logged In<br/>";
        //echo "<a href='" . action('Auth\AdminController@getLogout') . "'>Logout</a>";
        //dd(\Auth::user('admin'));
    }

    public function support() {
       
        $this->data['active'] = 'support';
        return view('admin/support')->with($this->data);
    }

    public function user($id=null) {
        $modules = Modules::all();
        $user=null;
        if($id){
            $user = Admin::findOrFail($id);
        }
        $this->data['active'] = 'settings';
        $departments = Departments::orderBy('id', 'desc')->paginate(10);
        return view('admin/user', compact('modules','user','departments'))->with($this->data);
    }

    public function adduser(Request $request) {
   $checkemail= Admin::where('email',$request->email)->first();     
        if($checkemail){
              return redirect('/admin/user')->with('error', 'User with email you have entered already exits')->with('active_tabid','adminuser');
        }else{
        $user = new Admin();
        $user->name = $request->name;
        $user->email = $request->email;
        $user->department_id = $request->department_id;
        $user->password = bcrypt($request->password);
        $user->verified = 1;
        $user->save();
        $permissions = $request->modules;
        if (count($permissions) > 0) {
            foreach ($permissions as $key => $value) {
                $perms=new Modpermissions();
                $perms->admin_id=$user->id;
                $perms->module_id=$value;
                $perms->save();
            }
        }
        return redirect('/admin/settings')->with('message', 'New user has been added.')->with('active_tabid','adminuser');
}
        }

    public function edit($id) {
        $this->data['active'] = 'settings';
       
        $modules = Modules::all();
        $user=null;
        $usermodules=array();
        if($id){
            $user = Admin::findOrFail($id);
            $userpermissions = $user->permissions;
            if($userpermissions){
                foreach($userpermissions as $module){
                    $usermodules[]=$module->module_id;
                }
            }
        }
         $departments = Departments::orderBy('id', 'desc')->paginate(10);
        $this->data['active'] = 'settings';
        return view('admin/user', compact('modules','user','usermodules','departments'))->with($this->data);
    }

    public function edituser(Request $request) {
        $userid = $request->userid;
        $user = Admin::findOrFail($userid);
        $checkemail= Admin::where('email',$request->email)->where('id','!=',$request->userid)->first();
        
        if($checkemail){
            return redirect(adminurl('edit/'.$user->id))->with('error', 'User with email you have entered already exits')->with('active_tabid','adminuser');
        }
        $user->name = $request->name;
        $user->email = $request->email;
        $user->department_id = $request->department_id;
        
        $user->save();
        $new=array();$old=array();
        $userpermissions = $user->permissions;
            if($userpermissions){
                foreach($userpermissions as $module){
                    $old[]=$module->module_id;
                }
            }
        $permissions = $request->modules;
        if (count($permissions) > 0) {
            foreach ($permissions as $key => $value) {
                $new[]=$value;
                
            }
        }
        
        $added = array_diff($new,$old);
        foreach($added as $newperm=>$value){
            $perms=new Modpermissions();
            $perms->admin_id=$user->id;
            $perms->module_id=$value;
            $perms->save();
        }
        $removed = array_diff($old,$new);
        foreach($removed as $newperm=>$value){
            $perms=  Modpermissions::where('module_id',$value)->where('admin_id',$user->id)->first();
            $perms->delete();
        }
       
        
        $this->data['active'] = 'settings';
        return redirect('/admin/settings')->with('message', 'User updated successfully')->with('active_tabid','adminuser');
    }

    public function deleteuser($id) {
        if($id==\Auth::user('admin')->id){
            return redirect(adminurl('settings'))->with('error', 'User cannot be deleted')->with('active_tabid','adminuser');
        }else{
        $user = Admin::findOrFail($id);
        $user->delete();
        return redirect('/admin/settings')->with('message', 'User deleted successfully')->with('active_tabid','adminuser');
        }
    }
    public function unauthorized() {
       $this->data['active']=null;
        return view('admin/unauthorized')->with($this->data);
    }
    public function changeadminpassword(Request $request){
        $adminid = $request->adminid;
        $adminpass = Admin::find($adminid);
        $currentpassword = Hash::check($request->currentpassword,$adminpass->password);
        if($currentpassword){
            $adminpass->password = Hash::make($request->confirmnewpassword);
            $adminpass->save();
            //$template = \App\Emailtemplates::where('title', 'Password Changed For Admin')->first();
            $template = \App\Emailtemplates::find(33);
            //sendemail($user->email,$user->firstname,$user->lastname?$user->lastname:'',$template,$user,array('LOGIN_URL'=>adminurl('login')));
            $response['status']=1;
            $response['success_msg'] = 'Your password has been successfully changed';
            return response()->json($response);
        }else{
            $response['status']=0;
            $response['err_msg'] = 'Current password does not matched';
            return response()->json($response);
        }
        
    }
}
