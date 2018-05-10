@extends('layouts/admin')
@section('content')
<div class="allcontent">
    <div class="maintitle">Projects</div>
    @if(Session::has('message'))
    <div class="container">
        <div class="col-md-8 col-md-offset-2 alert alert-success text-center">
            {{Session::get('message')}}
        </div>
    </div>
    @endif
    @if(Session::has('error'))
    <div class="container">
        <div class="col-md-8 col-md-offset-2 alert alert-danger text-center">
            {{Session::get('error')}}
        </div>
    </div>
    @endif 
    <div class="maintablewhite">
        <div class="tebaltop">

            <span class="diplytext">Display {{$projects->count()}} Records Through {{$projects->total()}} Records</span>

        </div>

        <div id="gride-bg">
            <div class="tablegrid">
                <div class="tablegridheader">
                    <!--<div><input type="checkbox" id="checkbox" name="checkbox"><label for="checkbox"></label></div>-->
                    <div>Project Id</div>
                    <div class="text-left" style="padding-left: 15px;">Title</div>                    
                    <div>Company Name</div>                    
                    <div>Email</div>                    
                    <div>Phone</div>                    
                    <div>Category</div>
                    <div>Service</div>
                    <div>Status</div>
                    <div>Action</div>
                </div>
                @foreach($projects as $project)

                <div class="tablegridrow <?php if(!$project->view_status){echo 'read';}?>">
                    <!--div><input type="checkbox" id="2" name="checkbox"> <label for="2"></label></div>-->
                    <div>{{ $project->id}} </div>
                    <div class="text-left" style="padding-left: 15px;"> <b>{{ $project->title}}</b>
                        <!--                        <a href="{{adminurl('projects/edit/'.$project->id)}}">
                                                    {{ $project->title}}
                                                </a>-->
                    </div>
                    <div>{{ $project->company_name}} </div>
                    <div>{{ $project->email}} </div>
                    <div>{{ $project->phone}}</div>
                    <div>@if($project->category){{ $project->category->category}}@endif</div>  
                    <div><?php
                        if ($project->premium_service == 1) {
                            echo "Premium";
                        } else {
                            echo "Free";
                        }
                        ?></div>  
                    <div><?php if ($project->is_completed == 0) {
                            echo $project->department->department_name;
                        } else {
                            echo "Completed";
                        } ?></div>   
                    <!--<div><a class="btn btn-primary">Modules</a> <a class="btn btn-primary">Services</a></div>-->
                    <!--<div><a href="{{adminurl('projects/edit/'.$project->id)}}" class="btn btn-primary">Edit</a>  <a href="{{adminurl('projects/delete/'.$project->id)}}" class="btn btn-danger" onclick="return confirm('are you sure you want to delete this project?')">Delete</a> </div>-->    
                    <div>
                        <a href="{{adminurl('project/view/'.$project->id)}}" class="btn btn-primary">View</a>  
                        @if(Auth::user('admin')->is_main ===1 ) <a href="{{adminurl('projects/delete/'.$project->id)}}" class="btn btn-danger" onclick="return confirm('are you sure you want to delete this project?')">Delete</a> @endif </div>
                </div>
                @endforeach   

            </div>
<?php echo $projects->render(); ?>
            <!--<ul class="nice_paging">
                               <li><a href="#">< Previous</a></li>
                               <li><a href="#">1</a></li>
                               <li class="current">2</li>
                               <li><a href="#">3</a></li>
                               <li><a href="#">4</a></li>
                               <li><a href="#">5</a></li>
                               <li><a href="#">Next ></a></li>
             </ul>-->
            <div class="clearboth"></div>
        </div>

    </div>
</div>
@stop