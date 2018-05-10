<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Project;
use App\Category;
use App\Admin;
use App\User;
use App\Country;
use App\Layouts;
use App\Departments;
use App\Layoutattributes;
use App\Themes;
use App\Attributes;
use App\Pro_imagecategories;
use App\Pro_layoutthemes;
use App\Projectimage;
use App\Projectlayouts;
use App\Projectxmldetail;
use App\Projectfiles;
use App\Projectsteps;
use App\Userprofile;
use App\Renderimages;
use App\Assetsbundleplatform;
use App\Assetsbundle;
use App\Transfer_project;
use Jenssegers\Agent\Agent;
use Input;
use ZipArchive;
use Illuminate\Http\Request;
use Intervention\Image\Facades\Image;
use File;
use Storage;
class ProjectController extends Controller {

    var $data = null;

    public function __construct() {

        $this->data['active'] = 'projects';
    }

    /**
     * Display a listing of the resource.
     *
     * @return Response
     */
    public function index() {
        
//        $s3 = \App::make('aws')->createClient('s3');
//         
//         $list=$s3->listBuckets();
//         print_r($list);
//         die;
        if (!\Auth::user('admin')) {
            return \Redirect::to('/admin')->send();
        }
        if (\Auth::user('admin')->is_main == 1) {
            $projects = Project::orderBy('id', 'desc')->where('is_submitted',1)->paginate(10);
        } else {
            $projects = Project::where('status', '>=', \Auth::user('admin')->department_id)->where('is_submitted',1)->orderBy('id', 'desc')->paginate(10);
        }

        return view('admin.projects.index', compact('projects'))->with($this->data);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return Response
     */
    public function create(Request $request) {
        if (!\Auth::user()) {
            return \Redirect::to('/')->send();
        }
        $service = 0;
        if ($request->service) {
            $service = $request->service;
        }

        $categories = Category::all();
        $imagecategories = Pro_imagecategories::all();
        $country = Country::find('101');
        $countries = $country->allcities()->get();
        $layouts = Layouts::all();
        $attributes = Attributes::all();
        $user = User::find(\Auth::user()->id);
        $profile = Userprofile::where('user_id', $user->id)->first();
     
        $this->data['success'] = 'Your project has been created.';
        return view('user.createproject', compact('categories', 'user', 'countries', 'profile', 'layouts', 'attributes', 'imagecategories', 'service'))->with($this->data);
    }

    public function quickcreate(Request $request) {
        if (!\Auth::user()) {
            return \Redirect::to('/')->send();
        }


        if ($request->pid > 0) {
            $project = Project::find($request->pid);
        } else {
            $project = new Project();
        }

        $project->user_id = \Auth::user()->id;
        $project->title = $request->project_title;
        $project->premium_service = $request->service;
        
        if ($request->service == 1) {
            $project->is_public = 0;
        } else {
            $project->is_public = 1;
        }
        $project->save();

        //Update Project refrence link
        $project->id = $project->id;
        $project->alias  = substr($request->project_title, 0, 2).$project->id;
        $project->save();

        $departments = Departments::all();
        foreach ($departments as $department) {
            $projectsteps = new Projectsteps();
            $projectsteps->project_id = $project->id;
            $projectsteps->step = $department->id;
            $projectsteps->save();
        }
        \Session::flash('message', 'Your project has been created successfully.');
        return redirect(url('project/edit/' . $project->id));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param Request $request
     * @return Response
     */
    public function savedetails(Request $request) {
        $project = Project::find($request->pid);
        $project->title = $request->project_title;
        $project->short_description = $request->short_description;
        $project->description = $request->description;
        $project->category_id = $request->category;
        $project->save();
        \Session::flash('active_id', '#prdetails');
        
        // \Session::flash('message', 'Your project has been created successfully.');
        return redirect(url("project/edit/" . $project->id));
    }

    public function savelinks(Request $request) {
        $project = Project::find($request->pid);
        $project->website = $request->website;
        $project->brochure_link = $request->ebrochure;
        $project->location = $request->location;
        $project->featured_video = $request->featured_video;
        $project->save();
        \Session::flash('active_id', '#prlinks');
        return redirect(url("project/edit/" . $project->id));
    }

    public function savecontact(Request $request) {
        $project = Project::find($request->pid);
        $project->email = $request->email;
        $project->phone = $request->mobile;
        $project->address = $request->address;
        $project->save();
        \Session::flash('active_id', '#prcontact');
        return redirect(url("project/edit/" . $project->id));
    }

    public function transfer_project(Request $request) {
        $reciever_id = 0;
        $email = $request->email;
        $user = User::find(\Auth::user()->id);
        $reciever_user = User::where('email', $email)->first();
        if (count($reciever_user) > 0) {
            $reciever_id = $reciever_user->id;
        }
        $transfer_project = new Transfer_project();
        $transfer_project->project_id = $request->pid;
        $transfer_project->sender_id = \Auth::user()->id;
        $transfer_project->reciever_id = $reciever_id;
        $transfer_project->reciever_email = $email;
        $transfer_project->save();
        $subject = "Tranfer Project";
        $headers = "From: test@test.com"; // remove space      
        $message = "Please accept project"; // no intendation
        $mail = mail($email, $subject, $message, $headers);
        $subject = "Tranfer Project";
        $headers = "From: test@test.com"; // remove space      
        $message = "Tranfer project request send successfully";
        $mail = mail($user->email, $subject, $message, $headers);
        \Session::flash('active_id', '#transfer');
        return redirect(url("project/edit/" . $request->pid));
    }

    public function saveassets(Request $request) {
        
    }

    public function savepublish(Request $request) {
        $project = Project::find($request->pid);
        $project->is_public = $request->is_public;
        $project->save();
        \Session::flash('active_id', '#publish');
        return redirect(url("project/edit/" . $project->id));
    }

    public function store(Request $request) {
        if (!\Auth::user()) {
            return \Redirect::to('/')->send();
        }
        if ($request->pid > 0) {
            $project = Project::find($request->pid);
        } else {
            $project = new Project();
        }
        $project->user_id = \Auth::user()->id;
        $project->title = $request->project_title;
        $project->company_name = $request->company_name;
        $project->short_description = $request->short_description;
        $project->description = $request->description;
        $project->location = $request->location;
        $project->city = $request->city;
        $project->website = $request->website;
        $project->email = $request->email;
        $project->phone = $request->mobile;
        $project->category_id = $request->category;
        $project->brochure_link = $request->ebrochure;
        $project->premium_service = $request->service;
        //version

        if ($request->hasFile('feature_image')) {
            $file = Input::file('feature_image');
            //getting timestamp
            $timestamp = time();
            $name = $timestamp . '-' . $file->getClientOriginalName();

            $project->featured_image = $name;

            $file->move(public_path() . '/project_images/', $name);
        }
            if ($request->hasFile('thumbnail')) {
                $file = Input::file('thumbnail');
                //getting timestamp
                $timestamp = time();
                $name = $timestamp . '-' . $file->getClientOriginalName();

                $project->project_thumb = $name;

                $file->move(public_path() . '/project_images/thumbnail/', $name);
            }
        $project->save();

        $imagecategories = Pro_imagecategories::all();

        foreach ($imagecategories as $imagecategory) {
            for ($i = 1; $i < 13; $i++) {
                if ($request->hasFile($imagecategory->category . $i)) {
                    $file = Input::file($imagecategory->category . $i);
                    //getting timestamp
                    $timestamp = time();
                    $name = $timestamp . '-' . $file->getClientOriginalName();
                    $file->move(public_path() . '/project_images/', $name);
                    $projectimage = new Projectimage();
                    $projectimage->project_id = $project->id;
                    $projectimage->img_category_id = $imagecategory->id;
                    $projectimage->image = $name;
                    $projectimage->save();
                }
            }
        }

        echo url("project/edit/" . $project->id);
    }

    public function createprojectservices(Request $request) {
        if (!\Auth::user()) {
            return \Redirect::to('/')->send();
        }
        $project = Project::find($request->pid);

        $project->premium_service = $request->service;

        $project->save();

        echo $project->id;
    }

    public function addprojectlayout(Request $request) {
        if (!\Auth::user()) {
            return \Redirect::to('/')->send();
        }
        $project = Project::find($request->pid);
        $projectlayout = new Projectlayouts();
        if($request->layout){
        $projectlayout->project_id = $project->id;
        $projectlayout->layout_id = $request->layout;


        if ($request->hasFile('top_view')) {
            $file = Input::file('top_view');
            //getting timestamp
            $timestamp = time();
            $name = $timestamp . '-' . $file->getClientOriginalName();

            $projectlayout->top_view = $name;

            $file->move(public_path() . '/project_files/', $name);
        }

        if ($request->hasFile('side_view')) {
            $file = Input::file('side_view');
            //getting timestamp
            $timestamp = time();
            $name = $timestamp . '-' . $file->getClientOriginalName();

            $projectlayout->side_view = $name;

            $file->move(public_path() . '/project_files/', $name);
        }

        if ($request->hasFile('furniture_plan_view')) {
            $file = Input::file('furniture_plan_view');
            //getting timestamp
            $timestamp = time();
            $name = $timestamp . '-' . $file->getClientOriginalName();

            $projectlayout->furniture_plan_view = $name;

            $file->move(public_path() . '/project_files/', $name);
        }

        if ($request->hasFile('reference_image')) {
            $file = Input::file('reference_image');
            //getting timestamp
            $timestamp = time();
            $name = $timestamp . '-' . $file->getClientOriginalName();

            $projectlayout->reference_image = $name;

            $file->move(public_path() . '/project_files/', $name);
        }

        $projectlayout->ceiling_height = $request->ceiling_height;
        $projectlayout->door_height = $request->door_height;
        $projectlayout->window_height = $request->window_height;
        $projectlayout->window_distance_ceiling = $request->window_distance_ceiling;
        $projectlayout->save();



        $layout = Layouts::find($request->layout);
        $attributes = $layout->attributes;
        foreach ($attributes as $attributeinfo) {

            $attribute = $attributeinfo->attributes;
            $themes = $attribute->themes;
            $fieldname = "attr_" . $attribute->id;
            if (isset($_POST[$fieldname]) && $_POST[$fieldname] != '') {
                $layouttheme = new Pro_layoutthemes();
                $layouttheme->project_id = $project->id;
                $layouttheme->layout_id = $request->layout;
                $layouttheme->theme_id = $_POST[$fieldname];
                $layouttheme->attribute_id = $attribute->id;
                $layouttheme->save();
            }
        }
    }
        \Session::flash('active_id', '#design9');
        return redirect(url('project/edit/' . $request->pid));
    }

    public function addrenderimage(Request $request) {
        if (!\Auth::user('admin')) {
            return \Redirect::to('/')->send();
        }

        $renderimages = new Renderimages();
        $renderimages->project_id = $request->pid;
        $name = '';
        if ($request->hasFile('image')) {
            $file = Input::file('image');
            //getting timestamp
            $timestamp = time();
            $name = $timestamp . '-' . $file->getClientOriginalName();

            $renderimages->image = $name;

            $file->move(public_path() . '/project_images/render_images/', $name);
        }

        $renderimages->save();
        return redirect(adminurl('project/view/' . $request->pid));
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

        //print_r(\Session::all());
		$thumbimage=null;
        $categories = Category::all();
        $project = Project::findOrFail($id);
        $imagecategories = Pro_imagecategories::all();
        $country = Country::find('101');
        $countries = $country->allcities()->get();
        $layouts = Layouts::all();
        $attributes = Attributes::all();
        $projectlayouts = $project->projectlayouts;
        $renderimages = $project->renderimages;
		$projectThumbs= $project->thumbnails();
		if(count($projectThumbs) > 0){
			foreach($projectThumbs as $thumb){
					if($thumb->image){
						$thumbimage=$thumb->image;
					}
			}
		}else{
			$thumbimage=null;
		}

        $details = User::where('id', $project->user_id)->first();
       /* $dst = public_path().'/' . $details['firstname']."_".$details['id'];
        $myfile = fopen($dst."/StreamingAssets/TestJson.json", "w") or die("Unable to open file!");
        $txt=$project->user_json;
        fwrite($myfile, $txt);
        fclose($myfile);*/
		$this->data['thumbimage']=$thumbimage;
        $transfer_project = Transfer_project::where('project_id', $id)->where('sender_id', \Auth::user()->id)->where('status', 0)->first();
        $this->data['project'] = $project;
        $this->data['categories'] = $categories;
        $this->data['webgl_link'] = url().'/public/'.$details['firstname']."_".$details['id'].'/index.html';
        $this->data['editproject']='editproject';
        return view('user.editproject', compact('project', 'categories', 'imagecategories', 'countries', 'layouts', 'attributes', 'projectlayouts', 'renderimages', 'transfer_project'))->with($this->data);
    }

    public function view($id) {
        $user = Admin::find(\Auth::user('admin')->id);
        $project = Project::findOrFail($id);
        $project->view_status=1;
        $project->save();
        $imagecategories = Pro_imagecategories::all();
        $assetsbundleplatform = Assetsbundleplatform::all();
        $projectlayouts = $project->projectlayouts()->get();
        $projectxmldetail = $project->projectxmldetail;
        $renderimages = $project->renderimages()->get();
        $projectfiles = $project->projectfiles()->get();
        $departments = Departments::all();
        return view('admin.projects.view', compact('user', 'project', 'imagecategories', 'projectlayouts', 'projectxmldetail', 'renderimages', 'projectfiles', 'departments', 'assetsbundleplatform'))->with($this->data);
    }

    /*
     * 
     * Update the specified resource in storage.
     *
     * @param  int  $id
     * @param Request $request
     * @return Response
     */

    public function update(Request $request) {

        $project = Project::find($request->pid);
        $project->title = $request->project_title;
        $project->company_name = $request->company_name;
        $project->short_description = $request->short_description;
        $project->description = $request->description;
        $project->location = $request->location;
        $project->city = $request->city;
        $project->website = $request->website;
        $project->email = $request->email;
        $project->phone = $request->mobile;
        $project->category_id = $request->category;
        $project->brochure_link = $request->ebrochure;
        //version

        if ($request->hasFile('feature_image')) {
            $file = Input::file('feature_image');
            //getting timestamp
            $timestamp = time();
            $name = $timestamp . '-' . $file->getClientOriginalName();
            $project->featured_image = $name;
            $file->move(public_path() . '/project_images/', $name);
        }
        if ($request->hasFile('thumbnail')) {
            $file = Input::file('thumbnail');
            //getting timestamp
            $timestamp = time();
            $name = $timestamp . '-' . $file->getClientOriginalName();
            $project->project_thumb = $name;
            $file->move(public_path() . '/project_images/thumbnail/', $name);
        }
        $project->save();

        $imagecategories = Pro_imagecategories::all();

        foreach ($imagecategories as $imagecategory) {
            if ($request->hasFile($imagecategory->category)) {
                $file = Input::file($imagecategory->category);
                //getting timestamp
                $timestamp = time();
                $name = $timestamp . '-' . $file->getClientOriginalName();
                $file->move(public_path() . '/project_images/', $name);
                $projectimage = new Projectimage();
                $projectimage->project_id = $project->id;
                $projectimage->img_category_id = $imagecategory->id;
                $projectimage->image = $name;
                $projectimage->type = 0;
                $projectimage->save();
            }
        }
        foreach ($imagecategories as $imagecategory) {
            $imgvar = $imagecategory->category . '_t';
            if ($request->hasFile($imgvar)) {
                $file = Input::file($imgvar);
                //getting timestamp
                $timestamp = time();
                $name = $timestamp . '-' . $file->getClientOriginalName();
                $file->move(public_path() . '/project_images/', $name);
                $projectimage = new Projectimage();
                $projectimage->project_id = $project->id;
                $projectimage->img_category_id = $imagecategory->id;
                $projectimage->image = $name;
                $projectimage->type = 1;
                $projectimage->save();
            }
        }

        echo $project->id;
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return Response
     */
    public function destroy($id) {
        $category = Category::findOrFail($id);
        $category->delete();

        return redirect()->route('categories.index')->with('message', 'Item deleted successfully.');
    }

    public function addversion(Request $request) {
        $version = new Productversion();
        $version->version = $request->version_name;
        $version->product_id = $request->product_id;

        if ($request->hasFile('versionfile')) {
            $file = Input::file('versionfile');
            //getting timestamp
            $timestamp = time();
            $name = $timestamp . '-' . $file->getClientOriginalName();

            $version->filename = $name;

            $file->move(public_path() . '/product_images/', $name);
        }
        $version->save();
        return redirect(adminurl('products/edit/' . $request->product_id))->with('message', 'Version added successfully');
    }

    public function addmoduleversion(Request $request) {
        $version = new Moduleversions();
        $version->version = $request->version_name;
        $version->product_id = $request->productid;
        $version->module_id = $request->moduleid;

        if ($request->hasFile('versionfile')) {
            $file = Input::file('versionfile');
            //getting timestamp
            $timestamp = time();
            $name = $timestamp . '-' . $file->getClientOriginalName();

            $version->filename = $name;

            $file->move(public_path() . '/product_images/', $name);
        }
        $version->save();
        return redirect(adminurl('products/edit/' . $request->productid))->with('message', 'Version added successfully');
    }

    public function updateversion(Request $request, $id) {
        $version = Productversion::findOrFail($id);
        $version->version = $request->updated_version_name;
        $version->save();
        return redirect(adminurl('products/edit/' . $request->productid))->with('message', 'Version updated successfully');
    }

    public function updatemoduleversion(Request $request, $id) {
        $version = Moduleversions::findOrFail($id);
        //dd($version);
        $version->version = $request->updated_version_name;
        if ($request->hasFile('updateversionfile')) {
            $file = Input::file('updateversionfile');
            //getting timestamp
            $timestamp = time();
            $name = $timestamp . '-' . $file->getClientOriginalName();

            $version->filename = $name;

            $file->move(public_path() . '/product_images/', $name);
        } else {
            $version->filename = $request->oldversionimage;
        }
        $version->save();
        return redirect(adminurl('products/edit/' . $request->productid))->with('message', 'Module Version updated successfully');
    }

    public function updatemodule(Request $request, $id) {
        $version = Productmodules::findOrFail($id);
        //dd($version);
        //dd($version);
        $version->module_title = $request->update_module_title;
        $version->description = $request->moduledescription;
        if ($request->hasFile('updatedmodulefile')) {
            $file = Input::file('updatedmodulefile');
            //getting timestamp
            $timestamp = time();
            $name = $timestamp . '-' . $file->getClientOriginalName();

            $version->image = $name;

            $file->move(public_path() . '/product_images/', $name);
        } else {
            $version->image = $request->old_module_image;
        }
        $version->save();
        return redirect(adminurl('products/edit/' . $request->productid))->with('message', 'Module updated successfully');
    }

    // delete version
    public function deleteversion($id) {
        $version = Productversion::findOrFail($id);
        $version->delete();
        return redirect(adminurl('products/edit/' . $version->product_id))->with('message', 'Version deleted successfully');
    }

    public function delete($id) {
        $project = Project::findOrFail($id);
        $project->delete();
        return redirect('/admin/projects')->with('message', 'Project deleted successfully.');
    }
    public function userdelete($id) {
        $project = Project::findOrFail($id);
        $project->delete();
        return redirect('/home')->with('message', 'Project deleted successfully.');
    }

    public function addmodule($id) {
        $product = Product::findOrFail($id);
        //dd($product);
        return view('admin.products.module', compact('product'))->with($this->data);
    }

    public function addservices($id) {
        $product = Product::findOrFail($id);
        //dd($product);
        return view('admin.products.services', compact('product'))->with($this->data);
    }

    public function newmodule(Request $request) {
        $module = new Productmodules();
        $module->product_id = $request->product_id;
        $module->module_title = $request->module_title;
        $module->description = $request->description;
        $module->domain = 'test';                   //to do $request->domain;
        $module->price = $request->price;

        // media
        if ($request->hasFile('image')) {
            $file = Input::file('image');
            //getting timestamp
            $timestamp = time();
            $name = $timestamp . '-' . $file->getClientOriginalName();

            $module->image = $name;

            $file->move(public_path() . '/product_images/', $name);
        }
        $module->save();

        $version = new Moduleversions();
        $version->version = $request->version_name;
        $version->product_id = $request->product_id;
        $version->module_id = $module->id;
        $version->is_current = 1;
        if ($request->hasFile('versionfile')) {
            $file = Input::file('versionfile');
            //getting timestamp
            $timestamp = time();
            $name = $timestamp . '-' . $file->getClientOriginalName();

            $version->filename = $name;

            $file->move(public_path() . '/product_images/', $name);
        }
        $version->save();


        return redirect('/admin/products');
    }

    public function newservices(Request $request) {
        $services = new Productservices();
        $services->product_id = $request->product_id;
        $services->service_title = $request->service_title;
        $services->description = $request->description;
        $services->domain = 'test';                   //to do $request->domain;
        $services->price = $request->price;

        // media
        if ($request->hasFile('image')) {
            $file = Input::file('image');
            //getting timestamp
            $timestamp = time();
            $name = $timestamp . '-' . $file->getClientOriginalName();

            $services->image = $name;

            $file->move(public_path() . '/product_images/', $name);
        }
        $services->save();
        return redirect('/admin/products');
    }

    public function removeimage($id) {
        $image = Projectimage::findOrFail($id);
        $project_id = $image->project_id;
        $img_category_id = $image->img_category_id;
        $category = Pro_imagecategories::find($img_category_id);
        //dd($category);
        $image_name=$image->image;
        $type = $image->type;
        $image->delete();
        /*if(file_exists(public_path() . '/project_images/' . $image_name)) 
        {
            chmod(public_path() . '/project_images/', 0777);
            if(unlink(public_path() . '/project_images/' . $image_name))
            {
                echo "deleted";  
            }
        
        }*/
        
        \File::Delete(public_path() . '/project_images/' . $image_name); //Delete file from folder
        $typ = '';
        $paneldiv = '';
        $str = '';
        $imagecategories = Projectimage::where('project_id', $project_id)->where('type', $type)->where('img_category_id', $img_category_id)->get();
        $imgcount = 4;
        if ($img_category_id == 1 || $img_category_id == 2)
            $imgcount = 0;
        if ($type == 0) {
            $typ = '_p';
            $paneldiv = 'home' . $img_category_id;
        }
        if ($type == 1) {
            $typ = '_t';
            $paneldiv = 'profile' . $img_category_id;
        }
        if ($type == 2) {
            $typ = '_d';
            $paneldiv = 'messages' . $img_category_id;
        }
        if (count($imagecategories) == $imgcount) {

            $str = '<div class="col-sm-4" style="padding-top:15px;">
                        <div class="drag-and-drop-zone uploader graphicassets '.str_replace(' ', '_',$category->category).$typ.'" id="' .str_replace(' ', '_',$category->category).$typ . '" catname="' . $category->category . '" cat="'.$category->id.'" typ="' . $type . '" pid="' . $project_id . '" paneldiv="' . $paneldiv . '">
                            <div>Drag &amp; Drop Images Here</div>
                            <div class="or">-or-</div>
                            <div class="browser">
                              <label>
                                <span>Select Image</span>
                                <input type="file" name="' .str_replace(' ', '_',$category->category).$typ . '"  accept="image/jpeg"  title="Click to add Images">
                              </label>
                            </div>
                        </div>
                        <div style="display: none;" class="progressbar_' .str_replace(' ','_',$category->category).$typ . '">   
                        </div>
                    </div>';                
        }
        return response()->json(array('str' => $str, 'divtoappend' => $paneldiv,'penal'=>'cat'.$img_category_id, 'total' => count($imagecategories)), 200);
    }

    public function getattribute($id) {
        $layout = Layouts::find($id);

        $attributes = $layout->attributes;
        return view('user.attributeview', compact('attributes'))->with($this->data);
        // echo 1;
    }

    public function getlayoutattribute($pid,$lid,$aid) 
    {
        $this->data['project_id'] = $pid;
        $this->data['layout_id'] = $lid;
        $attribute = Attributes::find($aid);
        return view('user.layoutattributeview', compact('project_id','layout_id','attribute'))->with($this->data);
        
    }


    public function editattribute(Request $request) 
    {
        if(!\Auth::user())
        {
            return \Redirect::to('/')->send();
        }
    
        if(isset($_POST['pid']) && $_POST['pid'] != '') 
        {
            $layouttheme = Pro_layoutthemes::where('project_id', $request->pid)->where('layout_id',$request->layout_id)->where('attribute_id',$request->attribute_id)->first();
            $layouttheme->theme_id = $request->theme_id;
            $layouttheme->updated_at = date("Y-m-d H:i:s");
            $layouttheme->save();
        }
        
        \Session::flash('active_id', '#design9');
        return redirect(url('project/edit/' . $request->pid));
    }


    public function addprojectxmldetail(Request $request) {

        $projectxml = new Projectxmldetail();

        $projectxmldetail = $projectxml->where('project_id', $request->pid)->first();
        if (count($projectxmldetail) == 0) {
            $projectxmldetail = new Projectxmldetail();
        }

        $projectxmldetail->project_id = $request->pid;
        $projectxmldetail->player_position = $request->player_position;
        $projectxmldetail->player_rotation = $request->player_rotation;
        $projectxmldetail->target_position = $request->target_position;
        $projectxmldetail->start_value = $request->start_value;
        $projectxmldetail->min_zoom = $request->min_zoom;
        $projectxmldetail->max_zoom = $request->max_zoom;
        $projectxmldetail->collider_position = $request->collider_position;
        $projectxmldetail->collider_rotation = $request->collider_rotation;
        $projectxmldetail->no_of_cameras = $request->no_of_cameras;
        $projectxmldetail->camera_position = $request->camera_position;
        $projectxmldetail->camera_rotation = $request->camera_rotation;
        $projectxmldetail->asset_name = $request->asset_name;
        $projectxmldetail->set_no = $request->set_no;
        $projectxmldetail->theme_no = $request->theme_no;
        $projectxmldetail->asset_position = $request->asset_position;
        $projectxmldetail->asset_rotaion = $request->asset_rotaion;

        $projectxmldetail->save();
        return redirect(url('admin/project/view/' . $request->pid));
    }

    public function projectstatusupdate(Request $request) {

        $project = Project::find($request->pid);
        $project->status = $request->status;

        $project->save();
        return redirect(url('admin/project/view/' . $request->pid));
    }

    public function addassetbundle(Request $request) {

        $version = $request->version;
        $type = $request->type;
        $pid = $request->pid;

        if ($request->hasFile('bundle')) {

            $bundle = new Assetsbundle();
           // $file = Input::file('bundle');
             
            $s3 = \App::make('aws')->createClient('s3');
           $result= $s3->putObject(array(
                'Bucket'     => 'cubedots',
                'Key'        => 'asset_bundle/'.time().$_FILES["bundle"]['name'],
                'SourceFile'   => $_FILES["bundle"]['tmp_name'],               
                'ACL'          => 'public-read',
                'StorageClass' => 'REDUCED_REDUNDANCY'
            ));
            
            $link = $result['ObjectURL'];
            
            $size =$_FILES["bundle"]['size'];
            //print_r($result);
            //die;
            //getting timestamp
            $timestamp = time();
            //$name = $timestamp . '-' . $file->getClientOriginalName();
            $bundle->user_id = \Auth::user('admin')->id;
            $bundle->project_id = $pid;
            $bundle->bundle_version = $version;
            $bundle->platform_type = $type;
            $bundle->bundle_link = $link;
            $bundle->bundle_size = $size;
            //$file->move(public_path() . '/project_files/', $name);
            $bundle->save();
        }

        return redirect(url('admin/project/view/' . $request->pid));
    }

    public function upload(Request $request) 
    {
        if($request->hasFile('file')) 
        {
            $file = Input::file('file');
            if($request->files->get('file')->getMimeType()== "image/jpeg")
            {
                $timestamp = time();
                $name = $timestamp . '-' . $file->getClientOriginalName();
                //$file->move(public_path() . '/project_images/', $name);
               
                if($request->category==2)
                {
                    list($width, $height) = getimagesize(Input::file('file'));
                    if($width>$height)
                    {
                        $size=$height;
                    }
                    else if($height>$width)
                    {
                        $size=$width;
                    } 
                    else
                    {
                       $size=$width; 
                    }
                    $img = Image::make($file->getRealPath()); // use this if you want facade style code
                    $img->fit(intval($size),intval($size));
                    $img->save(public_path('project_images'). '/'. $name);
                    if($request->type == 0) 
                    {
                        compressImage($request->files->get('file')->getPathName(),public_path('project_images'). '/'. $name, 50);
                    }

                }
                else if($request->category==8)
                {
                    list($width, $height) = getimagesize(Input::file('file'));
                    if($width != 2*$height)
                    {
                        $width=2*$height;
                    }
                
                    $img = Image::make($file->getRealPath()); // use this if you want facade style code
                    $img->fit(intval($width),intval($height));
                    $img->save(public_path('project_images'). '/'. $name);
                    if($request->type == 0) 
                    {
                         compressImage($request->files->get('file')->getPathName(),public_path('project_images'). '/'. $name, 50);
                    }


                }
                else
                {
                    list($width, $height) = getimagesize(Input::file('file'));
                    $height=$width*(9/16);
                    $img = Image::make($file->getRealPath()); // use this if you want facade style code
                    $img->resize($width,$height);
                    $img->save(public_path('project_images'). '/'. $name);
                    if($request->type == 0) 
                    {
                        compressImage($request->files->get('file')->getPathName(),public_path('project_images'). '/'. $name, 50);
                    }


                }
                
                $projectimage = new Projectimage();
                $projectimage->project_id = $request->pid;
                $projectimage->img_category_id = $request->category;
                $projectimage->type = $request->type;
                $projectimage->image = $name;
                $projectimage->save();
                $str = '';
                $imagecategories = Projectimage::where('project_id', $request->pid)->where('type', $request->type)->where('img_category_id', $request->category)->get();
                $imgcount = 5;
                $swipe='swipe';
                if ($request->category == 1 || $request->category == 2){
                    $imgcount = 1;$swipe='noswipe';
                }
                    $last_image_id=0;
                    foreach($imagecategories as $image) 
                    {
                        $imgpath = url("project_images/" . $image->image);

                        $str .='<div class="col-md-4 '.$swipe.'" id="' . $image->id . '" style="padding-top:15px;">
                                   <div class="fileinput fileinput-new">
                                    <div class="fileinput-preview thumbnail">
                                        <img src="' . $imgpath . '">
                                       </div>
                                       <div>
                                       <a href="javascript:void(0)" class="btn btn-danger" onClick="removeimage(' . $image->id . ');">Remove</a>
                                       </div>
                                    </div>
                                </div>';
                        $last_image_id= $image->id;      
                    }

                    $typ = '';
                    $paneldiv = '';
                    if ($request->type == 0) {
                        $typ = '_p';
                        $paneldiv = 'home' . $request->category;
                    }
                    if ($request->type == 1) {
                        $typ = '_t';
                        $paneldiv = 'profile' . $request->category;
                    }
                    if ($request->type == 2) {
                        $typ = '_d';
                        $paneldiv = 'messages' . $request->category;
                    }

                    if(count($imagecategories) < $imgcount) 
                    {
                        

                        $str .='<div class="col-sm-4" style="padding-top:15px;">
                                <div  class="drag-and-drop-zone uploader graphicassets '.str_replace(' ', '_',$request->catname).$typ . '" id="' .str_replace(' ', '_',$request->catname).$typ . '" catname="'.$request->catname.'" cat="' . $request->category. '" typ="' . $request->type . '" pid="' . $request->pid . '" paneldiv="' . $paneldiv . '">
                                    <div>Drag &amp; Drop Images Here</div>
                                        <div class="or">-or-</div>
                                        <div class="browser">
                                          <label>
                                            <span>Select Image</span>
                                            <input type="file" name="'.str_replace(' ', '_',$request->catname).$typ.'"  accept="image/jpeg"  title="Click to add Images">
                                          </label>
                                        </div>
                                      </div>
                                      <div style="display: none;" class="progressbar_'.str_replace(' ', '_',$request->catname).$typ.'">   
                                    </div>
                                </div>';
                    }


                return response()->json(array('success' => true,'str' => $str,'last_image_id'=>$last_image_id, 'total' => count($imagecategories)), 200);
            
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

 
    public function addfile(Request $request) 
    {

        if (!\Auth::user('admin')) {
            return \Redirect::to('/')->send();
        }
        $user = Admin::find(\Auth::user('admin')->id);
        $projectfiles = new Projectfiles();
        $projectfiles->project_id = $request->pid;
        $projectfiles->user_id = $user->id;
        $projectfiles->title = $request->title;
        $name = '';
        if ($request->hasFile('file')) {
            $file = Input::file('file');
            //getting timestamp
            $timestamp = time();
            $name = $timestamp . '-' . $file->getClientOriginalName();

            $projectfiles->file = $name;

            $file->move(public_path() . '/project_files/', $name);
        }

        $projectfiles->save();
        return redirect(adminurl('project/view/' . $request->pid));
    }

    public function projectfile_delete($id, $pid) {
        $projectfile = Projectfiles::findOrFail($id);
        $projectfile->delete();
        return redirect(adminurl('project/view/' . $pid))->with('message', 'Projectfile deleted successfully.');
    }
    public function assets_delete($id, $pid) {
        $projectfile = Assetsbundle::findOrFail($id);
        $projectfile->delete();
        return redirect(adminurl('project/view/' . $pid))->with('message', 'Assets bundle deleted successfully.');
    }

    public function complete_task($pid) {

        $project = Project::find($pid);
        $projectsteps = Projectsteps::where('project_id', $pid)->where('step', $project->status)->first();
        $projectsteps->completed = 1;
        $projectsteps->completed_by = \Auth::user('admin')->id;
        $projectsteps->completed_dt = date("Y-m-d H:i:s");
        $projectsteps->save();

        $admin = Admin::where('is_main', 1)->first();
        $email = $admin->email;
        $subject = "Complete task";
        $headers = "From: test@test.com"; // remove space      
        $message = $project->title . " Task Completed successfully."; // no intendation
        $mail = mail($email, $subject, $message, $headers);

        return redirect(adminurl('project/view/' . $pid))->with('message', 'Task Completed successfully.');
    }

    public function approve_task($pid) {

        $project = Project::find($pid);
        $projectsteps = Projectsteps::where('project_id', $pid)->where('step', $project->status)->where('completed', 1)->first();
        $projectsteps->approved = 1;
        $projectsteps->approved_by = \Auth::user('admin')->id;
        $projectsteps->approved_dt = date("Y-m-d H:i:s");
        $projectsteps->save();
        $department = new Departments();
        $depart_detail = $department->getnextdepartment($project->status);
        if ($depart_detail) {
            $project->status = $depart_detail->id;
        } else {
        $project->is_completed = 1;    
        $user = User::find($project->user_id);
        $subject = "Complete Project";
        $headers = "From: test@test.com"; // remove space      
        $message = $project->title . "Completed successfully.";
        $mail = mail($user->email, $subject, $message, $headers);
        }
        $project->save();

        $admin = Admin::where('id', $projectsteps->completed_by)->first();
        $email = $admin->email;
        $subject = "Approve task";
        $headers = "From: test@test.com"; // remove space      
        $message = $project->title . "Task Approved successfully."; // no intendation
        $mail = mail($email, $subject, $message, $headers);
        return redirect(adminurl('project/view/' . $pid))->with('message', 'Task Approved successfully.');
    }

    public function zipFileDownload($id) {
        $project = Project::findOrFail($id);
        $renderimages = $project->renderimages()->get();

        $zipname = 'renderimages-' . $id . '.zip';
        $zip = new ZipArchive;
        $zip->open($zipname, ZipArchive::CREATE);
        foreach ($renderimages as $file) {
            $zip->addFile($_SERVER['DOCUMENT_ROOT'] . '/project_images/render_images/' . $file->image, $file->image);
        }
        $zip->close();

        ///Then download the zipped file.
        header('Content-Type: application/zip');
        header('Content-disposition: attachment; filename=' . $zipname);
        header('Content-Length: ' . filesize($zipname));
        readfile($zipname);
    }

    public function zipFileEmail($id) {
        $project = Project::findOrFail($id);
        $renderimages = $project->renderimages()->get();

        $zipname = 'renderimages-' . $id . '.zip';
        $zip = new ZipArchive;
        $zip->open($zipname, ZipArchive::CREATE);
        foreach ($renderimages as $file) {
            $zip->addFile($_SERVER['DOCUMENT_ROOT'] . '/project_images/render_images/' . $file->image, $file->image);
        }
        $zip->close();

        ///Then download the zipped file.
        //header('Content-Type: application/zip');
        // header('Content-disposition: attachment; filename=' . $zipname);
        //  header('Content-Length: ' . filesize($zipname));
        // readfile($zipname);

        $email = \Auth::user()->email;
        $subject = "Render Images - " . $id;

        $headers = "From: test@test.com"; // remove space
        /* Generate boundary string */
        $random = md5(time());
        $headers .= "\r\nContent-Type: multipart/mixed; boundary=\"PHP-mixed-" . $random . "\""; // : to =
        /* Read the file */
        $attachment = chunk_split(base64_encode(file_get_contents($zipname)));
        /* Define body */
        $message = "--PHP-mixed-$random
                    Content-Type: text/plain; charset=\"iso-8859-1\"

                    Attached, please find project render images. 

                    --PHP-mixed-$random
                    Content-Type: application/zip; name=$zipname
                    Content-Transfer-Encoding: base64
                    Content-Disposition: attachment

                    $attachment

                    --PHP-mixed-$random--"; // no intendation
        $mail = mail($email, $subject, $message, $headers);
        return redirect(url("project/edit/" . $id));
    }

    public function project_publish($id, $status,$agree) 
    {

        $project = Project::find($id);
        $image_name=strtolower(substr($project->title, 0, 1)).".jpg";
        if(count($project->featuredimages()) > 0 && count($project->thumbnails()) > 0 && $agree==0)
        {
            $project->is_submitted = $status;
            $project->dummy_image_agree = 0;
            $project->save();
            $settings = \App\Settings::findOrfail(1);  
            $subject = "New Project";
            $headers = "From: ".$settings->admin_email; // remove space      
            $message = "New project has been created";
            $mail = mail($settings->admin_email, $subject, $message, $headers);
            return response()->json(array('success' => true), 200);
        }
        else if(count($project->featuredimages()) == 0 && count($project->thumbnails()) == 0 && $agree==1)
        {
            $project->is_submitted = $status;
            $project->dummy_image_agree = 1;
            $project->save();
            
            //Set dummy featured image 
            $projectimage = new Projectimage();
            $projectimage->project_id = $id;
            $projectimage->img_category_id = 1;
            $projectimage->type = 0;
            $projectimage->image = $image_name;
            $projectimage->save();

            $projectimage = new Projectimage();
            $projectimage->project_id = $id;
            $projectimage->img_category_id = 1;
            $projectimage->type = 1;
            $projectimage->image = $image_name;
            $projectimage->save();

            $projectimage = new Projectimage();
            $projectimage->project_id = $id;
            $projectimage->img_category_id = 1;
            $projectimage->type = 2;
            $projectimage->image = $image_name;
            $projectimage->save();

            //Set dummy thumbnail image
            $projectimage = new Projectimage();
            $projectimage->project_id = $id;
            $projectimage->img_category_id = 2;
            $projectimage->type = 0;
            $projectimage->image = $image_name;
            $projectimage->save();

            $projectimage = new Projectimage();
            $projectimage->project_id = $id;
            $projectimage->img_category_id = 2;
            $projectimage->type = 1;
            $projectimage->image = $image_name;
            $projectimage->save();

            $projectimage = new Projectimage();
            $projectimage->project_id = $id;
            $projectimage->img_category_id = 2;
            $projectimage->type = 2;
            $projectimage->image = $image_name;
            $projectimage->save();


            $settings = \App\Settings::findOrfail(1);  
            $subject = "New Project";
            $headers = "From: ".$settings->admin_email; // remove space      
            $message = "New project has been created";
            $mail = mail($settings->admin_email, $subject, $message, $headers);
            return response()->json(array('success' => true), 200);
        }
        else
        {
             return response()->json(array('success' => false, 'msg' =>'Featured Image and Thumbnail Image null,If you are agree then we use dummy images ?'), 200);
        }
        
    }

    public function gettransferpro($rid) {
        $transfer_project = Transfer_project::find($rid);
        $project = Project::find($transfer_project->project_id);
        $user = User::find($project->user_id);
        return view('user.modal_transferproject', compact('project', 'user', 'transfer_project'))->with($this->data);
    }

    public function submit_transfer(Request $request) {
        if (isset($_POST['accept'])) {
            $project = Project::find($request->pid);
            $project = Project::find($request->pid);
            $transfer_project = Transfer_project::find($request->rid);
            $transfer_project->status = 1;
            $transfer_project->reciever_id = \Auth::user()->id;
            $transfer_project->save();
            $project->user_id = \Auth::user()->id;
            $project->save();
        }
        if (isset($_POST['reject'])) {
            $project = Project::find($request->pid);
            $transfer_project = Transfer_project::find($request->rid);
            $transfer_project->status = 2;
            $transfer_project->reciever_id = \Auth::user()->id;
            $transfer_project->save();
        }
        return redirect(url('home'));
    }

    public function upload_xml(Request $request) {

        if ($request->hasFile('file')) {
           // $file = Input::file('file');
           // $timestamp = time();
           // $name = $timestamp . '-' . $file->getClientOriginalName();
           // $file->move(public_path() . '/project_files/', $name);
            
               
            $s3 = \App::make('aws')->createClient('s3');
           $result= $s3->putObject(array(
                'Bucket'     => 'cubedots',
                'Key'        => 'xml/'.time().$_FILES["file"]['name'],
                'SourceFile'   => $_FILES["file"]['tmp_name'],               
                'ACL'          => 'public-read',
                'StorageClass' => 'REDUCED_REDUNDANCY'
            ));
            
            $link = $result['ObjectURL'];
            $projectlayouts = Projectlayouts::find($request->id);
            $projectlayouts->xml_file = $link;
            $projectlayouts->save();
            $str = '<div class="form-group">
                    <label class="col-sm-2 control-label" for="inputEmail3">' . $link . '</label> 
                    <div class="col-sm-8">
                        <label class="col-sm-6 control-label" for="inputEmail3"><a href="' . $link . '" class="btn btn-primary">Download</a></label>
                    </div>
                </div>';
            return response()->json(array('str' => $str), 200);
        } else {
            return response()->json(false, 200);
        }
    }
    
    public function downloadasset(Request $request,$id)
    {
        $bundle=  Assetsbundle::find($id);
        
        $headers=array('Content-Length'=>filesize(assetbundlepath($bundle->bundle_link)));
        return \Response::download(assetbundlepath($bundle->bundle_link), $bundle->bundle_link, $headers);
        
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
            $dregimg = Projectimage::where('id', $request->dragimg_id)->first();
            $dregimg->image = $dropimg_name[4];
            $dregimg->updated_at = date("Y-m-d H:i:s");
            $dregimg->save();

            //Drop Image
            $dragimg_name= explode("/",$request->dragimg_name);
            $dropimg = Projectimage::where('id', $request->dropimg_id)->first();
            $dropimg->image = $dragimg_name[4];
            $dropimg->updated_at = date("Y-m-d H:i:s");
            $dropimg->save();
        }

        return response()->json(array('success' => true), 200);
    }

    public function redirectplaystore($id) 
    {
        
        $agent = new Agent();
        if($agent->device()=='iPhone' || $agent->device()=='iPad')
        {
            return redirect('https://www.google.co.in/');
        }
        else
        {
            return redirect('https://play.google.com/store/apps/details?id=com.CubeDots.KanakiaParis&hl=en');    
        }
        
    } 

    public function clicklayout($pid,$lid) 
    {
        $project = Project::findOrFail($pid);
        $projectlayouts = $project->projectlayouts;
        //echo "<pre>";
        //print_r($projectlayouts);die();
        foreach($projectlayouts as $projectlayout)
        {
            if($projectlayout->id==$lid)
            {
                $details = User::where('id', $project->user_id)->first();
                $dst = public_path().'/' . $details['firstname']."_".$details['id'];
                /* Usage */
                $myfile = fopen($dst."/StreamingAssets/TestJson.json", "w") or die("Unable to open file!");
                //$txt = "{user_name :'".$row['user_name']."'}\n";
                $txt=$projectlayout->layoutjson;
                fwrite($myfile, $txt);
                fclose($myfile);
                if($projectlayout->id) 
                { 
                    $response = array('status' => 1, 'data' =>'Your project json  has been write successfully.');
                }
                else 
                {
                    $response = array('status' => 0, 'data' => 'Please try again!');
                }

            }
        }
        return response()->json($response);
    }
    
}
