@extends('layouts/admin')
@section('content')

<div class="allcontent">
    
    <div  class="serchlefts">
        
    <div class="maintablewhite">
<div class="maintitle"><div class="orangebox">
                <div class="orangeicon"><i style="font-size: 40px; color: #ffffff;" class="fa fa-diamond" aria-hidden="true"></i></div>
            </div>&nbsp;&nbsp;Projects ({{$projectcount}})</div>
        
        <div id="gride-bg">
            <div class="tablegrid">
                <div class="tablegridheader">
                    <div></div><!--<div><input type="checkbox" id="checkbox" name="checkbox"><label for="checkbox"></label></div>-->
                    <div class="text-left" style="padding-left: 15px;">Title</div>                    
                                     
                    <div>Email</div>                    
                    <div>Phone</div>                    
                   
                    <div>Service</div>
                    <div>Status</div>
                   
                </div>
                @foreach($projects as $project)

                <div class="tablegridrow">   
                    <div></div>
                    <div class="text-left" style="padding-left: 15px;">{{ $project->title}}</div>
                   
                    <div>{{ $project->email}} </div>
                    <div>{{ $project->phone}}</div>                
                    <div><?php
                        if ($project->premium_service == 1) {
                            echo "Premium";
                        } else {
                            echo "Free";
                        }
                        ?></div>  
                    <div><?php
                        if ($project->is_completed == 0) {
                            echo $project->department->department_name;
                        } else {
                            echo "Completed";
                        }
                        ?></div>   
                </div>
                @endforeach   

            </div>

            <div class="clearboth"></div>
        </div><br>
        <div class="tebaltop">

            <div class="bluebtn"><a href="{{adminurl('projects')}}">See All</a></div>

        </div>
    </div></div>
    <div class="serchlefts">
   
    <div class="maintablewhite">
         <div class="maintitle"><div class="orangebox" style="background: #ffce55;">
                <div class="orangeicon"><i style="font-size: 40px; color: #ffffff;" class="fa fa-users" aria-hidden="true"></i></div>
             </div>&nbsp;&nbsp;Members ({{$usercount}})</div>
        
        <div id="gride-bg">
            <div class="tablegrid">
                <div class="tablegridheader">
                    <div></div>
                    <div class="text-left" style="padding-left: 15px;">Id</div>                    
                    <div>Name</div> 
                    <div>Email</div>     
                    <div>Registration Date</div>
                   
                </div>
               @foreach($users as $member)

                <div class="tablegridrow">
                    <div></div>
                    <div class="text-left" style="padding-left: 15px;">{{$member->id}}</div>
                    <div>{{$member->firstname}} {{$member->lastname}}</div>
                    <div>{{$member->email}} </div>
                    <div>{{$member->created_at}}</div>
                     

                </div>
                @endforeach  

            </div>

            <div class="clearboth"></div>
        </div>
         <br>
<div class="tebaltop">
            <div class="bluebtn"><a href="{{adminurl('members')}}">See All</a></div>
        </div>
    </div></div>
      <div class="clearboth"></div>
</div>
@stop