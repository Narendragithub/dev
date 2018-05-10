<?php
namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Attributes;
use Illuminate\Http\Request;
class AttributeController extends Controller {

    var $data = null;

    public function __construct() {
        if(!\Auth::user('admin')){
            return \Redirect::to('/admin/login')->send();
        }
        $this->middleware('admin2fa', ['except' => 'getLogout']);
        $this->data['active'] = 'attributes';
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

        $attributes = Attributes::orderBy('id', 'desc')->paginate(10);
      
        return view('admin.attributes.index', compact('attributes'))->with($this->data);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return Response
     */
    public function create() {
        
        return view('admin.attributes.create')->with($this->data);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param Request $request
     * @return Response
     */
    public function store(Request $request) {
        $attribute = new Attributes();
         $this->validate($request, [
            'attribute' => 'required'
            
        ]);
        $attribute->name = $request->attribute;
       
        $attribute->save();

        return redirect('admin/attributes')->with('message', 'Attribute created successfully.');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return Response
     */
    public function show($id) {
        $attribute = Attributes::findOrFail($id);

        return view('attributes.show', compact('attribute'))->with($this->data);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return Response
     */
    public function edit($id) {
        $attribute = Attributes::findOrFail($id);
       
        return view('admin.attributes.create', compact('attribute'))->with($this->data);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  int  $id
     * @param Request $request
     * @return Response
     */
    public function update($id,Request $request) {
       
        $attribute = Attributes::findOrFail($id);
          $this->validate($request, [
            'attribute' => 'required'
        ]);
        $attribute->name = $request->attribute;
        
        $attribute->save();

        return redirect('/admin/attributes')->with('message', 'Attribute updated successfully.');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return Response
     */
    public function delete($id) {
        $attribute = Attributes::findOrFail($id);
        if($attribute->themes->count() > 0){
            return redirect('/admin/attributes')->with('error', 'Cannot delete attribute as it contains themes.');
        }else{
            $attribute->delete();
            return redirect('/admin/attributes')->with('message', 'Attribute deleted successfully.');
        }
        
    }

}
