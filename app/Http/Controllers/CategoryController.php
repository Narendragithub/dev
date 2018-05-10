<?php
namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Category;
use Illuminate\Http\Request;
class CategoryController extends Controller {

    var $data = null;

    public function __construct() {
        if(!\Auth::user('admin')){
            return \Redirect::to('/admin/login')->send();
        }
        $this->middleware('admin2fa', ['except' => 'getLogout']);
        $this->data['active'] = 'categories';
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

        $categories = Category::orderBy('id', 'desc')->paginate(10);
       
        return view('admin.categories.index', compact('categories'))->with($this->data);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return Response
     */
    public function create() {
        $pcategories = Category::where('parent_id', 0)->get();
        return view('admin.categories.create', compact('pcategories'))->with($this->data);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param Request $request
     * @return Response
     */
    public function store(Request $request) {
        $category = new Category();
        $this->validate($request, [
            'category' => 'required'
        ]);
        $category->category = $request->category;
        $category->parent_id = $request->parent_id;

        $category->save();

        return redirect()->route('admin.categories.index')->with('message', 'Item created successfully.');
    }

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
    public function edit($id) {
        $category = Category::findOrFail($id);
        $pcategories = Category::where('parent_id', 0)->get();
        return view('admin.categories.create', compact('category','pcategories'))->with($this->data);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  int  $id
     * @param Request $request
     * @return Response
     */
    public function update($id,Request $request) {
       
        $category = Category::findOrFail($id);
         $this->validate($request, [
            'category' => 'required'
        ]);
        $category->category = $request->category;
        $category->parent_id = $request->parent_id;
        $category->save();


        //$category->save();

        return redirect('/admin/categories')->with('message', 'Item updated successfully.');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return Response
     */
    public function delete($id) {
        $category = Category::findOrFail($id);
        if($category->projects->count() > 0){
            return redirect('/admin/categories')->with('error', 'Cannot delete category as it contains projects.');
        }else{
            $category->delete();
            return redirect('/admin/categories')->with('message', 'Category deleted successfully.');
        }  
    }

}
