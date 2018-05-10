<!DOCTYPE html>
<!--[if IE 9 ]><html class="ie9"><![endif]-->
<?php //echo Session::get('active_id');?>
<html>

    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">
        <title>Cubedots</title>

        <!-- Vendor CSS -->
        <link href="{{asset('html/vendors/bower_components/fullcalendar/dist/fullcalendar.min.css')}}" rel="stylesheet">
        <link href="{{asset('html/vendors/bower_components/animate.css/animate.min.css')}}" rel="stylesheet">
        <link href="{{asset('html/vendors/bower_components/bootstrap-sweetalert/lib/sweet-alert.css')}}" rel="stylesheet">
        <link href="{{asset('html/vendors/bower_components/material-design-iconic-font/dist/css/material-design-iconic-font.min.css')}}" rel="stylesheet">
        <link href="{{asset('html/vendors/bower_components/malihu-custom-scrollbar-plugin/jquery.mCustomScrollbar.min.css')}}" rel="stylesheet">
        <link href="{{asset('html/vendors/bower_components/bootstrap-select/dist/css/bootstrap-select.css')}}" rel="stylesheet">

        <!-- CSS -->
        <link href="{{asset('html/css/app.min.1.css')}}" rel="stylesheet">
        <link href="{{asset('html/css/app.min.2.css')}}" rel="stylesheet">
        <link href="{{asset('html/css/Style.css')}}" rel="stylesheet" />
        <link href="{{asset('html/css/prettyPhoto.css')}}" rel="stylesheet" />
        <link href="{{asset('css/image_uploader/uploader.css')}}" rel="stylesheet" />
        <link href="{{asset('css/image_uploader/demo.css')}}" rel="stylesheet" />
    </head>

    <body class="toggled sw-toggled">
    <div id="PopUpMessage">
            <p>Your request is being processed..
                <span class="msg-gif">
                   
                    <img src="{{asset('html/img/loader.gif')}}" alt="loader"/>
                </span>
            </p>
        </div>
        <header id="header" class="clearfix" data-current-skin="teal" style="background-color: #000;">
            <ul class="header-inner">
                <div class="logo visible-xs" style="text-align:center">
                    <a href="{{url('/')}}">
                        <img src="{{asset('html/img/play_prism_hlock_2x.png')}}" style="width: 166px;"></a>
                </div>
                <li id="menu-trigger" data-trigger="#sidebar">
                    <div class="line-wrap">
                        <div class="line top"></div>
                        <div class="line center"></div>
                        <div class="line bottom"></div>
                    </div>
                </li>

                <li class="logo hidden-xs">
                    <a href="{{url('/')}}">
                        <img src="{{asset('html/img/play_prism_hlock_2x.png')}}" style="width: 166px;"></a>
                </li>

                <li class="pull-right">
                    @if(Auth::user())
                    <ul class="top-menu">
                        <li class="dropdown" id="dropdownid">
                             <?php   $transfer_project =  App\Transfer_project::where('reciever_id',\Auth::user()->id)->where('status',0)->get();
                                       ?>
                                      
                            <a data-toggle="dropdown" href="#">
                                <i class="tm-icon zmdi zmdi-notifications"></i>
                              <?php if(count($transfer_project)>0){?>  <i class="tmn-counts"><?php echo count($transfer_project);  ?></i><?php }?>
                            </a>
                            <?php if(count($transfer_project)>0){ ?>
                            <div class="dropdown-menu dropdown-menu-lg pull-right">
                                <div class="listview" id="notifications">
                                    <div class="lv-header">
                                        Notification
                                        <ul class="actions">
                                            <li class="dropdown">
                                                <a href="#" data-clear="notification">
                                                    <i class="zmdi zmdi-check-all"></i>
                                                </a>
                                            </li>
                                        </ul>
                                    </div>
                                    <div class="lv-body">
                                        
                                       <?php  if(count($transfer_project)>0){  foreach($transfer_project as $trans_project){
                                            $project123 = App\Project::find($trans_project->project_id);?> 
                                        
                                        <a class="lv-item" href="javascript:void(0);" onClick="getpro(<?php echo $trans_project->id;?>);">
                                            <div class="media">
                                                <div class="pull-left">
                                                    <img class="lv-img-sm" src="img/profile-pics/1.jpg" alt="">
                                                </div>
                                                <div class="media-body">
                                                    <div class="lv-title"><?php echo $project123->title;?></div>
                                                </div>
                                            </div>
                                        </a>
                                      
                                        <?php }?>
                                    </div>

                                    
                                </div>

                            </div>
                                       <?php }}?>
                        </li>
                        <li class="dropdown">
                            <a data-toggle="dropdown" href="#" aria-expanded="false">
                                <i class="zmdi zmdi-account-circle"></i> Welcome {{Auth::user()->firstname}} <i class="zmdi zmdi-caret-down"></i></a>
                            <ul class="dropdown-menu dm-icon pull-right">

                                <li>
                                    <a href="{{url('profile')}}"><i class="zmdi zmdi-settings"></i> Account Settings</a>
                                </li>
                                <li>
                                    <a href="{{url('home')}}"><i class="zmdi zmdi-assignment-check"></i> My Projects</a>
                                </li>
                                <li>
                                    <a href="{{url('support')}}"><i class="zmdi zmdi-bug"></i> My Tickets</a>
                                </li>
                                <li class="divider hidden-xs"></li>
                                <li>
                                    <a href="{{url('user/logout')}}"><i class="zmdi zmdi-power"></i> Logout</a>
                                </li>
                            </ul>
                        </li>
                        <!--<li class="hidden-xs" id="chat-trigger" data-trigger="#chat">
                            <a href="#"><i class="tm-icon zmdi zmdi-comment-alt-text"></i></a>
                        </li>-->
                    </ul>
                    @else

                    <ul class="top-menu">
                        <?php if (Request::segment(2) == 'register') { ?>
                            <li class="dropdown">
                                <a data-toggle="" href="{{url('user/login')}}">
                                    Login
                                   <!--  <i class="tmn-counts">9</i>-->
                                </a></li>
                        <?php } elseif (Request::segment(2) == 'login') { ?>
                            <li class="dropdown">
                                <a data-toggle="" href="{{url('user/register')}}">
                                    SignUp
                                   <!--  <i class="tmn-counts">9</i>-->
                                </a>
                            </li>
                        <?php } else { ?>
                            <li class="dropdown">
                                <a data-toggle="" href="{{url('user/login')}}">
                                    Login
                                   <!--  <i class="tmn-counts">9</i>-->
                                </a>
                            </li>
                            <li class="dropdown">
                                <a data-toggle="" href="{{url('user/register')}}">
                                    SignUp
                                   <!--  <i class="tmn-counts">9</i>-->
                                </a>
                            </li>
                        <?php } ?>
                    </ul>
                    @endif
                </li>
            </ul>

            <!-- Top Search Content -->
            <div id="top-search-wrap">
                <div class="tsw-inner">
                    <i id="top-search-close" class="zmdi zmdi-arrow-left"></i>
                    <input type="text">
                </div>
            </div>

        </header>

        @yield('content')

       
        <div class="modal fade" id="trans_project" tabindex="-1" role="dialog" aria-hidden="true" style="z-index: 9999;">
    <div class="modal-dialog" id="getpro">
     
</div>
</div>
        <!-- Javascript Libraries -->
        <script src="{{asset('html/vendors/bower_components/jquery/dist/jquery.min.js')}}"></script>
        <script src="{{asset('html/vendors/bower_components/bootstrap/dist/js/bootstrap.min.js')}}"></script>
        <script src="{{asset('html/vendors/bower_components/flot/jquery.flot.js')}}"></script>
        <script src="{{asset('html/vendors/bower_components/flot/jquery.flot.resize.js')}}"></script>
        <script src="{{asset('html/vendors/bower_components/flot.curvedlines/curvedLines.js')}}"></script>
        <script src="{{asset('html/vendors/sparklines/jquery.sparkline.min.js')}}"></script>
        <script src="{{asset('html/vendors/bower_components/jquery.easy-pie-chart/dist/jquery.easypiechart.min.js')}}"></script>
        <script src="{{asset('html/vendors/bower_components/moment/min/moment.min.js')}}"></script>
        <script src="{{asset('html/vendors/bower_components/fullcalendar/dist/fullcalendar.min.js')}}"></script>
        <script src="{{asset('html/vendors/bower_components/simpleWeather/jquery.simpleWeather.min.js')}}"></script>
        <script src="{{asset('html/vendors/bower_components/Waves/dist/waves.min.js')}}"></script>
        <script src="{{asset('html/vendors/bootstrap-growl/bootstrap-growl.min.js')}}"></script>
        <script src="{{asset('html/vendors/bower_components/bootstrap-sweetalert/lib/sweet-alert.min.js')}}"></script>
        <script src="{{asset('html/vendors/bower_components/malihu-custom-scrollbar-plugin/jquery.mCustomScrollbar.concat.min.js')}}"></script>
        <script src="{{asset('html/vendors/bower_components/bootstrap-select/dist/js/bootstrap-select.js')}}"></script>

        <!-- Placeholder for IE9 -->
        <!--[if IE 9 ]>
                <script src="vendors/bower_components/jquery-placeholder/jquery.placeholder.min.js"></script>
            <![endif]-->

        <script src="{{asset('html/js/flot-charts/curved-line-chart.js')}}"></script>
        <script src="{{asset('html/js/flot-charts/line-chart.js')}}"></script>
        <script src="{{asset('html/js/charts.js')}}"></script>


        <script src="{{asset('html/vendors/fileinput/fileinput.min.js')}}"></script>
        <script src="{{asset('js/jquery.validator.js')}}"></script>
        <script src="{{asset('html/js/functions.js')}}"></script>
        <script src="{{asset('html/js/common.js')}}"></script> 
        <script src="{{asset('html/js/jquery.prettyPhoto.js')}}"></script> 

        <!--<script src="js/demo.js"></script>-->
        <script type="text/javascript"> $.ajaxSetup({ headers: { 'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content') } }); </script>
        <script>
            
            $(document).ready(function(){
				$("area[rel^='prettyPhoto']").prettyPhoto();
				
				$(".gallery:first a[rel^='prettyPhoto']").prettyPhoto({animation_speed:'normal',theme:'light_square',slideshow:3000, autoplay_slideshow: true});
				$(".gallery:gt(0) a[rel^='prettyPhoto']").prettyPhoto({animation_speed:'fast',slideshow:10000, hideflash: true});
		
			
			});

    $(function () {
        
        var checkuri ="<?php echo Request::segment(1);?>";
        var checkuri2 ="<?php echo Request::segment(2);?>";
       if(checkuri!="home"){ 
           $('#sidetab1').on('click', function () {
             window.location.href = "<?php echo url("home"); ?>";
        });}
         if(checkuri=="home"){
         $('.main-menu li').removeClass('active');
         $('#sidetab1').addClass('active');
        }
       if(checkuri!="profile"){  
       $('#profile11').on('click', function () {
             window.location.href = "<?php echo url("profile"); ?>";
        });
        }
        if(checkuri=="profile"){ 
        $('.main-menu li').removeClass('active');
         $('#profile11').addClass('active');}
        if(checkuri!="support" || checkuri2!=""){  
        $('#ticket11').on('click', function () {
             window.location.href = "<?php echo url("support"); ?>";
        });
        }
         if(checkuri=="support" || checkuri=="viewticket"){  
       $('.main-menu li').removeClass('active');
         $('#ticket11').addClass('active');
         }
         
         
        $('.btn-circle').on('click', function () {
            $('.btn-circle.btn-info').removeClass('btn-info').addClass('btn-default');
            $(this).addClass('btn-info').removeClass('btn-default').blur();
        });

        $('.next-step, .prev-step').on('click', function (e) {
            var $activeTab = $('.tab-pane.active');

            $('.btn-circle.btn-info').removeClass('btn-info').addClass('btn-default');

            if ($(e.target).hasClass('next-step')) {
                var nextTab = $activeTab.next('.tab-pane').attr('id');
                $('[href="#' + nextTab + '"]').addClass('btn-info').removeClass('btn-default');
                $('[href="#' + nextTab + '"]').tab('show');
            } else {
                var prevTab = $activeTab.prev('.tab-pane').attr('id');
                $('[href="#' + prevTab + '"]').addClass('btn-info').removeClass('btn-default');
                $('[href="#' + prevTab + '"]').tab('show');
            }
        });
    });


    $(document).ready(function () {


    var $submit = $('button[type="submit"]');
    $submit.prop('disabled', true);
    $('.form-control').on('input change', function() { //'input change keyup paste'
        form_id = $(this).closest("form").attr('id');
        var $submit1 = $('#'+form_id+' button[type="submit"]');
        $submit1.prop('disabled', false);
         //
        // alert(user_id);
       // alert(!$(this).val().length);
    });
    $('.valid').on('input change', function() { //'input change keyup paste'
         var $submit1 = $('#'+form_id+' button[type="submit"]');
        $submit1.prop('disabled', false);
       // alert(!$(this).val().length);
    });

        $("#userlogin").validate({
            rules: {
                email: {
                    required: true,
                    email: true
                },
                password: {
                    required: true
                }
            },
            messages: {
                email: {
                    required: 'Enter email address',
                    email: 'Enter valid email address'
                },
                password: {
                    required: 'Enter password'
                }
            }
        });
        $("#changepassword").validate({
            rules: {
                currentpassword: {
                    required: true
                },
                newpassword: {
                    required: true,
                    rangelength: [7, 15]
                            //pwcheck: true
                },
                confirmnewpassword: {
                    required: true,
                    equalTo: '#newpassword'
                }
            },
            messages: {
                currentpassword: {
                    required: 'Enter current password'
                },
                newpassword: {
                    required: 'Enter new password',
                    // pwcheck: 'Password should contain at least 1 number but not more than 4, 1 non-alphanumeric characters & 1 Upper Case character',
                    rangelength: 'Password must be in between 8-15 characters'
                },
                confirmnewpassword: {
                    required: 'Enter confirm new password',
                    equalTo: 'Passwords do not match'
                }
            },
            submitHandler: function (form)
            {
                $.ajax({
                    type: "POST",
                    url: "/changepassword",
                    data: $("#changepassword").serialize(),
                    dataType: "json",
                    success: function (response)
                    {

                        if (response.status != 1) {

                            $('#err_msg').html('<div class="alert alert-danger"><a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>' + response.err_msg + '</div>').show();
                            $('#success_msg').hide();
                            //document.getElementById('changepassword').reset();
                        } else {
                            $('#success_msg').html('<div class="alert alert-success"><a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>' + response.success_msg + '</div>').show();
                            $('#changepasswordform').hide();
                            $('#err_msg').hide();
                            document.getElementById('changepassword').reset();
                        }
                    }
                });
            }

        });
        $('#updateemail').validate({
            rules: {
                newemail: {
                    required: true,
                    email: true
                }
            },
            messages: {
                newemail: {
                    required: 'Enter new email address',
                    email: 'Enter valid email address'
                }
            },
            submitHandler: function (form)
            {
                $.ajax({
                    type: "POST",
                    url: "/updateemail",
                    data: $("#updateemail").serialize(),
                    dataType: "json",
                    success: function (response)
                    {

                        if (response.status != 1) {
                            // alert(response.message);
                            $('#email_err_msg').html('<div class="alert alert-danger"><a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>' + response.message + '</div>').show();
                            $('#email_success_msg').hide();
                            //document.getElementById('changepassword').reset();
                        } else {
                            $('#email_success_msg').html('<div class="alert alert-success"><a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>' + response.message + '</div>').show();
                            $('#updateemail').hide();
                            $('#email_err_msg').hide();
                            document.getElementById('updateemail').reset();
                            location.reload();
                        }
                    }
                });
            }
        });


        $("#usersignup").validate({
            rules: {
                firstname: {
                    required: true
                },
                lastname: {
                    required: true
                },
                email: {
                    required: true,
                    email: true,
                    emailCheck: true
                },
                mobile: {
                    required: true,
                    number: true
                },
                country: {
                    required: true
                },
                state: {
                    required: true
                },
                city: {
                    required: true
                },
                password: {
                    required: true
                },
                password_confirmation: {
                    required: true,
                    equalTo: '#password'
                }

            },
            messages: {
                firstname: {
                    required: 'Enter name'
                },
                lastname: {
                    required: 'Enter name'
                },
                email: {
                    required: 'Enter email address',
                    email: 'Enter valid email address'
                },
                mobile: {
                    required: 'Enter mobile number'
                },
                password: {
                    required: 'Enter password'
                },
                password_confirmation: {
                    required: 'Enter confirm password',
                    equalTo: 'Password do not match'
                }
            }
        });

        $("#editprofile").validate({
            rules: {
                firstname: {
                    required: true
                },
                lastname: {
                    required: true
                },
                phone: {
                    required: true,
                    number: true
                },
                country: {
                    required: true
                },
                state: {
                    required: true
                },
                city: {
                    required: true
                },
                address: {
                    required: true
                },
                zip: {
                    required: true,
                    number: true
                }
            },
            messages: {
                firstname: {
                    required: 'Enter name'
                },
                lastname: {
                    required: 'Enter name'
                },
                phone: {
                    required: 'Enter mobile number'
                },
                address: {
                    required: 'Enter address'
                },
                zip: {
                    required: 'Enter zipcode'
                }
            }
        });
        $("#forgotpassword").validate({
            rules: {
                email: {
                    required: true,
                    email: true
                }
            },
            messages: {
                email: {
                    required: 'Enter email address',
                    email: 'Enter valid email address'
                }
            }
        });
        $("#transfer_project").validate({
            rules: {
                email: {
                    required: true,
                    email: true
                }
            },
            messages: {
                email: {
                    required: 'Enter email address',
                    email: 'Enter valid email address'
                }
            },
             submitHandler: function (form)
            {

            return confirm('Are You Sure?');

            }
        });
        $("#addticket").validate({
            rules: {
                project_id: {
                    required: true
                },
                department: {
                    required: true
                },
                subject: {
                    required: true

                },
                message: {
                    required: true
                },
                is_agreed_with_terms: {
                    required: true
                }

            },
            messages: {
                project_id: {
                    required: 'Select project'
                },
                department: {
                    required: 'Select department'
                },
                subject: {
                    required: 'Enter subject'
                },
                message: {
                    required: 'Enter message'
                }

            }
        });
        $("#ticketresponse").validate({
            rules: {
                message: {
                    required: true
                }
            },
            messages: {
                message: {
                    required: 'Enter message'
                }
            }
        });

        $.validator.addMethod( "extension", function( value, element, param ) {
            
            	param = typeof param === "string" ? param.replace( /,/g, "|" ) : "png|jpe?g|gif";
            	return this.optional( element ) || value.match( new RegExp( "\\.(" + param + ")$", "i" ) );

        }, $.validator.format( "Only AUTOCAD(dwg) file format is allowed" ) );

 
        $("#addlayout").validate({
            rules: {
                layout: {
                    required: true
                },
                top_view: {
                   required: function(element) { return $("#ceiling_height").val() == '' && $("#door_height").val() == '' && $("#window_height").val() == '' && $("#window_distance_ceiling").val() == ''} ,
                    extension: "dwg"
                },
                side_view: {
                   required: function(element) { return $("#ceiling_height").val() == '' && $("#door_height").val() == '' && $("#window_height").val() == '' && $("#window_distance_ceiling").val() == ''},
                    extension: "dwg"

                },
                furniture_plan_view:{
                    extension: "dwg"
                },
                reference_image:{
                     extension: "dwg"
                }
            },
            messages: {
                layout: {
                    required: 'Select Layout'
                },
                top_view: {
                    required: 'Select file to upload or specify ceiling height.'
                   
                },
                side_view: {
                    required: 'Select file to upload or specify ceiling height.'
                    
                }
            }
            ,
            submitHandler: function (form)
            {
                return confirm('Are you sure with your selection?');
            },
            errorPlacement: function(error, element) {
                if (element.attr("name") === "top_view" || element.attr("name") === "side_view" || element.attr("name") === "furniture_plan_view" || element.attr("name") === "reference_image" )
                    {
                        error.insertAfter(element.parent());
                    }
                    else
                    {
                        error.insertAfter(element);
                    }
                }
        });
       
        $("#createproject").validate({
            rules: {
                project_title: {
                    required: true
                },
                short_description: {
                    required: true
                },
                email: {
                    required: true,
                    email: true
                },
                mobile: {
                    required: true,
                    number: true
                },
                feature_image: {
                    required: true
                },
                thumbnail: {
                    required: true
                },
                 city: {
                    required: true
                },
                 category: {
                    required: true
                },
                privacy: {
                    required: true
                }

            },
            messages: {
                project_title: {
                    required: 'Enter project title'
                },
                short_description: {
                    required: 'Enter short description'
                },
                email: {
                    required: 'Enter email address',
                    email: 'Enter valid email address'
                },
                mobile: {
                    required: 'Enter mobile number'
                },
                privacy: {
                    required: 'accept privacy policy'
                }
            }
            ,
            submitHandler: function (form)
            {

                $.ajax({
                    url: "<?php echo url("project/store"); ?>",
                    type: "POST",
                    data: new FormData($('#createproject')[0]),
                    contentType: false,
                    cache: false,
                    processData: false,
                    success: function (data)
                    {
                        // $('#pidmenu1').val(data);
                        //   $('#pidmenu2').val(data);
                        // $('a[href="#design9"]').click(); 
                        window.location.href = data;
                    }
                });

            }

        });
        
        $("#editproject").validate({
            rules: {
                project_title: {
                    required: true
                },
                short_description: {
                    required: true,
                    maxlength: 500
                },
                description: { 
                    maxlength: 5000
                },
                /*email: {
                    required: true,
                    email: true
                },
                mobile: {
                    required: true,
                    number: true
                },
                 city: {
                    required: true
                },*/
                 category: {
                    required: true
                }

            },
            messages: {
                project_title: {
                    required: 'Enter project title'
                },
                short_description: {
                    required: 'Enter short description'
                },
                description: {
                    required: 'Enter full description'
                },
                /*email: {
                    required: 'Enter email address',
                    email: 'Enter valid email address'
                },
                mobile: {
                    required: 'Enter mobile number'
                },*/
                 category: {
                    required:  'Please select category'
                }

            },
            submitHandler: function (form)
            {

                $.ajax({
                    url: "<?php echo url("project/savedetails"); ?>",
                    type: "POST",
                    data: new FormData($('#editproject')[0]),
                    contentType: false,
                    cache: false,
                    processData: false,
                    success: function (data)
                    {
                        // $('#pidmenu1').val(data);
                        //   $('#pidmenu2').val(data);
                        // $('a[href="#design9"]').click(); 
                        //location.reload();
                        alert('Successfully submitted');
                    }
                });

            }

        });

        $("#links").validate({
            submitHandler: function (form)
            {
                $.ajax({
                    url: "<?php echo url("project/savelinks"); ?>",
                    type: "POST",
                    data: new FormData($('#links')[0]),
                    contentType: false,
                    cache: false,
                    processData: false,
                    success: function (data)
                    {
                       // $('#pidmenu3').val(data);
                       // $('button[href="#menu3"]').click();
                        alert('Successfully submitted');

                    }
                });

            }

        });
        $("#contact").validate({
            submitHandler: function (form)
            {
                $.ajax({
                    url: "<?php echo url("project/savecontact"); ?>",
                    type: "POST",
                    data: new FormData($('#contact')[0]),
                    contentType: false,
                    cache: false,
                    processData: false,
                    success: function (data)
                    {
                       // $('#pidmenu3').val(data);
                       // $('button[href="#menu3"]').click();
                        alert('Successfully submitted');

                    }
                });

            }

        });
        $("#createprojectservices").validate({
            submitHandler: function (form)
            {
                $.ajax({
                    url: "<?php echo url("project/createprojectservices"); ?>",
                    type: "POST",
                    data: new FormData($('#createprojectservices')[0]),
                    contentType: false,
                    cache: false,
                    processData: false,
                    success: function (data)
                    {
                        $('#pidmenu3').val(data);
                        $('button[href="#menu3"]').click();

                    }
                });

            }

        });
    });
    $.validator.addMethod("emailCheck", function (value, element) {
        var response = checkEmail(value);
        return Boolean(response);
    }, 'Email already exists.');


    // check email function starts
    function checkEmail(email) {
        var success = false;
        $.ajax({
            type: "get",
            url: "/user/checkemail/" + email,
            data: '',
            async: false,
            dataType: "json",
            success: function (response)
            {

                if (response.status == 1) {
                    success = false;

                } else {
                    success = true;
                }
            }
        });
        return success;
    }
    
     function project_publish(id,Status) 
     {

        if(confirm('Are you sure!')) 
        {
                var success = false;
                $.ajax({
                    type: "get",
                    url: "/project/project_publish/" + id+"/"+Status+"/"+0,
                    data: '',
                    async: false,
                    dataType: "json",
                    success: function (response)
                    {
                        if(response.success == true) 
                        {
                            location.reload();
                        }else{

                            //alert(response.msg);
                            if(confirm(response.msg))
                            {
                                 $.ajax({
                                        type: "get",
                                        url: "/project/project_publish/" + id+"/"+Status+"/"+1,
                                        data: '',
                                        async: false,
                                        dataType: "json",
                                        success: function (response)
                                        {
                                            if(response.success == true) 
                                            {
                                                location.reload();
                                            }else{

                                                alert(response.msg);
                                            }
                                        }
                                    });

                            }

                        }
                    }
                });
              
         }
    }
        </script>
        <script>
            videos = document.querySelectorAll("video");
            for (var i = 0, l = videos.length; i < l; i++) {
                var video = videos[i];
                var src = video.src || (function () {
                    var sources = video.querySelectorAll("source");
                    for (var j = 0, sl = sources.length; j < sl; j++) {
                        var source = sources[j];
                        var type = source.type;
                        var isMp4 = type.indexOf("mp4") != -1;
                        if (isMp4)
                            return source.src;
                    }
                    return null;
                })();
                if (src) {
                    var isYoutube = src && src.match(/(?:youtu|youtube)(?:\.com|\.be)\/([\w\W]+)/i);
                    if (isYoutube) {
                        var id = isYoutube[1].match(/watch\?v=|[\w\W]+/gi);
                        id = (id.length > 1) ? id.splice(1) : id;
                        id = id.toString();
                        var mp4url = "http://www.youtubeinmp4.com/redirect.php?video=";
                        video.src = mp4url + id;
                    }
                }
            }


            function removeimage(id) {
                if (confirm('Are you sure!')) {
                    $.ajax({
                        type: "get",
                        url: "/project/removeimage/" + id,
                        data: '',
                        async: false,
                        dataType: "json",
                        success: function (data)
                        {
                            $('#' + id).remove();
                            $('#'+data.divtoappend).append(data.str);
                            initdmUploader(data.penal);

                        }
                    });
                }
            }

            function getattribute(id) {
                $.ajax({
                    type: "get",
                    url: "/project/getattribute/" + id,
                    async: false,
                    success: function (data)
                    {
                       
                        $('#layoutattribute').html("<h3>Select Themes</h3>"+data); 
                    }
                });
            }

            function getLayoutattribute(pid,lid,aid) 
            {
                $(".getattribute-btn").removeAttr('disabled');
                $.ajax({
                    type: "get",
                    url: "/project/getlayoutattribute/" + pid + "/" + lid + "/" + aid,
                    async: false,
                    success: function (data)
                    {
                       
                        $(document).find('#attribute').html(data); 
                    }
                });
            }


        </script>
        <script>
             <?php if(Session::has('active_id')){?>          
            $('a[href="<?php echo Session::get('active_id'); ?>"]').click(); 
        <?php if(Session::get('active_id')=='#prdetails' or Session::get('active_id')=='#prlinks' or Session::get('active_id')=='#prcontact' or Session::get('active_id')=='#graphic'){?>
        $('.sub-menu').addClass('toggled');
          $('.level2').show();
            <?php }} ?>
            $(document).ready(function () {

                $(document).on('click','.selecttheme',function () {
                    $('input:not(:checked)').parentsUntil().removeClass("active_img");
                    $('input:checked').parentsUntil().addClass("active_img");
                });

                $(document).on('click','.btn-addlayout',function () {
                     $('#addlayoutform').toggle();  
                     $('#viewlayoutlist').toggle();  
                     $('#addlayoutbtn').toggle();  
                     
                });
            });
        
        $("#service").validate({
            rules: {
                project_title:{
                    required: true
                },
                service: {
                    required: true
                }
                
            },
            messages: {
                project_title:{
                    required: 'Please enter project title'
                },
                service: {
                    required: 'Please select service type'
                }
            },
            errorPlacement: function(error, element) {
                 error.appendTo('#errorplace');
            }
                        
        });


function showmsg(msg) {
    $('#PopUpMessage').show();
    $('#PopUpMessage').delay(500).css({"visibility": "visible", "opacity": "1", "transition": "all .5s linear"});

}
function hidemsg() {


    $('#PopUpMessage').hide();

}        

$(document).ready(function (e) {
    $(document).on('click','.fileinput-exists',function(e) {
    e.preventDefault();
    //$("#message").empty();
    //$('#loading').show();
    form=$(this).parents('form:first');
    var infile=form.attr('id');
    var cat=form.attr('cat');
    var typ=form.attr('typ');
    var pid=form.attr('pid');
    var paneldiv=form.attr('paneldiv');
    var catname=form.attr('catname');
    //alert(paneldiv);
     var ext = $('input[type=file][name="'+infile+'"]')[0].files[0].name.split('.').pop().toLowerCase();
        if ($.inArray(ext, ['jpg', 'jpeg']) == -1) {
            alert('Only JPG files are allowed!');
            return false;
        }
    
    var formData = new FormData();
    formData.append('file', $('input[type=file][name="'+infile+'"]')[0].files[0]);
    formData.append('category', cat);
    formData.append('type', typ);
    formData.append('pid', pid);
    formData.append('catname', catname);
    var html=$('#'+paneldiv).html();
    $.ajax({
        url: "<?php echo url('project/upload')?>", // Url to which the request is send
        type: "POST",             // Type of request to be send, called as method
        data: formData, // Data sent to server, a set of key/value pairs (i.e. form fields and values)
        contentType: false,       // The content type used when sending data to the server.
        cache: false,             // To unable request pages to be cached
        processData:false,        // To send DOMDocument or non processed data file it is set to false
        success: function(data)   // A function to be called if request succeeds
        {
            
            if(data.success==true){
            $('#'+paneldiv).html(data.str);
            }else{
             alert(data.msg);
            }
        }
    });
});

});
    function getpro(id)
    {
        $.ajax({
            type: "POST",
            url: "<?php echo url("project/gettransferpro"); ?>/"+ id,
            success: function (response)
            {
                $('#getpro').html(response);
                $("#trans_project").modal();
                $("#dropdownid").removeClass('open');               
            }
        });
    }     
    $(document).ajaxStart(function(){
       // showmsg();
    });

    $(document).ajaxStop(function(){
       //hidemsg();
    });
    
    //filetype
    </script>
    <!-- Drag and drop image uploader Start here-->
        <script src="{{asset('js/image-uploader/demo-preview.js')}}"></script>
        <script src="{{asset('js/image-uploader/dmuploader.js')}}"></script>
        <script src="{{asset('js/image-uploader/jquery-ui.js')}}"></script>
        <script type="text/javascript">
            $( function()
            {
                DragAndDrop();
                initdmUploader('cat1');
                $('.btn-primary').removeAttr('disabled');

            });

            function DragAndDrop() 
            {
                $(".swipe").draggable({
                    revert: "invalid",
                    cursor: "move",
                    helper: "clone",
                    drag: function (event, ui) 
                    {
                       // $("#dregdrop").html("Drag");   
                    }
                });

                $(".swipe").droppable({
                    drop: function(event, ui)
                    {
                        var $dragElem = $(ui.draggable).clone().replaceAll(this);
                        $(this).replaceAll(ui.draggable);
                        makeElementAsDragAndDrop(this);
                        makeElementAsDragAndDrop($dragElem);
                        var item_id = $(ui.draggable).attr('id');
                        var item_name = $(ui.draggable).find('img').attr('src');
                        var location = $(this).attr("id");
                        var location_name = $(this).find('img').attr("src");
                        // Ajax call
                        $.ajax({
                            type: "post",
                            url: "<?php echo url('project/swipeimages')?>",
                            data:{dragimg_id:item_id,dragimg_name:item_name,dropimg_id:location,dropimg_name:location_name},
                            async: false,
                            success: function (data)
                            {
                               if(data['success'])
                               {
                                    return true;
                               }
                            }
                        });
                    }
                });

            }

            function makeElementAsDragAndDrop(elem) 
            {
                $(elem).draggable({
                    revert: "invalid",
                    cursor: "move",
                    helper: "clone",
                    drag: function (event, ui) 
                    {
                        //$("#dregdrop").html("Drag");   
                    }
                });

                $(elem).droppable({

                    drop: function(event, ui) 
                    {
                        var $dragElem = $(ui.draggable).clone().replaceAll(this);
                        $(this).replaceAll(ui.draggable);
                        makeElementAsDragAndDrop(this);
                        makeElementAsDragAndDrop($dragElem);

                        var item_id = $(ui.draggable).attr('id');
                        var item_name = $(ui.draggable).find('img').attr('src');
                        var location = $(this).attr("id");
                        var location_name = $(this).find('img').attr("src");
                        
                        // Ajax call
                        $.ajax({
                            type: "post",
                            url: "<?php echo url('project/swipeimages')?>",
                            data:{dragimg_id:item_id,dragimg_name:item_name,dropimg_id:location,dropimg_name:location_name},
                            async: false,
                            success: function (data)
                            {
                               if(data['success'])
                               {
                                return true;
                               }
                            }
                        });
                        
                    }
                });
            }

            

            function initdmUploader(tabid){


                 $('#'+tabid).find('.drag-and-drop-zone').dmUploader({
                    url: '<?php echo url('project/upload')?>',
                    dataType: 'json',
                    extraData: {'infile':$('#'+tabid).find('.drag-and-drop-zone').attr('id'),'category':$('#'+tabid).find('.drag-and-drop-zone').attr('cat'),'type':$('#'+tabid).find('.drag-and-drop-zone').attr('typ'),'pid':$('#'+tabid).find('.drag-and-drop-zone').attr('pid'),'paneldiv':$('#'+tabid).find('.drag-and-drop-zone').attr('paneldiv'),'catname':$('#'+tabid).find('.drag-and-drop-zone').attr('catname')},
                    allowedTypes: 'image/jpeg',
                    onInit: function(){

                      //$.danidemo.addLog('#demo-debug', 'default', 'Plugin initialized correctly');
                    },
                    onBeforeUpload: function(id){

                        $(".progressbar_"+$(this).attr('id')).show();
                        $("."+$(this).attr('id')).hide();

                    },
                    onNewFile: function(id, file){

                      $.danidemo.addFile(".progressbar_"+$(this).attr('id'), id, file);
                      if(typeof FileReader !== "undefined")
                      {  
                        var reader = new FileReader();
                        // Last image added
                        var img = $(".progressbar_"+$(this).attr('id')).find('.image-preview').eq(0);
                        reader.onload = function (e) {

                            img.attr('src', e.target.result);
                            var image = new Image();
                            image.src = e.target.result;
                            image.onload = function(){
                                //alert(this.width+"==="+this.height);

                                if(tabid != 'cat2' && tabid != 'cat8' && this.height != this.width*9/16)
                                {
                                    $("#msgDiv").html();
                                    $("#msgDiv").html("<h4>Your Image Aspect Retio is not 16:9,If you are agree then we have to crop image otherwise uploaded new image.</h4>");
                                    $('#errorModal').modal('show');
                                    
                                }
                                else if(tabid == 'cat2' && this.width != this.height)
                                {
                                    $("#msgDiv").html();
                                    $("#msgDiv").html("<h4>Your Image Aspect Retio is not 1:1,If you are agree then we have to crop image otherwise uploaded new image.</h4>");
                                    $('#errorModal').modal('show');
                                }
                                else if(tabid == 'cat8' && this.width != 2*this.height)
                                {
                                    $("#msgDiv").html();
                                    $("#msgDiv").html("<h4>Your Image Aspect Retio is not 2:1,Please uploade new image with aspect ratio 2:1.</h4>");
                                    $('#errorModal').modal('show');
                                    $("#yes_btn").hide();
                                    $("#remove_lastimage").html('Ok');
                                    $("#remove_lastimage").removeClass('btn-danger');
                                    $("#remove_lastimage").addClass('btn-default');

                                    setTimeout(function(){ $("#remove_lastimage").trigger('click') }, 3000);
                                }   
                                


                            };
                        }

                        reader.readAsDataURL(file);

                      } else {
                        // Hide/Remove all Images if FileReader isn't supported
                        $(".progressbar_"+$(this).attr('id')).find('.image-preview').remove();
                      }
                      
                    },
                    onComplete: function(){
                      //$.danidemo.addLog('#demo-debug', 'default', 'All pending tranfers completed');
                    },
                    onUploadProgress: function(id, percent){

                      var percentStr = percent + '%';
                      $.danidemo.updateFileProgress(id, percentStr);

                    },
                    onUploadSuccess: function(id, data){

                        var paneldiv=$(this).attr('paneldiv');
                        var html=$('#'+paneldiv).html();
                        if(data.success==true)
                        {
                            $('#'+paneldiv).html(data.str);
                            setTimeout(function(){ $.danidemo.updateFileProgress(id, '100%'); }, 5000);
                            DragAndDrop(); 
                            initdmUploader(tabid);   
                            $("#remove_lastimage").attr("onclick","removedmUploaderimage("+data.last_image_id+")")
                        }
                        else
                        {
                            $(".progressbar_"+$(this).attr('id')).hide();
                            $("."+$(this).attr('id')).show();
                             $('#errorModal').modal('toggle');
                            alert(data.msg);
                        }
                      
                      
                    },
                    onUploadError: function(id, message){
                      //$.danidemo.updateFileStatus(id, 'error', message);
                      //$.danidemo.addLog('#demo-debug', 'error', 'Failed to Upload file #' + id + ': ' + message);
                    },
                    onFileTypeError: function(file){
                      //$.danidemo.addLog('#demo-debug', 'error', 'File \'' + file.name + '\' cannot be added: must be an image');
                    },
                    onFileSizeError: function(file){
                      //$.danidemo.addLog('#demo-debug', 'error', 'File \'' + file.name + '\' cannot be added: size excess limit');
                    },
                    onFallbackMode: function(message){
                      //$.danidemo.addLog('#demo-debug', 'info', 'Browser not supported(do something else here!): ' + message);
                    }
                });  
            }

            function removedmUploaderimage(id) 
            {   
                $.ajax({
                    type: "get",
                    url: "/project/removeimage/" + id,
                    data: '',
                    async: false,
                    dataType: "json",
                    success: function (data)
                    {
                        $('#' + id).remove();
                        $('#'+data.divtoappend).append(data.str);
                        initdmUploader(data.penal);

                    }
                });
                
            }

            function iframeDidLoad() {

                $("#myiframe").contents().find("#gameContainer").attr("style","width:900px;height:537px;");
               
            }

            function click_layout(pid,lid) 
            {   
                $.ajax({
                    type: "get",
                    url: "/project/clicklayout/" + pid + "/" + lid,
                    data: '',
                    async: false,
                    dataType: "json",
                    success: function (data)
                    {
                        if(data['status']==1)
                        {
                            return true;
                        }
                        else
                        {
                            alert("Something went wrong!");
                        }

                    }
                });
                
            }


           

    </script>
     <!-- Drag and drop image uploader end here-->
    
    </body>

</html>