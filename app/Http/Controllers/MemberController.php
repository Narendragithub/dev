<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\User;
use App\Order;
use App\Product;
use App\Tickets;
use App\Ticketresponses;
use App\Testimonial;


use Input;
use Illuminate\Http\Request;

class MemberController extends Controller {

    var $data = null;

    public function __construct() {
        if(!\Auth::user('admin')){
            return \Redirect::to('/admin/login')->send();
        }
        $this->middleware('admin2fa', ['except' => 'getLogout']);
        $this->data['active'] = 'members';
        $currentuser=\Auth::user('admin');
        //dd(adminurl('unauthorized'));
        if(checkperms($currentuser->permissions,5)===false){
            
            return redirect(adminurl('unauthorized'))->send();
           
        }
    }

    /**
     * Display a listing of the resource.
     *
     * @return Response
     */
    public function index() {

        $members = User::orderBy('id', 'desc')->paginate(10);
        //dd($products);//die();
        return view('admin.members.index', compact('members'))->with($this->data);
    }
    public function delete($id){
       
        $user = User::findOrFail($id);
        $user->delete();
        return redirect('/admin/members')->with('message','Customer deleted');
    }
    public function overview($id){
        $orderdetails = array();
        $invoicedetails = array();
        $member=User::find($id);
        $orders = Order::where('user_id',$id)->get();
        $logs= \DB::table('activity_log')->where('user_id',$id)->where('is_admin',0)->orderBy('id','desc')->get();
        foreach($orders as $order){
           $invoices = $order->invoice;
           
           $orderitems = $order->items;
           $product=null;
           foreach($orderitems as $item){
           $product = Product::find($item->product_id);
           if($product){
           array_push($orderdetails,array('productname'=>$product->name,'product_price'=>$item->price,'paid_amount'=>$order->total,'payment_mode'=>$order->payment_mode,'created_at'=>$order->created_at));
           }
           }
           
           array_push($invoicedetails,array('invoice_number'=>$order->order_no,'invoice_date'=>$invoices->created_at,'total_amount'=>$order->order_price,'payment_mode'=>$order->payment_mode,'status'=>$order->status));
        }
       
       $tickets = Tickets::where('user_id',$id)->get();
       
       return view('admin.members.overview', compact('member','orderdetails','tickets','invoicedetails','logs'))->with($this->data);
    }
    public function testimonials(){
       $testimonials = Testimonial::all();
       $this->data['active'] = 'testimonials';
       return view('admin.testimonials.index', compact('testimonials'))->with($this->data);
    }
    public function approvetestimonial($id){
        $testimonial = Testimonial::findOrFail($id);
        $testimonial->status = 1;
        $testimonial->save();
        return redirect('/admin/settings')->with('message','Testimonial approved successfully');
    }
    public function disapprovetestimonial($id){
        $testimonial = Testimonial::findOrFail($id);
        $testimonial->status = 0;
        $testimonial->save();
        
        return redirect('/admin/settings')->with('message','Testimonial disapproved');
    }
    public function deletetestimonial($id){
        $testimonial = Testimonial::findOrFail($id);
        $testimonial->delete();
        return redirect('/admin/settings')->with('message','Testimonial deleted');
    }
    
    public function editresponse(Request $request){
        $responses = Ticketresponses::find($request->responseid);
        $responses->response = $request->editedresponse;
        $responses->save();
        $returnid = $request->mainticketid;
        return redirect('/admin/support/view/'.$returnid)->with('message','Response edited successfully');
    }
    public function deleteresponse($id,$returnid){
        $responses = Ticketresponses::find($id);
        $responses->delete();
        return redirect('/admin/support/view/'.$returnid)->with('message','Response deleted successfully');
    }
}
