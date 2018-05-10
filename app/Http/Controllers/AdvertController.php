<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\Adverts;
use App\Socialsettings;

use App\Admin;
use App\Emailsettings;
use App\Emailtemplates;
use Input;

class AdvertController extends Controller
{

    var $data = null;

    public function __construct() {

        if(!\Auth::user('admin')){
            return \Redirect::to('/admin/login')->send();
        }
        $this->middleware('admin2fa', ['except' => 'getLogout']);
        $this->data['active'] = 'advert';
        $currentuser=\Auth::user('admin');
        //dd(adminurl('unauthorized'));
        if(checkperms($currentuser->permissions,8)===false){
            
            return redirect(adminurl('unauthorized'))->send();
           
        }
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
         if($request->typ){
            \Session::set('active_tabid',$request->typ);
        }
       
        $images=Adverts::all();
        return view('admin.advert.index',compact('images'))->with($this->data);;
        
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }


    public function upload(Request $request) 
    {
        if(!\Auth::user('admin')){
            return \Redirect::to('/admin/login')->send();
        }

        if($request->hasFile('file')) 
        {
            $file = Input::file('file');
            if($request->files->get('file')->getMimeType()== "image/jpeg")
            {
                $timestamp = time();
                $name = $timestamp . '-' . $file->getClientOriginalName();
                $file->move(public_path() . '/advert_images/', $name);
                //$this->compress_image($request->files->get('file')->getPathName(),public_path('advert_images'). '/'. $name, 50);

                $advertimage = new Adverts();
                $advertimage->image = $name;
                $advertimage->save();
                $str = '';
                $images=Adverts::all();
                $last_image_id=0;
                foreach($images as $image) 
                {
                    $imgpath = url("advert_images/" . $image->image);

                    $str .='<div class="col-md-2 swipe" id="' . $image->id . '" style="padding-top:15px;">
                               <div class="fileinput fileinput-new">
                                <div class="fileinput-preview thumbnail">
                                    <img src="' . $imgpath . '" style="height: 136px;width: 230px;">
                                   </div>
                                   <div>
                                   <a href="javascript:void(0)" class="btn btn-danger" onClick="removeAdvertImage(' . $image->id . ');">Remove</a>
                                   </div>
                                </div>
                            </div>';
                    $last_image_id= $image->id;      
                }

                
                $str .='<div id="uploader" class="col-sm-2" style="padding-top:15px;">
                        <div  class="drag-and-drop-zone uploader graphicassets">
                            <div>Drag &amp; Drop Images Here</div>
                                <div class="or">-or-</div>
                                <div class="browser">
                                  <label>
                                    <span>Select Image</span>
                                    <input type="file" name="image"  accept="image/jpeg"  title="Click to add Images">
                                  </label>
                                </div>
                            </div>
                            <div style="display: none;" class="progressbar">   
                        </div>
                    </div>';
                    


                return response()->json(array('success' => true,'str' => $str,'last_image_id'=>$last_image_id,'tabid'=>'uploader', 'total' => count($images)), 200);
            
            }
            else
            {
                return response()->json(array('success' => false, 'msg' =>'Only jpeg images are allowed'), 200);
            }
        } 
        else 
        {
            return response()->json(array('success' => false, 'msg' =>'No input file specified'), 200);
        }
    }

    public function removeimage($id) 
    {
        $image = Adverts::findOrFail($id);
        $image_name=$image->image;
        $image->delete();

        \File::Delete(public_path() . '/advert_images/' . $image_name); //Delete file from folder
        $str = '';
        $paneldiv ='uploader';
        $images=Adverts::all();               
        return response()->json(array('str' => $str, 'divtoappend' => $paneldiv, 'total' => count($images)), 200);
    }

    public function swipeimages(Request $request) 
    {
        
        if(!\Auth::user())
        {
            return \Redirect::to('/')->send();
        }
    
        if(isset($_POST['dragimg_id']) && $_POST['dragimg_id'] != '' && isset($_POST['dropimg_id']) && $_POST['dropimg_name'] != '') 
        {
            //Drage Image
            $dropimg_name=explode('/',$request->dropimg_name);
            $dregimg = Adverts::where('id', $request->dragimg_id)->first();
            $dregimg->image = $dropimg_name[4];
            $dregimg->updated_at = date("Y-m-d H:i:s");
            $dregimg->save();

            //Drop Image
            $dragimg_name= explode("/",$request->dragimg_name);
            $dropimg = Adverts::where('id', $request->dropimg_id)->first();
            $dropimg->image = $dragimg_name[4];
            $dropimg->updated_at = date("Y-m-d H:i:s");
            $dropimg->save();
        }

        return response()->json(array('success' => true), 200);
    }

}
