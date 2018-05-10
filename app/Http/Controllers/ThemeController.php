<?php
namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Themes;
use App\Attributes;
use Illuminate\Http\Request;
use Input;
class ThemeController extends Controller {

    var $data = null;

    public function __construct() {
        if(!\Auth::user('admin')){
            return \Redirect::to('/admin/login')->send();
        }
        $this->middleware('admin2fa', ['except' => 'getLogout']);
        $this->data['active'] = 'themes';
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

        $themes = Themes::orderBy('id', 'desc')->paginate(10);
       
        return view('admin.themes.index', compact('themes'))->with($this->data);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return Response
     */
    public function create() {
          $attributes = Attributes::orderBy('id', 'desc')->get();  
        return view('admin.themes.create', compact('attributes'))->with($this->data);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param Request $request
     * @return Response
     */
    public function store(Request $request) {
        $theme = new Themes();
        $this->validate($request, [
            'attribute_id' => 'required',
            'theme' => 'required' 
        ]);
        $theme->name = $request->theme;
        $theme->attribute_id = $request->attribute_id;
         if ($request->hasFile('image')) {
            $file = Input::file('image');
            //getting timestamp
            $timestamp = time();
            $name = $timestamp . '-' . $file->getClientOriginalName();

            $theme->image = $name;

            $file->move(public_path() . '/theme_images/', $name);
        }
        $theme->save();

        return redirect('admin/themes')->with('message', 'Theme created successfully.');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return Response
     */
    public function show($id) {
        $theme = Themes::findOrFail($id);

        return view('themes.show', compact('theme'))->with($this->data);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return Response
     */
    public function edit($id) {
        $theme = Themes::findOrFail($id);
         $attributes = Attributes::orderBy('id', 'desc')->get();
        return view('admin.themes.create', compact('theme','attributes'))->with($this->data);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  int  $id
     * @param Request $request
     * @return Response
     */
    public function update($id,Request $request) {
       
        $theme = Themes::findOrFail($id);
         $this->validate($request, [
            'attribute_id' => 'required',
            'theme' => 'required' 
        ]);
        $theme->name = $request->theme;
        $theme->attribute_id = $request->attribute_id;
        if ($request->hasFile('image')) {
            $file = Input::file('image');
            //getting timestamp
            $timestamp = time();
            $name = $timestamp . '-' . $file->getClientOriginalName();

            $theme->image = $name;

            $file->move(public_path() . '/theme_images/', $name);
        }
        $theme->save();

        //$category->save();

        return redirect('/admin/themes')->with('message', 'Theme updated successfully.');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return Response
     */
    public function delete($id) {
        $theme = Themes::findOrFail($id);
      
            $theme->delete();
            return redirect('/admin/themes')->with('message', 'Theme deleted successfully.');
       
    }

}
