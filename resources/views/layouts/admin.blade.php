<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <meta name="csrf-token" content="{{ csrf_token() }}">
  <title>Admin Panel</title>

  <!-- Bootstrap -->
  <link href="{{ asset('css/bootstrap.min.css')}}" rel="stylesheet">
  <link rel="stylesheet" href="{{ asset('css/font-awesome.min.css')}}" />
  <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
  <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
  <!--[if lt IE 9]>
    <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
    <script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
  <![endif]-->
  <script src="{{ asset('js/jquery1.11.0.js')}}"></script>
  <script src="{{ asset('js/bootstrap.min.js')}}"></script>
  <script src="{{ asset('js/jquery.validator.js')}}"></script>
  <script src="{{ asset('tinymce/js/tinymce/tinymce.min.js')}}"></script>
  <link href="{{ asset('css/admin.css')}}" rel="stylesheet" type="text/css" />
  <link href="{{asset('css/image_uploader/uploader.css')}}" rel="stylesheet" />
  <link href="{{asset('css/image_uploader/demo.css')}}" rel="stylesheet" />
  <script type="text/javascript">
    $(function() {				
		  checkScreen();
	 });
	
	$( window ).resize(function() {
		checkScreen();
	});
	
	function checkScreen(){
		var width = $( window ).width();
		if (width<=767) initMobile();
		else resetMobile();
                if(this.console){
                  console.log(width);
                }
	}
	
	function resetMobile(){
		if ($( ".tablegrid").hasClass("mobile")){
			var divtext = "";
			$( ".tablegrid .tablegridrow").each(function(i) {
				$(this).find("div").each(function(x){
					divtext = $(this).find("div:last").text();
					$(this).html(divtext);
				});			
			});
		}
		$( ".tablegrid").removeClass("mobile");
	}
	
	function initMobile(){
		if ($( ".tablegrid").hasClass("mobile")===false){
			var headers = [];
			var htext = "";
			var divtext = "";
			$( ".tablegrid .tablegridheader div" ).each(function(i) {
				htext = $.trim($(this).text());
				if (htext!="") headers.push(htext);
			});
			$( ".tablegrid .tablegridrow").each(function(i) {
				$(this).find("div").each(function(x){
					$(this).html("<div>"+headers[x]+"</div><div>"+$(this).html()+"</div>");
				});			
			});
		}
		$( ".tablegrid").removeClass("mobile").addClass("mobile");
	}
</script>
 <style>
 /*extra form css*/
#PopUpMessage {
  opacity:0;
  position: fixed;
  visibility:hidden;
  width: 100%;
  height: 100%;
  background-color: rgba(0,0,0,0.7);
  top: 0;
  left: 0;
  text-align: center;
  z-index:99999;
}
#PopUpMessage p {
  position: absolute;
  background-color: #fff;
  padding: 20px;
  border-radius: 5px;
  box-shadow: 0 0 10px #000;
  left: 50%;
  top: 50%;
  transform: translate(-50%, -50%);
  -moz-transform: translate(-50%, -50%);
  -webkit-transform: translate(-50%, -50%);
  -o-transform: translate(-50%, -50%);
  -ms-transform: translate(-50%, -50%);
  font-size: 17px;
}
#PopUpMessage .msg-gif{
	display:block;
	text-align:center;
	margin-top:15px;
}
 </style>
</head>
<body>
<div id="PopUpMessage">
            <p>Your request is being processed..
                <span class="msg-gif">
                   
                    <img src="{{ asset('/html/img/loader.gif')}}" alt="loader"/>
                </span>
            </p>
        </div>
    @include('admin/menu')
    @yield('content')
     <!--#footer start-->
      <div id="footer"> 
      <div class="container">
       <p class="text-muted">Copyright &copy 2016 cubedots.com. All Right Reserved</p>
      </div>
    </div>
     <script src="{{ asset('js/admin.js')}}"></script>
      <!--#footer over-->
      <script type="text/javascript">
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });
        </script>
   <script type="text/javascript">
	$(function() {
		$(".fixcontentheight").css({"min-height":$(window).height()-($("#membertop").height()+$(".menubg").height()+$("#footerbg").height())});
	});
</script>
    <script>
    $(document).ready(function(){
       $("#addadminuser").validate({
          rules:{
              name:{
                  required:true
              },
              email:{
                  required:true,
                  email:true
              },
              password:{
                  required:true
              },
              confirm_password:{
                required:true,
                equalTo:'#password'
              },
              department_id:{
                required:true
              }
              
          },
          messages:{
              name:{
                  required:'Enter name'
              },
              email:{
                  required:'Enter email address',
                  email:'Enter valid email address'
              },
              password:{
                  required:'Enter password'
              },
              confirm_password:{
                required:'Enter confirm password',
                equalTo:'Password do not match'
              }
          }
       });
       $("#edituserform").validate({
          rules:{
              name:{
                  required:true
              },
              email:{
                  required:true,
                  email:true
              }
              
              
          },
          messages:{
              name:{
                  required:'Enter name'
              },
              email:{
                  required:'Enter email address',
                  email:'Enter valid email address'
              }
          }
       });
       $("#addassetbundle").validate({
          rules:{
              version:{
                  required:true
              },
              bundle:{
                  required:true
                  
              }
             
          },
          messages:{
              version:{
                  required:'Enter name'
              },
              bundle:{
                  required:'Enter email address'
              }
          }
       });
       
       // change password
       $('#changepassword').validate({
          rules:{
              currentpassword:{
                  required:true
              },
              newpassword:{
                  required:true
              },
              confirmnewpassword:{
                  required:true,
                  equalTo:'#newpassword'
              }
          },
          messages:{
              currentpassword:{
                  required:'Enter current password'
              },
              newpassword:{
                  required:'Enter new password'
              },
              confirmnewpassword:{
                  required:'Enter confirm new password',
                  equalTo:'Password do not matched'
              }
          },
          submitHandler: function (form)
                    {
                        $.ajax({
                            type: "POST",
                            url: "changeadminpassword",
                            data: $("#changepassword").serialize(),
                            dataType: "json",
                            success: function (response)
                            {
                               //alert(response.status);
                                if (response.status == 0) {

                                    $('#err_msg').html('<div class="alert alert-danger"><a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>'+response.err_msg+'</div>').show();
                                    document.getElementById("changepassword").reset();
                                    $('#changepassword').hide();
                                } else {
                                    $('#success_msg').html('<div class="alert alert-success"><a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>'+response.success_msg+'</div>').show();
                                    document.getElementById("changepassword").reset();
                                    $('#changepassword').hide();
                                }
                            }
                        });
                    }
       });
         $("#addprojectxmldetail").validate({
        rules: {
            player_position: {
                required: true
            },
            player_rotation: {
                required: true 
            },
            target_position: {
                required: true
            },
            start_value: {
                required: true
            },
            min_zoom: {
                required: true
            },
            max_zoom: {
                required: true
            },
            collider_position: {
                required: true
            },
            collider_rotation: {
                required: true
            },
            no_of_cameras: {
                required: true
                 },
            camera_position: {
                required: true
            },
            camera_rotation: {
                required: true
            },
            asset_name: {
                required: true
            },
            set_no: {
                required: true
            },
            theme_no: {
                required: true
            },
            asset_position: {
                required: true
            },
            asset_rotaion: {
                required: true
            }
        },
        messages: {
            
        }
    });
    });
    
    $(".alert").fadeTo(3000, 500).slideUp(500, function(){
    $(".alert").hide('slow');
});
$(document).on('click','.addnewsocial',function(){
    $('#addnewsocial').show('slow');
    $('#socialdata').hide('slow');
});
$(document).on('click','.cancelsocial',function(){
    $('#addnewsocial').hide('slow');
    $('#socialdata').show('slow');
});
$(document).on('click','.addnewpay',function(){
    $('#addnewpay').show('slow');
    $('#paydata').hide('slow');
});
$(document).on('click','.cancelsocial',function(){
    $('#addnewpay').hide('slow');
    
    $('#paydata').show('slow');
});

function confirmsettings(formChangeFlag){
    
    var msg=[];
    var google2fa = $("input:radio[name='google2fa']:checked").val();
    var emailotp = $("input:radio[name='emailotp']:checked").val();
    var ip_restricted = $("input:radio[name='ip_restricted']:checked").val();
    var update =false;
    if(parseInt(google2fa) !== parseInt($('#google2fa_org').val())){
        if(parseInt(google2fa)==1){
            msg.push(' enable Google 2FA ');
        }else{
            msg.push(' disable Google 2FA ');
        }
        update=true;
    }
    if(parseInt(emailotp) !== parseInt($('#emailotp_org').val())){
        if(parseInt(emailotp)==1){
            msg.push(' enable Email OTP 2FA ');
        }else{
            msg.push(' disable Email OTP 2FA ');
        }
        update=true;
    }
    if(parseInt(ip_restricted) !== parseInt($('#ip_restricted_org').val())){
        if(parseInt(ip_restricted)==1){
            msg.push(' enable IP Restriction ');
        }else{
            msg.push(' disable IP Restriction ');
        }
        update=true;
    }
    if(update){
    return confirm('Are you sure to '+msg.toString());
    }else{
        alert('No settings changed');
        return false;
    }
    return false;
}
$(document).ready(function(){

$("#email_settings").validate({
                rules: {
                    sitetitle:{
                         required: true
                    },
                    admin_email:{
                        required: true,
                        email: true
                    },
                    smtp_server:{
                        required:{
                            depends: function(element) {
                                return checkSMTP();
                            }
                        }
                    },
                    smtp_port: {
                        required:{
                            depends: function(element) {
                                return checkSMTP();
                            }
                        }
                    },
                    smtp_username: {
                        required:{
                            depends: function(element) {
                                return checkSMTP();
                            }
                        }
                    },
                    smtp_password: {
                        required:{
                            depends: function(element) {
                                return checkSMTP();
                            }
                        }
                    },
                    smtp_type:{
                        required:{
                            depends: function(element) {
                                return checkSMTP();
                            }
                        }
                    }
                },
                messages: {
                    sitetitle:{
                         required: 'Enter Website Title'
                    },
                    admin_email:{
                        required: 'Enter administartor email',
                        email: 'Enter valid email address'
                    },
                    smtp_server:{
                        required: 'Enter SMTP Host / Server'
                    },
                    smtp_port: {
                        required: 'Enter SMTP Port'
                    },
                    smtp_username: {
                        required: 'Enter SMTP Username'
                    },
                    smtp_password: {
                        required: 'Enter SMTP Password'
                    },
                    smtp_type:{
                        required:'Select SMTP Encrytion Type'
                    }    
                }
                
            });

        });
function checkSMTP(){
    if($("input[name=smtp_on]:checked").val()==1){
        return true;
    }else{
         return false;
    }
}
    </script>
<script>
  tinymce.init({
    selector: 'textarea'
  });
$(document).ready(function (e) {
    $(document).on('click','.fileinput-exists',function(e) {
    e.preventDefault();
    //$("#message").empty();
    //$('#loading').show();
    form=$(this).parents('form:first');
    var infile=form.attr('id');
   // var lid=form.attr('lid');
   // var pid=form.attr('pid');
     var imgpath = document.getElementById("fUpload"+infile).value;
            if (imgpath == "") {
                alert("Upload XML File...");               
                return false;
            }
            else {
                // code to get File Extension..
                var arr1 = new Array;
                arr1 = imgpath.split("\\");
                var len = arr1.length;
                var img1 = arr1[len - 1];
                var filext = img1.substring(img1.lastIndexOf(".") + 1);
                // Checking Extension
                if (filext != "xml") {                 
                    alert("Upload File with Extension ' XML '");
                    return false;
                }
            }
   // alert(infile);
   // alert(lid);
   // alert(pid);
    var formData = new FormData();
    formData.append('file', $('input[type=file][name="'+infile+'"]')[0].files[0]);
    formData.append('id', infile);
   
    $.ajax({
        url: "<?php echo url('project/upload_xml')?>", // Url to which the request is send
        type: "POST",             // Type of request to be send, called as method
        data: formData, // Data sent to server, a set of key/value pairs (i.e. form fields and values)
        contentType: false,       // The content type used when sending data to the server.
        cache: false,             // To unable request pages to be cached
        processData:false,        // To send DOMDocument or non processed data file it is set to false
        success: function(data)   // A function to be called if request succeeds
        {
            $('#'+infile+"_div").html(data.str);
           // alert("upload suucessfully");
        }
    });
});
});
    $(document).ready(function(){
        $("#emailtemplate").validate({
            rules: {
                tile:{
                    required: true
                },
                subject:{
                    required: true
                },
                content:{
                    required: true
                }
            },
            messages: {
                title:{
                    required: 'Please enter template title'
                },
                subject:{
                    required: 'Please enter email subject'
                },
                content:{
                    required: 'Please enter email content'
                }
            }
        });
        $("#addsocialform").validate({
          rules:{
              provider:{
                  required:true
              },
              client_id:{
                  required:true
                  
              },
              client_secret:{
                  required:true
              },
              redirect:{
                  required:true
              }
          },
          messages:{
              provider:{
                  required:'Enter provider name'
              },
              client_id:{
                  required:'Enter client id '
              },
              client_secret:{
                  required:'Enter client secret'
              },
              redirect:{
                  required:'Enter redirect url'
              }
          }
       });
        $("#addfile").validate({
          rules:{
              title:{
                  required:true
              },
              file:{
                  required:true   
              }
          },
          messages:{
              title:{
                  required:'Enter Title'
              },
              file:{
                  required:'Select File'
              }
          }
       });
       $("#addpayment_form").validate({
          rules:{
              name:{
                  required:true
              },
              pclient_id:{
                  required:true
                  
              },
              pclient_secret:{
                  required:true
              },
              percentage_fee:{
                   digits: true
              },
              fixed_fee:{
                   digits: true
              }
          },
          messages:{
              provider:{
                  required:'Enter payment processor name'
              },
              pclient_id:{
                  required:'Enter payment processor client id '
              },
              pclient_secret:{
                  required:'Enter payment processor client secret'
              },
              percentage_fee:{
                   digits: 'Only numbers allowed'
              },
              fixed_fee:{
                   digits: 'Only numbers allowed'
              }
          }
       });
    });
    
    var hash = window.location.hash.slice(1);
    
    if(hash.length > 0){
        $( "ul#settingtabs li" ).each(function() {
            $( this ).removeClass( "active" );
        });
        $( "div.tab-pane" ).each(function() {
            $( this ).removeClass( "active" );
        });
        $('a[href="#'+hash+'"]').parent().addClass('active');
        $('#'+hash).addClass('active');
    }
    //$('.page').hide();
    //$('#' + hash).show();
    // $('a[href="#render"]').click();
    function showmsg(msg) {
    $('#PopUpMessage').show();
    $('#PopUpMessage').delay(500).css({"visibility": "visible", "opacity": "1", "transition": "all .5s linear"});

}
function hidemsg() {


    $('#PopUpMessage').hide();

} 
    $(document).on('submit','.upload_asset_bundle',function(){
    	alert('TEST');
    	showmsg();
    });

     function removeAdvertImage(id) {
                if (confirm('Are you sure!')) {
                    $.ajax({
                        type: "get",
                        url: "/admin/advert/removeimage/" + id,
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
  </script> 
  <!-- Drag and drop image uploader Start here-->
        <script src="{{asset('js/image-uploader/demo-preview.js')}}"></script>
        <script src="{{asset('js/image-uploader/dmuploader.js')}}"></script>
        <script src="{{asset('js/image-uploader/jquery-ui.js')}}"></script>
        <script type="text/javascript">
            $( function()
            {
                DragAndDrop();
                initdmUploader('uploader');
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
                            url: "<?php echo url('admin/advert/swipeimages')?>",
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
                            url: "<?php echo url('admin/advert/swipeimages')?>",
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
                    url: '<?php echo url('admin/advert/upload')?>',
                    dataType: 'json',
                    allowedTypes: 'image/jpeg',
                    onInit: function(){

                      //$.danidemo.addLog('#demo-debug', 'default', 'Plugin initialized correctly');
                    },
                    onBeforeUpload: function(id){

                        $(".progressbar").show();
                        $(".uploader").hide();

                    },
                    onNewFile: function(id, file){

                      $.danidemo.addFile(".progressbar", id, file);
                      if(typeof FileReader !== "undefined")
                      {  
                        var reader = new FileReader();
                        // Last image added
                        var img = $(".progressbar").find('.image-preview').eq(0);
                        reader.onload = function (e) {
                            img.attr('src', e.target.result); 
                        }

                        reader.readAsDataURL(file);

                      } else {
                        // Hide/Remove all Images if FileReader isn't supported
                        $(".progressbar").find('.image-preview').remove();
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

                        var paneldiv="paneldiv";
                        var html=$('#'+paneldiv).html();
                        if(data.success==true)
                        {
                            $('#'+paneldiv).html(data.str);
                            setTimeout(function(){ $.danidemo.updateFileProgress(id, '100%'); }, 5000);
                            DragAndDrop(); 
                            initdmUploader(data.tabid);   
                        }
                        else
                        {
                            $(".progressbar").hide();
                            $(".uploader").show();
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

            

            

           
    </script>
     <!-- Drag and drop image uploader end here-->   
    
</body>
</html>
