<?php
namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Layouts;
use App\Attributes;
use App\Layoutattributes;
use Illuminate\Http\Request;
class LayoutController extends Controller {

    var $data = null;

    public function __construct() {
        if(!\Auth::user('admin')){
            return \Redirect::to('/admin/login')->send();
        }
        $this->middleware('admin2fa', ['except' => 'getLogout']);
        $this->data['active'] = 'layouts';
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
        
        $layouts = Layouts::orderBy('id', 'desc')->paginate(10);
      
        return view('admin.layouts.index', compact('layouts'))->with($this->data);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return Response
     */
    public function create() {
        $attributes= Attributes::all();
        $layoutattributes=array();
        return view('admin.layouts.create',compact('attributes','layoutattributes'))->with($this->data);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param Request $request
     * @return Response
     */
    public function store(Request $request) {
        
         $this->validate($request, [
            'title' => 'required'
            
        ]);
       
         
        $layout = new Layouts();
        $layout->name = $request->title;
       
        $layout->save();
        
        $attributes = $request->attribute;
        
        if (count($attributes) > 0) {
            foreach ($attributes as $key => $value) {
                $la=new Layoutattributes();
                $la->layout_id=$layout->id;
                $la->attribute_id=$value;
                $la->save();
            }
        }
        return redirect('admin/layouts')->with('message', 'Layout created successfully.');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return Response
     */
    public function show($id) {
        $layout = Layouts::findOrFail($id);

        return view('departments.show', compact('layout'))->with($this->data);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return Response
     */
    public function edit($id) {
        $layout = Layouts::findOrFail($id);
        $attributes= Attributes::all();
        $layoutattributes= array();
        $la = $layout->attributes;
            if($la){
                foreach($la as $lattributes){
                    $layoutattributes[]=$lattributes->attribute_id;
                }
            }
            
        return view('admin.layouts.create', compact('layout','attributes','layoutattributes'))->with($this->data);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  int  $id
     * @param Request $request
     * @return Response
     */
    public function update($id,Request $request) {
       
        $layout = Layouts::findOrFail($id);
          $this->validate($request, [
            'title' => 'required'
        ]);
        $layout->name = $request->title;
        
        $layout->save();
        $layout->attributes()->delete();
        $attributes = $request->attribute;
        
        if (count($attributes) > 0) {
            foreach ($attributes as $key => $value) {
                $la=new Layoutattributes();
                $la->layout_id=$layout->id;
                $la->attribute_id=$value;
                $la->save();
            }
        }
        return redirect('/admin/layouts')->with('message', 'Layout updated successfully.');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return Response
     */
    public function delete($id) {
        $layout = Layouts::findOrFail($id);
        $layout->attributes()->delete();
            $layout->delete();
            return redirect('/admin/layouts')->with('message', 'Layout deleted successfully.'); 
    }

}
