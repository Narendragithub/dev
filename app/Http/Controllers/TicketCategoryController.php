<?php
namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\TicketCategory;
use Illuminate\Http\Request;
class TicketCategoryController extends Controller {

    var $data = null;

    public function __construct() {
        if(!\Auth::user('admin')){
            return \Redirect::to('/admin/login')->send();
        }
        $this->middleware('admin2fa', ['except' => 'getLogout']);
        $this->data['active'] = 'ticket_category';
        $currentuser=\Auth::user('admin');
        //dd($currentuser->permissions);
       
        if(checkperms($currentuser->permissions,1)==false){
            
            return redirect(adminurl('unauthorized'))->send();
           
        }
    }

    /**
     * Display a listing of the resource.
     *
     * @return Response
     */
    public function index() {

        $ticket_category = TicketCategory::orderBy('id', 'desc')->paginate(10);
      
        return view('admin.ticket_category.index', compact('ticket_category'))->with($this->data);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return Response
     */
    public function create() {
        
        return view('admin.ticket_category.create')->with($this->data);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param Request $request
     * @return Response
     */
    public function store(Request $request) {
        $ticket_category = new TicketCategory();
         $this->validate($request, [
            'ticket_category' => 'required'
            
        ]);
        $ticket_category->ticket_category_name = $request->ticket_category;
       
        $ticket_category->save();

        return redirect('admin/ticket_category')->with('message', 'Ticket Category created successfully.');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return Response
     */
    public function show($id) {
        $ticket_category = TicketCategory::findOrFail($id);

        return view('ticket_category.show', compact('ticket_category'))->with($this->data);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return Response
     */
    public function edit($id) {
        $ticket_category = TicketCategory::findOrFail($id);
       
        return view('admin.ticket_category.create', compact('ticket_category'))->with($this->data);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  int  $id
     * @param Request $request
     * @return Response
     */
    public function update($id,Request $request) {
       
        $ticket_category = TicketCategory::findOrFail($id);
          $this->validate($request, [
            'ticket_category' => 'required'
        ]);
        $ticket_category->ticket_category_name = $request->ticket_category;
        
        $ticket_category->save();

        return redirect('/admin/ticket_category')->with('message', 'Ticket Category updated successfully.');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return Response
     */
  
      public function delete($id) {
       $ticket_category = TicketCategory::findOrFail($id);     
        if($ticket_category->ticket->count() > 0){
            return redirect('/admin/ticket_category')->with('error', 'Cannot delete category as it contains Ticket.');
        }else{
            $ticket_category->delete();
            return redirect('/admin/ticket_category')->with('message', 'Category deleted successfully.');
        }  
    }

}
