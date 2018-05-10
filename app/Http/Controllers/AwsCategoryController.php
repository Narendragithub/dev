<?php
namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Aws_category;
use Illuminate\Http\Request;
class AwsCategoryController extends Controller {

    var $data = null;

    public function __construct() {
        if(!\Auth::user('admin')){
            return \Redirect::to('/admin/login')->send();
        }
        $this->middleware('admin2fa', ['except' => 'getLogout']);
        $this->data['active'] = 'awscategories';
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
    public function index(Request $request) {

            $awsfiles='';
            $prefix='';
            
            $filterarray=array('Bucket' => 'cubedots');
            if($request->dir){
            		$filterarray['Prefix']=$request->dir;
            		$prefix=$request->dir;
            }
    
        	//$s3Client = S3Client::factory(array('key' => $access, 'secret' => $secret));
        	$s3Client = \App::make('aws')->createClient('s3');
        	$response = $s3Client->listObjects($filterarray);
        	$files = $response->getPath('Contents');
        	$request_id = array();
        	$allfiles = array();
        	if($files){
        	foreach ($files as $file) {
        		$filename = $file['Key'];
        		//print "\n\nFilename:". $filename;
        		$path = explode("/", $filename);
    	        $path = array_filter($path);
    	        $lastElement = end($path);
    	
    	        //reset pointer
    	        $cur = &$allfiles;
    	
    	        $count = count($path);
    	
    	        //set pointer to proper parent folder
    	        for ($i = 0; $i < $count - 1; $i++) {
    	            $cur = &$cur[$path[$i]];
    	        }
    	
    	        //add file
    	        $cur[] = $path[$i];
    	   }
    	}
    	unset($cur);
    	
    	$breadcrumb=array();
    	//print_r($allfiles);die();
     	if($prefix !=''){
     	    $parts = explode('/', rtrim($prefix , '/'));
            for($i=0;$i < count($parts);$i++){
                  $href=$i>0?$breadcrumb[$i-1]['href'].'/'.$parts[$i]:$parts[$i];
                  $breadcrumb[$i]=array('text'=>$parts[$i],'href'=>$href);
            }
            $awsdata=get_array_value($allfiles,$parts);
            
     		$awsfiles=$awsdata;
     	}else{
     		$awsfiles=$allfiles;
     	}
         	
         
     
        $categories = Aws_category::orderBy('id', 'desc')->paginate(10);
       
        return view('admin.awscategories.index', compact('categories','awsfiles','prefix','breadcrumb'))->with($this->data);
    }



    /**
     * Show the form for creating a new resource.
     *
     * @return Response
     */
    public function create(Request $request) {
        $prefix='';
    
    
    if($request->dir){
    		
    		$prefix=$request->dir;
    }
        $pcategories = Aws_category::all();
        return view('admin.awscategories.create', compact('pcategories','prefix'))->with($this->data);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param Request $request
     * @return Response
     */
    public function store(Request $request) {
         $path=$request->path;
        $folder='';
        //$category = new Aws_category();
        $this->validate($request, [
            'category' => 'required'
        ]);
         $category =  $request->category; 
        
        if($path==''){
           $folder = $category."/";
        }else{
           $folder= $path.'/'.$category."/";
        }
       
      
           $s3 = \App::make('aws')->createClient('s3');
           $result= $s3->putObject(array(
                'Bucket'     => 'cubedots',
                'Key'        => $folder,
                'Body'       => "",            
                'ACL'          => 'public-read',
                'StorageClass' => 'REDUCED_REDUNDANCY'
            ));
        return redirect()->route('admin.awscategories.index')->with('message', 'Item created successfully.');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return Response
     */
    public function show($id) {
        $category = Aws_category::findOrFail($id);

        return view('categories.show', compact('category'))->with($this->data);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return Response
     */
    public function edit($id) {
        $category = Aws_category::findOrFail($id);
        $pcategories = Aws_category::all();
        return view('admin.awscategories.create', compact('category','pcategories'))->with($this->data);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  int  $id
     * @param Request $request
     * @return Response
     */
    public function update($id,Request $request) {
       
        $category = Aws_category::findOrFail($id);
         $this->validate($request, [
            'category' => 'required'
        ]);
        $category->category = $request->category;
        $category->parent_id = $request->parent_id;
        $category->save();


        //$category->save();

        return redirect('/admin/awscategories')->with('message', 'Item updated successfully.');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return Response
     */
    public function delete($keyname) {

        $s3client = \App::make('aws')->createClient('s3');
        $result= $s3client->deleteObject(array(
            'Bucket' => 'cubedots',
            'Key'    => $keyname
        ));

        if(!$result){
            return redirect('/admin/awscategories')->with('error', 'Cannot delete aws category as it contains projects.');
        }else{
        
            return redirect('/admin/awscategories')->with('message', 'Aws Category deleted successfully.');
        }  
    }
  
    public function getAllParents($id, $categories = array()) {

       $mainCategory = Aws_category::findOrFail($id);
       // foreach ($result as $mainCategory) {
            $category = array();
           // $category['id'] = $mainCategory->id;
            $category['category'] = $mainCategory->category;

            //$category['parent'] = $mainCategory->parent;
            //$category['sub_category'] = $this->getCategoryTreeAPI($category['id']);

            if ($mainCategory->parent_id > 0) {
                $categories = $this->getAllParents($mainCategory->parent_id, $categories);
            }
            $categories[] = $category;
      //  }
        return $categories;
    }

    public function view_file($id) {
        $category = Aws_category::findOrFail($id);
         if($category->parent_id==0){
           $folder = $category->category."/";
        }
        else{
          $array ='';
        foreach ($this->getAllParents($category->parent_id) as $mainCategory) {
            $array .= $mainCategory['category']."/";
        }    
        $folder = $array.$category->category."/";   
        }
        
        $s3Client = \App::make('aws')->createClient('s3');
        $response = $s3Client->listObjects(array('Bucket' => 'cubedots', 'MaxKeys' => 1000, 'Prefix' => $folder));
        $files = $response->getPath('Contents');
        return view('admin.awscategories.view_file', compact('files','id'))->with($this->data);
      
    }

    public function addfile_sub(Request $request) 
    {
        $id = $request->id;
        if($request->hasFile('bundle')) 
        {
            $s3 = \App::make('aws')->createClient('s3');
            $result= $s3->putObject(array(
                'Bucket'     => 'cubedots',
                'Key'        => 'level1/'.time().$_FILES["bundle"]['name'],
                'SourceFile'   => $_FILES["bundle"]['tmp_name'],               
                'ACL'          => 'public-read',
                'StorageClass' => 'REDUCED_REDUNDANCY'
            ));
        }

        return redirect(url('admin/awscategories/view_file/' . $request->id));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return Response
     */
    public function uploadefolder(Request $request) {
        
        $prefix='';
        if($request->parent){
                
            $prefix=$request->parent;
        }
        
        return view('admin.awscategories.uploade',compact('prefix'))->with($this->data);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param Request $request
     * @return Response
     */
    public function uploadestore(Request $request) 
    {
        $this->validate($request,['foldername' => 'required','folderpath'=>'required']);
        $foldername =  $request->foldername; 
        $folderpath=$request->folderpath;
        ini_set('max_execution_time', 3600);
        $client = \App::make('aws')->createClient('s3');
        $dir = $folderpath;
        $bucket = 'cubedots';
        $keyPrefix = $foldername;
        $options = array(
            'params'      => array('ACL' => 'public-read'),
            'concurrency' => 20,
            'debug'       => true,
            'ACL' => 'public-read'
        );

    
        if($client->uploadDirectory($dir,$bucket,$keyPrefix,$options))
        {
            return redirect()->route('admin.awscategories.index')->with('message','Folder created successfully.');    
        }
        else
        {
            return redirect()->route('admin.awscategories.index')->with('eroor','Folder Not create! Somthing went worng.');
        }
    
    }

}


