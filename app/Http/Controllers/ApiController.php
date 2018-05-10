<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Routing\Route;
use Hash;
use App\Admin;
use App\User;
use App\Userprofile;
use App\Category;
use App\Country;
use App\State;
use App\City;
use App\Project;
use App\Departments;
use App\Projectsteps;
use App\Layouts;
use App\Projectimage;
use App\Projectratings;
use App\Projectlayouts;
use App\Pro_imagecategories;
use App\Favourites;
use App\Assetsbundleplatform;
use App\Assetsbundle;
use App\Adverts;
use Autologin;

class ApiController extends Controller {

    public function __construct(){
        $this->middleware('cors');
    }
    public function index() {
        echo "Test";
    }

    public function checkemail(Request $data) {
        //$data = json_decode(file_get_contents('php://input'), true);
        $email = $data['email'];
        $user = User::where('email', $email)->first();
        if ($user) {
            $response = array('status' => 1, 'data' => $user->email);
        } else {
            $response = array('status' => 0, 'error' => 'No User with this email exist.');
        }
        return response()->json($response);
    }

    public function login(Request $data) {
        // $data = json_decode(file_get_contents('php://input'), true);
        $email = $data['email'];
        $pass = $data['password'];

        $customer = \Auth::attempt('user', ['email' => $email, 'password' => $pass]);
        if ($customer == true) {
            $details = User::where('email', $email)->first();
            $response = array('status' => 1, 'data' => $details);
        } else {
            $response = array('status' => 0, 'data' => 'Invalid email and password');
        }
        return response()->json($response);
    }

    public function register(Request $data) {
        //$data = json_decode(file_get_contents('php://input'), true);
        $existinguser = User::all()->where('email', $data['email'])->first();
        if ($existinguser) {
            $response = array('status' => 0, 'data' => 'This email has been already registered');
        } else {
            $settings = \App\Settings::findOrfail(1);
            $token = str_random(30);
            $user = new \App\User;
            $user->title = $data['title'];
            $user->firstname = $data['firstname'];
            $user->lastname = $data['lastname'];
            $user->email = $data['email'];
            $user->password = Hash::make($data['password']);
            $user->token = $token;
            $user->save();
            $profile = new Userprofile();
            $profile->user_id = $user->id;
            //$profile->address = $request->address;
            $profile->city = $data['city'];
            $profile->state = $data['state'];
            //$profile->zip = $request->zip;
            $profile->country = $data['country'];
            $profile->phone = $data['phone'];
            $profile->save();
            $verification_link = url('register/verify?token=' . encrypt($user->id . '/' . $token));
            //\Activity::log(encrypt($user->id.'/'.$token));
            $template = \App\Emailtemplates::find(1); //Welcome Email
            sendemail($user->email, $user->firstname, $user->lastname, $template, array('ACTIVATION_LINK' => $verification_link));

            $admintemplate = \App\Emailtemplates::find(4);
            sendemail($settings->admin_email, 'Admin', '', $admintemplate, array('MEMBER_EMAIL' => $user->email));
            \Session::put('newuser', 1);

            $response = array('status' => 1, 'data' => 'Register successfully');
        }
        return response()->json($response);
    }

    public function getstates() {
        $countryid = \Input::get('countryid');
        $country = Country::find($countryid);
        $states = $country->states;
        $statehtml = '<select id="state" class="form-control" onchange="getcities(this.value)" name="state"> <option selected="" value="">Select State</option>';

        foreach ($states as $state) {
            $statehtml.= '<option value=' . $state->id . '>' . $state->name . '</option>';
        }
        $statehtml.='</select>';
        $response = array('status' => 1, 'statehtml' => $statehtml);
        return response()->json($response);
        die;
    }

    public function getcities() {
        $stateid = \Input::get('stateid');
        $states = State::find($stateid);
        $cities = $states->cities;
        $cityhtml = '<select id="city" class="form-control" name="city"> <option selected="" value="">Select City</option>';

        foreach ($cities as $city) {
            $cityhtml.= '<option value=' . $city->id . '>' . $city->name . '</option>';
        }
        $cityhtml.='</select>';
        $response = array('status' => 1, 'cityhtml' => $cityhtml);
        return response()->json($response);
        die;
    }

    public function projectlist(Request $data) {
        //$data = json_decode(file_get_contents('php://input'), true);
        $projectlist = array();
        $user_id = $data['user_id'];
        if (isset($data['type'])) {
            $type = $data['type'];
        } else {
            $type = 0;
        }
        if ($type == 0) {
            if ($user_id > 0) {
                if (isset($data['category_id']) && $data['category_id'] > 0) {
                    $category_id = $data['category_id'];
                    $projects = Project::where('user_id', $user_id)->where('category_id', $category_id)->where('is_public', 0)->get();
                } else {
                    $projects = Project::where('user_id', $user_id)->where('is_completed', 1)->where('is_public', 0)->get();
                }
            } else {
                if (isset($data['category_id']) && $data['category_id'] > 0) {
                    $category_id = $data['category_id'];
                    $projects = Project::where('category_id', $category_id)->where('is_completed', 1)->where('is_public', 0)->get();
                } else {
                    $projects = Project::where('is_completed', 1)->where('is_public', 0)->get();
                }
            }
        } else {
            //$type = $type-1;
            if ($user_id > 0) {
                if (isset($data['category_id']) && $data['category_id'] > 0) {
                    $category_id = $data['category_id'];
                    $projects = Project::where('user_id', $user_id)->where('category_id', $category_id)->where('premium_service', $type)->where('is_public', 0)->get();
                } else {
                    $projects = Project::where('user_id', $user_id)->where('premium_service', $type)->where('is_completed', 1)->where('is_public', 0)->get();
                }
            } else {

                if(isset($data['category_id']) && $data['category_id'] > 0) {
                    $category_id = $data['category_id'];
                    $projects = Project::where('category_id', $category_id)->where('premium_service', $type)->where('is_completed', 1)->where('is_public', 0)->get();
                }else{
                    $projects = Project::where('premium_service', $type)->where('is_completed', 1)->where('is_public', 0)->get();
                }
            }
        }
        if (count($projects) > 0) {
            foreach ($projects as $project) {

                $user = User::find($project->user_id);
                $featuredimages = array();
                $featured = $projectimages = $project->projectimages()->where('img_category_id', 1)->get();
                if (count($featured) > 0) {
                    foreach ($featured as $image) {
                        if ($image->type == 0) {
                            if ($image->image) {
                                $featuredimages['Phone'] = url('project_images') . "/" . $image->image;
                            } else {
                                $featuredimages['Phone'] = url('html/img/blank.png ');
                            }
                        }
                        if ($image->type == 1) {
                            if ($image->image) {
                                $featuredimages['Tablet'] = url('project_images') . "/" . $image->image;
                            } else {
                                $featuredimages['Tablet'] = url('html/img/blank.png ');
                            }
                        }
                        if ($image->type == 2) {
                            if ($image->image) {
                                $featuredimages['Desktop'] = url('project_images') . "/" . $image->image;
                            } else {
                                $featuredimages['Desktop'] = url('html/img/blank.png ');
                            }
                        }
                    }
                } else {
                    $featuredimages['Phone'] = url('html/img/blank.png ');
                    $featuredimages['Tablet'] = url('html/img/blank.png ');
                    $featuredimages['Desktop'] = url('html/img/blank.png ');
                }
                $projectlist[] = array('Pid' => $project->id, "ProjectTitle" => $project->title, 'SubscriberName' => $user->firstname . " " . $user->lastname, 'ImageURL' => $featuredimages, 'Type' => $project->premium_service == 0 ? 'Free' : 'Premium','Alias'=>$project->alias);
            }
            $response = array('status' => 1, 'Projects' => $projectlist);
        } else {
            $response = array('status' => 0, 'message' => "project not available");
        }

        echo json_encode($response);
    }

    public function projectdetail(Request $data) {
        //$data = json_decode(file_get_contents('php://input'), true);
        $user_id = $data['user_id'];
        $project_id = $data['project_id'];
        $projectlist = array();
        $projectimage = array();
        if ($user_id > 0) {
            $project = Project::where('id', $project_id)->where('user_id', $user_id)->first();
        } else {
            $project = Project::where('id', $project_id)->first();
        }
        if (count($project) > 0) {
            $user = User::find($project->user_id);

            $profile = Userprofile::where('user_id', $user->id)->first();
            // $images = Projectimage::where('project_id', $project->id)->get();
            // foreach ($images as $image) {
            //    $projectimage[] = url('project_images') . "/" . $image->image;
            // }
            $imagecategories = Pro_imagecategories::all();

            foreach ($imagecategories as $imagecategory) {
                $projectimage1 = array();
                $projectimages = $project->projectimages()->where('img_category_id', $imagecategory->id)->get();
                foreach ($projectimages as $image) {
                    $projectimage1[] = url('project_images') . "/" . $image->image;
                }
                $name = Ucfirst($imagecategory->category) . "Images";
                $projectimage[$name] = $projectimage1;
            }

            //$projectimages = implode(",",$projectimage );
            //$projectimages = json_encode($projectimage);

            $category = Category::find($project->category_id);

            $avr_rating = 0;
            $rating = 0;
            $projectratings = $project->projectratings($project->id)->get();

            if (count($projectratings) > 0) {
                foreach ($projectratings as $projectrating) {
                    $avr_rating = $avr_rating + $projectrating->rating;
                }
                $rating = $avr_rating / count($projectratings);
            }

            $projectlist = array(
                "Pid" => $project->id,
                "ProjectTitle" => $project->title,
                "ShortDescription" => $project->short_description,
                "Description" => $project->description,
                "SiteLocation" => $project->location,
                "Website" => $project->website,
                "Email" => $project->email,
                "Phone" => $project->phone,
                "Category" => $category->category,
                "FeaturedImageURL" => url('project_images') . "/" . $project->featured_image,
                "DisplayImages" => $projectimage,
                "EBrochure" => $project->brochure_link,
                "ProjectThumbnail" => url('project_images') . "/thumbnail/" . $project->project_thumb,
                "PremiumService" => $project->premium_service,
                // "NumberOfLayouts" => $project->no_of_layouts,
                // "LayoutID" => $project->layout_id,
                //Builder Information
                "SubscriberName" => $user->firstname . " " . $user->lastname,
                "SubscriberOfficeAddress" => $project->location,
                "SubscriberEmailAddress" => $user->email,
                "SubscriberWebsite" => $project->website,
                "SubscriberPhone" => $project->phone,
                //Asset Bundle Information
                //This will only be for "Premium Service" (Not for Free service)
                "AssetBundleLink" => assetbundlepath($project->bundle_link),
                "AssetBundleVersion" => $project->bundle_version,
                "XMLLink" => $project->xml_link,
                "UpdatedOn" => $project->updated_on,
                //Download size in MegaBytes
                "DownloadSize" => $project->download_size,
                "Rating" => $rating
            );

            $response = array('status' => 1, 'Projects' => $projectlist);
        } else {
            $response = array('status' => 0, 'message' => "project not available");
        }
        echo json_encode($response);
    }

    public function change_password(Request $data) 
    {
        //$data = json_decode(file_get_contents('php://input'), true);
        $user_id = $data['user_id'];
        $old_password = $data['old_password'];
        $new_password = $data['new_password'];
        $user = User::where('id', $user_id)->first();
        $checkpassword = Hash::check($old_password,$user->password);
        // Validate the new password length...
        if($checkpassword) 
        {
            $user->password = Hash::make($new_password);
            $user->save();
            $response = array('status' => 1, "success" => true, "message" => "You password has been changed successfully");
        
        }else{

            $response = array('status' => 0, "success" => false, "message" => "Your current password is wrong");
        }
        echo json_encode($response);
    }

    public function forgot_password(Request $data) {

        //$data = json_decode(file_get_contents('php://input'), true);
        $email = $data['email'];
        $user = User::where('email', $email)->first();
        if ($user) {
            $password = rand(100000, 999999);
            $user->password = Hash::make($password);
            $user->save();
            $to = $email;
            $mailheader = "From: noreply@example.com\r\n";
            $mailheader .= "Content-type: text/html; charset=iso-8859-1\r\n";
            $MESSAGE_BODY = 'Dear Sir/Madam,<br /> Your new password is ' . $password . ' .<br /> Now you can login by using this password and you can change your password after logging in.<br /><br /> Thankyou';
            $EmailSubject = 'Reset password';

            mail($to, $EmailSubject, $MESSAGE_BODY, $mailheader) or die("Failure");
            $response = array('status' => 1, "message" => "E-mail sent on your registered email.");
        } else {
            $response = array('status' => 0, "message" => "Email id does not exist");
        }
        echo json_encode($response);
    }

    public function verify(Request $request) {
        $verifyuser = decrypt($request->token);
        $pos = strpos($verifyuser, '/');
        $id = substr($verifyuser, 0, $pos);
        $token = substr($verifyuser, $pos + 1);

        $authuser = \App\User::where('id', $id)->where('token', $token)->first();

        if ($authuser) {
            $authuser->verified = 1;
            $authuser->save();
            $response = array('status' => 1, "message" => "Your account has been verified successfully.");
        } else {

            $response = array('status' => 0, "message" => "Account not verified.");
        }
        echo json_encode($response);
    }

    public function projectbasic(Request $data) 
    {
         $project_id = $data['project_id'];     
         $details =$this->getprojectbasic($project_id);
         if($details){         
            $response = array('status' => 1, 'Projects' => $details);
         }
         else{       
            $response = array('status' => 0, 'message' => "project not available");
         }
          echo json_encode($response);
    }

    public function getprojectbasic($project_id) 
    {
        //$data = json_decode(file_get_contents('php://input'), true);
        //$project_id = $data['project_id'];
        $projectlist = array();
        $projectimage = array();
        $category_name = '';
        $project = Project::where('id', $project_id)->first();
        if(count($project) > 0){

            $user = User::find($project->user_id);
            if($project->category_id > 0) {

                $category = Category::find($project->category_id);
                $category_name = $category->category;
            }

            $avr_rating = 0;
            $rating = 0;
            $projectratings = $project->projectratings($project->id)->get();
            if(count($projectratings) > 0) {
                foreach ($projectratings as $projectrating) {
                    $avr_rating = $avr_rating + $projectrating->rating;
                }
                $rating = $avr_rating / count($projectratings);
                $rating = $avr_rating / count($projectratings);
            }

            $featuredimages = array();
            $featured = $projectimages = $project->projectimages()->where('img_category_id', 1)->get();
            if(count($featured) > 0) {

                foreach ($featured as $image) {
                    if ($image->type == 0) {
                        if ($image->image) {
                            $featuredimages['Phone'] = url('project_images') . "/" . $image->image;
                        } else {
                            $featuredimages['Phone'] = url('html/img/blank.png ');
                        }
                    }
                    if ($image->type == 1) {
                        if ($image->image) {
                            $featuredimages['Tablet'] = url('project_images') . "/" . $image->image;
                        } else {
                            $featuredimages['Tablet'] = url('html/img/blank.png ');
                        }
                    }
                    if ($image->type == 2) {
                        if ($image->image) {
                            $featuredimages['Desktop'] = url('project_images') . "/" . $image->image;
                        } else {
                            $featuredimages['Desktop'] = url('html/img/blank.png ');
                        }
                    }
                }

            } else {
                $featuredimages['Phone'] = url('html/img/blank.png ');
                $featuredimages['Tablet'] = url('html/img/blank.png ');
                $featuredimages['Desktop'] = url('html/img/blank.png ');
            }
            $thumbnailimages = array();
            $thumbnails = $projectimages = $project->projectimages()->where('img_category_id', 2)->get();
            if (count($thumbnails) > 0) {
                foreach ($thumbnails as $image) {
                    if ($image->type == 0) {
                        if ($image->image) {
                            $thumbnailimages['Phone'] = url('project_images') . "/" . $image->image;
                        } else {
                            $thumbnailimages['Phone'] = url('html/img/blank.png ');
                        }
                    }
                    if ($image->type == 1) {
                        if ($image->image) {
                            $thumbnailimages['Tablet'] = url('project_images') . "/" . $image->image;
                        } else {
                            $thumbnailimages['Tablet'] = url('html/img/blank.png ');
                        }
                    }
                    if ($image->type == 2) {
                        if ($image->image) {
                            $thumbnailimages['Desktop'] = url('project_images') . "/" . $image->image;
                        } else {
                            $thumbnailimages['Desktop'] = url('html/img/blank.png ');
                        }
                    }
                }
            } else {
                $thumbnailimages['Phone'] = url('html/img/blank.png ');
                $thumbnailimages['Tablet'] = url('html/img/blank.png ');
                $thumbnailimages['Desktop'] = url('html/img/blank.png ');
            }
            $featurethumb = '';

            if ($project->featured_video) 
            {
                if(stripos($project->featured_video,'watch?v='))
                {
                    $youtube = explode("watch?v=", $project->featured_video);    
                }
                else
                {
                    $youtube = $project->featured_video;
                }
                
                $featurethumb = "https://img.youtube.com/vi/" . $youtube[1] . "/default.jpg";
            }
            $projectlist = array(
                "Pid" => $project->id,
                "ProjectTitle" => $project->title,
                "ShortDescription" => $project->short_description,
                "SiteLocation" => $project->location,
                "Website" => $project->website,
                "Email" => $project->email,
                "Phone" => $project->phone,
                "Category" => $category_name,
                "FeaturedImageURL" => $featuredimages,
                "ProjectThumbnail" => $thumbnailimages,
                "FeaturedVideoURL" => $project->featured_video,
                "VideoThumbnail" => $featurethumb,
                "EBrochure" => $project->brochure_link,
                "SubscriberName" => $user->firstname . " " . $user->lastname,
                "SubscriberOfficeAddress" => $project->address,
                "SubscriberEmailAddress" => $user->email,
                "SubscriberWebsite" => $project->website,
                "SubscriberPhone" => $project->phone,
                "Rating" => $rating,
                'Type' => $project->premium_service == 0 ? 'Free' : 'Premium',
                'Reference_link'=> url('/').'/'.$project->alias
            );
            foreach ($projectlist as $var => $val) {
                if ($val == null) {
                    $projectlist[$var] = '';
                }
            }
            return $projectlist;
            //$response = array('status' => 1, 'Projects' => $projectlist);
        } else {
            return false;
            //$response = array('status' => 0, 'message' => "project not available");
        }
        echo json_encode($response);
    }

    public function projectdescription(Request $data) {
        //$data = json_decode(file_get_contents('php://input'), true);

        $project_id = $data['project_id'];
        $projectlist = array();
        $projectimage = array();

        $project = Project::where('id', $project_id)->first();
        if (count($project) > 0) {


            $projectlist = array(
                "Description" => $project->description,
            );

            $response = array('status' => 1, 'Projects' => $projectlist);
        } else {
            $response = array('status' => 0, 'message' => "project not available");
        }
        echo json_encode($response);
    }

    public function projectassets(Request $data) {
        //$data = json_decode(file_get_contents('php://input'), true);

        $project_id = $data['project_id'];
        $projectlist = array();
        $projectimage = array();

        $project = Project::where('id', $project_id)->first();
        if (count($project) > 0) {
            $projectimage = array();
            $imagecategories = Pro_imagecategories::all();
            $assetsImages = array();
            foreach ($imagecategories as $imagecategory) {
                if ($imagecategory->id > 2) {
                    $assetsImages[ucwords($imagecategory->category)] = array();
                    $thumbnails = $projectimages = $project->projectimages()->where('img_category_id', $imagecategory->id)->get();
                    $phone = array();
                    $tablet = array();
                    $desktop = array();
                    foreach ($thumbnails as $image) {
                        if ($image->type == 0) {
                            $phone[] = url('project_images') . "/" . $image->image;
                        }
                        if ($image->type == 1) {
                            $tablet[] = url('project_images') . "/" . $image->image;
                        }
                        if ($image->type == 2) {
                            $desktop[] = url('project_images') . "/" . $image->image;
                        }
                    }
                    $assetsImages[ucwords($imagecategory->category)]['Phone'] = $phone;
                    $assetsImages[ucwords($imagecategory->category)]['Tablet'] = $tablet;
                    $assetsImages[ucwords($imagecategory->category)]['Desktop'] = $desktop;
                }
            }


            $projectassets = array();
            $assetsbundleplatform = Assetsbundleplatform::all();

            foreach ($assetsbundleplatform as $assetsbundle) {
                $assets1 = $project->projectassets()->where('platform_type', $assetsbundle->id)->first();
                $assets2 = array();

                if (count($assets1) > 0) {
                    //dd($assets1->created_at);
                    //$assets2[] = url('/project/downloadasset/' . $assets1->id);
                    $assets2[0] = assetbundlepath($assets1->bundle_link);
                    $assets2['DownloadSize'] = Human_filesize($assets1->bundle_size);
                    $assets2['UpdatedOn'] = (string)$assets1->created_at;
                   
                }

                $projectassets[ucwords($assetsbundle->name)] = $assets2;
            }

            $projectlayouts = array();
            $projectlayouts1 = $project->projectlayouts()->get();

            foreach ($projectlayouts1 as $layouts1) {
                $layout = Layouts::find($layouts1->layout_id);
                $layouts2 = array();
                if ($layouts1->xml_file) {
                    $layouts2[] = assetbundlepath($layouts1->xml_file);
                }
                $projectlayouts[ucwords($layout->name)] = $layouts2;
            }

            $projectlist = array(
                "DisplayImages" => $assetsImages,
                "EBrochure" => $project->brochure_link,
                "AssetBundleLink" => $projectassets,
                // "AssetBundleVersion" => $project->bundle_version,
                "XMLLink" => $projectlayouts
               
            );

            $response = array('status' => 1, 'Projects' => $projectlist);
        } else {
            $response = array('status' => 0, 'message' => "project not available");
        }
        echo json_encode($response);
    }

    public function addrating(Request $data) {

        $user_id = $data['user_id'];
        $project_id = $data['project_id'];
        $rating = $data['rating'];
        $projectrating = new Projectratings();
        $projectrating->user_id = $user_id;
        $projectrating->project_id = $project_id;
        $projectrating->rating = $rating;
        $projectrating->save();

        $response = array('status' => 1, "message" => "Rating added successfully ");

        echo json_encode($response);
    }

    public function favourite(Request $data) {

        $user_id = $data['user_id'];
        $project_id = $data['project_id'];
        $is_fav = $data['is_fav'];
        $favouritescheck = Favourites::where('user_id', $user_id)->where('project_id', $project_id)->first();
        if ($is_fav == 1) {
            if (count($favouritescheck) == 0) {
                $favourites = new Favourites();
                $favourites->user_id = $user_id;
                $favourites->project_id = $project_id;
                $favourites->save();
            }
            $response = array('status' => 1, "message" => "Favourite added successfully ");
        } else {
            if (count($favouritescheck) > 0) {
                $favouritescheck->delete();
            }
            $response = array('status' => 1, "message" => "Favourite deleted successfully ");
        }
        echo json_encode($response);
    }

    public function favouritebyuser(Request $data) {

        $user_id = $data['user_id'];
        $favourites = Favourites::where('user_id', $user_id)->get();
        if (count($favourites) > 0) {
            $details =array();
            foreach($favourites as $favourite){
             
              $details[] =$this->getprojectbasic($favourite->project_id);
            }
            $response = array('status' => 1, "data" => $details, "message" => "Favourite List");
        } else {
            $response = array('status' => 0, "message" => "Not Available");
        }
        echo json_encode($response);
    }

    public function checkfavourite(Request $data) {

        $user_id = $data['user_id'];
        $project_id = $data['project_id'];
        $favouritescheck = Favourites::where('user_id', $user_id)->where('project_id', $project_id)->first();
        if (count($favouritescheck) > 0) {
            $response = array('status' => 1);
        } else {
            $response = array('status' => 0);
        }
        echo json_encode($response);
    }

     public function project_search(Request $data) {
        // $data = json_decode(file_get_contents('php://input'), true);
        $projectlist = array();
        $search_text = $data['search_text'];
    
        $projects = Project::where('title', 'like', '%' . $search_text. '%')->where('is_completed',1)->get();
          
        if (count($projects) > 0 && $search_text!=null) {
            foreach ($projects as $project) {

                $user = User::find($project->user_id);
                $featuredimages = array();
                $featured = $project->projectimages()->where('img_category_id', 1)->get();
                if (count($featured) > 0) {
                    foreach ($featured as $image) {
                        if ($image->type == 0) {
                            if ($image->image) {
                                $featuredimages['Phone'] = url('project_images') . "/" . $image->image;
                            } else {
                                $featuredimages['Phone'] = url('html/img/blank.png ');
                            }
                        }
                        if ($image->type == 1) {
                            if ($image->image) {
                                $featuredimages['Tablet'] = url('project_images') . "/" . $image->image;
                            } else {
                                $featuredimages['Tablet'] = url('html/img/blank.png ');
                            }
                        }
                        if ($image->type == 2) {
                            if ($image->image) {
                                $featuredimages['Desktop'] = url('project_images') . "/" . $image->image;
                            } else {
                                $featuredimages['Desktop'] = url('html/img/blank.png ');
                            }
                        }
                    }
                } else {
                    $featuredimages['Phone'] = url('html/img/blank.png ');
                    $featuredimages['Tablet'] = url('html/img/blank.png ');
                    $featuredimages['Desktop'] = url('html/img/blank.png ');
                }
                $projectlist[] = array('Pid' => $project->id, "ProjectTitle" => $project->title, 'SubscriberName' => $user->firstname . " " . $user->lastname, 'ImageURL' => $featuredimages, 'Type' => $project->premium_service == 0 ? 'Free' : 'Premium');
            }
            $response = array('status' => 1, 'Projects' => $projectlist);
        } else {
            $response = array('status' => 0, 'message' => "project not available");
        }

        echo json_encode($response);
    }
    
     public function social_sign_up(Request $data) {
        //$data = json_decode(file_get_contents('php://input'), true);
                $social_type= $data['social_type'];
                $userid = $data['social_id']; 
                if($social_type &&  $userid && $data['email'] && $data['firstname']){  
        $existinguser = User::all()->where('email', $data['email'])->first();
        if ($existinguser) {
            if($social_type=="fb"){  
            $existinguser->facebookid = $userid;
            }elseif($social_type=="gplus"){
            $existinguser->googleid = $userid;
            }
            $existinguser->save();
            $response = array('status' => 1, 'data' => $existinguser);
        } else {
            $settings = \App\Settings::findOrfail(1);
            $token = str_random(30);
            $user = new \App\User;
            //$user->title = $data['title'];
            $user->firstname = $data['firstname'];
            $user->lastname = $data['lastname'];
            $user->email = $data['email'];
            $user->password = Hash::make(time());
            $user->token = $token;
            $user->verified = 1;
            if($social_type=="fb"){  
            $user->facebookid = $userid;
            }else{
            $user->googleid = $userid;
            }
            $user->save();
            $profile = new Userprofile();
            $profile->user_id = $user->id;
            //$profile->address = $request->address;
//            $profile->city = $data['city'];
//            $profile->state = $data['state'];
//            //$profile->zip = $request->zip;
//            $profile->country = $data['country'];
            $profile->phone = $data['phone'];
            
            $profile->save();
            
            $admintemplate = \App\Emailtemplates::find(4);
            //sendemail($settings->admin_email, 'Admin', '', $admintemplate, array('MEMBER_EMAIL' => $user->email));
            \Session::put('newuser', 1);
            $response = array('status' => 1, 'data' => $user);
            
        }
        }else{
            $response = array('status' => 0, 'message' => 'Invalid Request');
        }
        return response()->json($response);
    }


    public function adverts(Request $data) 
    {
        $images = Adverts::all();
        if(count($images) > 0) 
        {
            $adverts =array();
            foreach($images as $image)
            {
             
              $adverts[] =$image->image;
            }

            $response = array('status' => 1, "data" => $adverts, "message" => "Adverts List");
        } 
        else 
        {
            $response = array('status' => 0, "message" => "Not Available");
        }
        echo json_encode($response);
    }


     public function projectshortdetail(Request $data) 
     {
        $project_id = $data['project_id'];
        $projectlist = array();
        $projectimage = array();
        $project = Project::where('alias', $project_id)->first();
        if(count($project) > 0) 
        {
            if($project->is_completed==1)
            {
                $user = User::find($project->user_id);
                $imagecategories = Pro_imagecategories::all();
                foreach ($imagecategories as $imagecategory) 
                {
                  if($imagecategory->id==1)
                  {  
                    $featured_image = '';
                    $projectimages = $project->projectimages()->where('img_category_id', $imagecategory->id)->get();
                    foreach ($projectimages as $image) 
                    {
                        if($image->type==0)
                        {
                            $featured_image = url('project_images') . "/" . $image->image;
                        }
                    }
                
                  }
                }

                $projectlist = array(
                    "Pid" => $project->id,
                    "ProjectTitle" => $project->title,
                    "FeaturedImageURL" => $featured_image,
                    "SubscriberName" => $user->firstname . " " . $user->lastname,
                );

                $response = array('status' => 1, 'Projects' => $projectlist);
            }
            else 
            {
             $response = array('status' => 0, 'message' => "project is not completed");
            }

        } else {
            $response = array('status' => 0, 'message' => "project not available");
        }
        echo json_encode($response);
    }


    //Api For cubexpress
    public function loginUser(Request $data) 
    {
        //header("Access-Control-Allow-Credentials: true");
        header('Access-Control-Allow-Origin: *');
        //header('Access-Control-Allow-Methods: POST, GET, OPTIONS');
        //header('Access-Control-Allow-Headers: Accept, X-Access-Token, X-Application-Name, X-Request-Sent-Time');
        //$data = json_decode(file_get_contents('php://input'), true);
        $email = $data['email'];
        $pass = $data['password'];
        $customer = \Auth::attempt('user', ['email' => $email, 'password' => $pass]);
        if($customer == true) {
            $details = User::where('email', $email)->first();
            //$link = Autologin::user($details);
            $link = Autologin::to($details, '/home');
            $response = array('status' => 1, 'data' => $details,'logedinLink'=>$link);
        } else {
            $response = array('status' => 0, 'data' => 'Invalid email and password');
        }
        return response()->json($response);
    }

    public function loginToAutoCat(Request $data) 
    {
        //header("Access-Control-Allow-Credentials: true");
        header('Access-Control-Allow-Origin: *');
        //header('Access-Control-Allow-Methods: POST, GET, OPTIONS');
        //header('Access-Control-Allow-Headers: Accept, X-Access-Token, X-Application-Name, X-Request-Sent-Time');
        $data = json_decode(file_get_contents('php://input'), true);
        $email = $data['email'];
        $pass = $data['password'];
        $json_string=$data['json_string'];//server
        //$json_string=json_encode($data['json_string']);//local
        $customer = \Auth::attempt('user', ['email' => $email, 'password' => $pass]);
        if($customer == true)  
        {
            $details = User::where('email', $email)->first();
            $link = Autologin::to($details, '/home');
            $path = public_path().'/' . $details['firstname']."_".$details['id'];
            \File::makeDirectory($path, $mode = 0777, true, true);
            /*Source directory (can be an FTP address) */
            $src = public_path().'/TestBuild';
            /* Full path to the destination directory */
            $dst = public_path().'/' . $details['firstname']."_".$details['id'];
            /* Usage */
            beliefmedia_recurse_copy($src, $dst);
            $myfile = fopen($dst."/StreamingAssets/TestJson.json", "w") or die("Unable to open file!");
            //$txt = "{user_name :'".$row['user_name']."'}\n";
            $txt=$json_string;
            fwrite($myfile, $txt);
            fclose($myfile);

            $userfile = fopen($dst."/StreamingAssets/UserJson.json", "w") or die("Unable to open file!");
            //$txt = "{user_name :'".$row['user_name']."'}\n";
            $details['autologin_link']=$link;
            $userdata=$details;
            fwrite($userfile,$userdata);
            fclose($userfile);
            $link = Autologin::to($details,'/home');
            $response = array('status' => 1, 'data' => $details,'logedinLink'=>$link,'webgl_link'=>url().'/public/'.$details['firstname']."_".$details['id'].'/index.html');
        }
        else 
        {
            $response = array('status' => 0, 'data' => 'Invalid email and password');
        }
        return response()->json($response);
    }


    public function projectcreate(Request $data) {
       
        $data = json_decode(file_get_contents('php://input'));
        if($data->pid > 0) {
            $project = Project::find($data->pid);
            //$project->id = $data->pid;
            //$project->user_id = $data->user_id;
            //$project->title = $data->project_title;
            //$project->premium_service = $data->service;
            $project->user_json = $data->user_json;
            
           /* if($data->service == 1) {
                $project->is_public = 0;
            } else {
                $project->is_public = 1;
            }*/
            $project->save(); //update data existing project

        } else {

            $project = new Project();
            $project->user_id = $data->user_id;
            $project->title = $data->project_title;
            $project->premium_service = $data->service;
            $project->user_json = $data->user_json;
            
            if ($data->service == 1) {
                $project->is_public = 0;
            } else {
                $project->is_public = 1;
            }
            $project->save(); // save data new projects
        }

        //Update Project refrence link
        $project->id = $project->id;
        $project->alias  = substr($project->title, 0, 2).$project->id;
        $project->save();

        $departments = Departments::all();
        foreach($departments as $department) {
            $projectsteps = new Projectsteps();
            $projectsteps->project_id = $project->id;
            $projectsteps->step = $department->id;
            $projectsteps->save();
        }
        
        if($project->id) 
        { 
            $response = array('status' => 1, 'data' =>'Your project has been created successfully.');
        }
        else 
        {
            $response = array('status' => 0, 'data' => 'Please try again!');
        }
        return response()->json($response);
    }

    public function userprojects(Request $data) 
    {   
        $data = json_decode(file_get_contents('php://input'));
        $member = User::find($data->userid);
        $projects = $member->projects()->orderBy('id', 'desc')->get();
        $projectlist=array();
        foreach($projects as $key => $project) 
        {
            $projectimages_p = $project->projectimages()->where('type',0)->where('img_category_id',2)->get();
            //echo "<pre>";print_r($projectimages_p[0]);die();
            foreach ($projectimages_p as $image) 
            { 
                $imgpath=url("project_images/".$image->image); 
            }
               
            $projectlist[] = array(
                                "Pid" => $project->id,
                                "ProjectTitle" => $project->title,
                                "thumbnailimages"=>$imgpath,
                                "alias"=> $project->alias);
        }

        if($projectlist) 
        { 
            $response = array('status' => 1, 'data' => $projectlist);
        }
        else 
        {
            $response = array('status' => 0, 'data' => 'Please try again!');
        }
        
        return response()->json($response);
    }

    public function getuserjson(Request $data) {
       
        $data = json_decode(file_get_contents('php://input'));
        if($data->pid > 0) 
        {
            $project = Project::find($data->pid);
            $response = array('status' => 1, 'data' =>isset($project->user_json) ? $project->user_json : "");
        }
        else 
        {
            $response = array('status' => 0, 'data' => 'Please try again,Project Not Available!');
        }
        return response()->json($response);
    }


    public function getLayouts(Request $data) 
    {
        $layouts = Layouts::all();
        return response()->json($layouts);
    }


    public function addprojectlayout(Request $data) 
    {
        $data = json_decode(file_get_contents('php://input'));
        $projectlayout = new Projectlayouts();
        $projectlayout->project_id = $data->project_id;
        $projectlayout->layout_id = $data->layout_id;
        $projectlayout->layoutjson = $data->layoutjson;
        $projectlayout->save();
        if($projectlayout) 
        {
            $response = array('status' => 1, 'data' =>"Your project layout has been created successfully.");
        }
        else 
        {
            $response = array('status' => 0, 'data' => 'Please try again,Layout Not Added!');
        }
        return response()->json($response);
    }

   
}
