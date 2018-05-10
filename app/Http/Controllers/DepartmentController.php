<?php
namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Departments;
use Illuminate\Http\Request;
class DepartmentController extends Controller {

    var $data = null;

    public function __construct() {
        if(!\Auth::user('admin')){
            return \Redirect::to('/admin/login')->send();
        }
        $this->middleware('admin2fa', ['except' => 'getLogout']);
        $this->data['active'] = 'departments';
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

        $departments = Departments::orderBy('id', 'desc')->paginate(10);
      
        return view('admin.departments.index', compact('departments'))->with($this->data);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return Response
     */
    public function create() {
        
        return view('admin.departments.create')->with($this->data);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param Request $request
     * @return Response
     */
    public function store(Request $request) {
        $department = new Departments();
         $this->validate($request, [
            'department' => 'required'
            
        ]);
        $department->department_name = $request->department;
       
        $department->save();

        return redirect('admin/departments')->with('message', 'Department created successfully.');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return Response
     */
    public function show($id) {
        $department = Departments::findOrFail($id);

        return view('departments.show', compact('department'))->with($this->data);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return Response
     */
    public function edit($id) {
        $department = Departments::findOrFail($id);
       
        return view('admin.departments.create', compact('department'))->with($this->data);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  int  $id
     * @param Request $request
     * @return Response
     */
    public function update($id,Request $request) {
       
        $department = Departments::findOrFail($id);
          $this->validate($request, [
            'department' => 'required'
        ]);
        $department->department_name = $request->department;
        
        $department->save();

        return redirect('/admin/departments')->with('message', 'Department updated successfully.');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return Response
     */
    public function delete($id) {
        $department = Departments::findOrFail($id);
      
            $department->delete();
            return redirect('/admin/departments')->with('message', 'Department deleted successfully.');
       
        
    }

}
