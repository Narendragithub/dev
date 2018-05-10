<?php
namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Project;
use App\Tickets;
use App\User;
use App\TicketCategory;
use App\Ticketresponses;
use Illuminate\Http\Request;
class SupportController extends Controller {

    /**
     * Create a new authentication controller instance.
     *
     * @return void
     */
    public function __construct() {
        if(!\Auth::user('admin')){
            return \Redirect::to('/admin/login')->send();
        }
        $this->middleware('admin2fa', ['except' => 'getLogout']);
        $this->data['active'] = 'support';
        $currentuser=\Auth::user('admin');
        //dd(adminurl('unauthorized'));
        if(checkperms($currentuser->permissions,7)===false){
            
            return redirect(adminurl('unauthorized'))->send();
           
        }
    }

    public function index(){
       $tickets = Tickets::orderBy('id', 'desc')->paginate(10);
       $users = User::all();
       $departments = TicketCategory::all();
       return view('admin.support', compact('tickets','users','departments'))->with($this->data);
    }
    public function search(Request $request){
    
     $ticket_id = $request->ticket_id;
     $user = $request->user;
     $department = $request->department;
     $status = $request->status;
       
      // $tickets = Tickets::orderBy('id', 'desc')->paginate(10);
      $tickets = Tickets::orderBy('id','desc')
     ->where('status', 'LIKE', "%{$status}%") 
  ->where('user_id', 'LIKE', "%{$user}%")
  ->where('department', 'LIKE', "%{$department}%")
  ->where('ticket_id', 'LIKE', "%{$ticket_id}%")
  ->paginate(10);
       $users = User::all();
       $departments = TicketCategory::all();
       return view('admin.support', compact('tickets','users','departments','request'))->with($this->data);
    }
    public function view($id){
        $tickets = Tickets::orderBy('id', 'desc')->paginate(10);
        $ticket = Tickets::findOrFail($id);
        
        $user = $ticket->user;
        $responses = $ticket->responses;
        $project = Project::findOrFail($ticket->project_id);
        return view('admin.viewticket', compact('ticket','tickets','project','user','responses'))->with($this->data);
    }
    public function ticketresponse(Request $request){
        $id = $request->ticket_main_id;
        $ticket = Tickets::findorFail($id);
        $response = new Ticketresponses();
       
        $response->ticket_id = $request->ticket_id;
        $response->response_from = 'Admin';
        $response->response = $request->response;
        $response->note = $request->note;
        // for main table update
        
        $ticket->remarks = $request->remarks;
        
        $ticket->save();
        // for main table update
        // media section
        if ($request->hasFile('image1')) {
            $file = \Input::file('image1');
            //getting timestamp
            $timestamp = time();
            $name = $timestamp . '-' . $file->getClientOriginalName();

            $response->file1 = $name;

            $file->move(public_path() . '/product_images/tickets/', $name);
            }
            if ($request->hasFile('image2')) {
            $file = \Input::file('image2');
            //getting timestamp
            $timestamp = time();
            $name = $timestamp . '-' . $file->getClientOriginalName();

            $response->file2 = $name;

            $file->move(public_path() . '/product_images/tickets/', $name);
            }
            if ($request->hasFile('image3')) {
            $file = \Input::file('image3');
            //getting timestamp
            $timestamp = time();
            $name = $timestamp . '-' . $file->getClientOriginalName();

            $response->file3 = $name;

            $file->move(public_path() . '/product_images/tickets/', $name);
            }
            if ($request->hasFile('image4')) {
            $file = \Input::file('image4');
            //getting timestamp
            $timestamp = time();
            $name = $timestamp . '-' . $file->getClientOriginalName();

            $response->file4 = $name;

            $file->move(public_path() . '/product_images/tickets/', $name);
            }
           
            $response->save();
            
            return redirect('admin/support/view/'.$id)->with('message', 'Response has been submitted successfully');
    }
}
