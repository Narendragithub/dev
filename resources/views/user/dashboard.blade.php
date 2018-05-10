@extends('layouts/main')
@section('content')
<section id="main" data-layout="layout-1">
    @include('layouts/aside')
    
    <section id="content">
         <div class="col-md-12">
             <div class="tab-content">
                                    <div role="tabpanel" class="tab-pane active" id="sidetab1">
            <div class="row">

                <div class="col-md-12">

                    <div class="card my-project">
                        <div class="card-body card-padding">

                            <div class="dash-widgets landing-widget">
                                <div class="row">

                                    <div class="card">
                                        <div class="">
                                            <h3><span style="color:#009688;">My</span> Projects @if(count($projects) > 0)<div class="pull-right"><a class='btn btn-success' data-toggle="modal" href="#modalDefault" >Create New Project</a></div> @endif</h3><br />

                                        </div>
                                        @if(count($projects) > 0)




                                        <div class="table-responsive text-center">
                                            <table id="data-table-basic" class="table table-striped">
                                                <thead>
                                                    <tr>
                                                        <th data-column-id="id" data-type="numeric">S No.</th>
                                                        <th data-column-id="sender">Image</th>
                                                        <th data-column-id="received" data-order="desc">Title</th>
                                                        <th data-column-id="received1" data-order="desc">Service</th>
                                                        <th data-column-id="received2" data-order="desc">Ave. rating</th>
                                                        <th data-column-id="received3" data-order="desc">Last Update</th>
                                                        <th data-column-id="received4" data-order="desc">Status</th>
                                                        <th data-column-id="received5" data-order="desc">Action</th>
                                                        
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                    <?php $i=0; foreach($projects as $project){ $i++;?>
                                                    <tr>
                                                        <td>{{$i}}</td>
                                                        <td><div class="fileinput-preview thumbnail">
                                                            <a href="{{url('project/edit/'.$project->id)}}">
                                                                <?php $thumb=$project->thumbnails();
                                                                if(count($thumb) > 0){
                                                                    foreach ($thumb as $timage){ ?>
                                                                        <img width="150" class="img-responsive" src="{{url('project_images') . "/" . $timage->image}}">
                                                                    <?php  break; } 
                                                                }else{ ?>
                                                                  <img height="100" width="150" class="" src=" {{url('html/img/blank.png')}}">  
                                                                <?php } ?>
                                                                
                                                            </a></div>
                                                        </td>
                                                        <td>
                                                            {{$project->title}} 

                                                        </td>
                                                        <td><?php
                                                            if ($project->premium_service == 1) {
                                                                echo "Premium";
                                                            } else {
                                                                echo "Free";
                                                            }
                                                            ?></td>
                                                        
                                                        <td><?php 
                                                        $avr_rating = 0;
            $rating = 0;
            $projectratings = $project->projectratings($project->id)->get();
            if (count($projectratings) > 0) {
                foreach ($projectratings as $projectrating) {
                    $avr_rating = $avr_rating + $projectrating->rating;
                }
                $rating = $avr_rating / count($projectratings);
            $rating = $avr_rating / count($projectratings);
                }
           
            echo $rating."/".count($projectratings);?></td>
                                                        <td><?php if($project->updated_at){ echo date("M d Y",strtotime($project->updated_at)); } else {echo date("M d Y",strtotime($project->created_at)); } ?></td>
                                                        <td><?php
                                                        
                                                          if ($project->premium_service == 1) {
                                                            if ($project->status == 1) { ?>
                                                            <button class="btn btn-warning">Pending</button>
                                                            <?php }  ?>
                                                            <?php if ($project->status > 1 and $project->is_completed == 0) { ?>
                                                               <button class="btn btn-primary">In Process</button>
                                                            <?php }  ?>
                                                           
                                                            <?php if ($project->is_completed == 1) { ?>
                                                                <button class="btn btn-success">Completed</button>
                                                          <?php }} else{
                                                              if ($project->is_completed == 0) { ?>
                                                               <button class="btn btn-primary">Un Published</button>
                                                            <?php }  ?>
                                                           
                                                            <?php if ($project->is_completed == 1) { ?>
                                                                <button class="btn btn-success">Published</button>
                                                          <?php }
                                                          }  ?>
                                                                <!--<a class="btn btn-danger" onclick="return confirm('Are you sure?');" href="{{url('project/delete/'.$project->id)}}"><i class="tm-icon zmdi zmdi-delete"></i></a>-->
                                                            </td>
                                                            <td><a class="btn " href="{{url('project/edit/'.$project->id)}}"><i class="tm-icon zmdi zmdi-edit"></i></a> &nbsp;<a class="btn btn-danger" onclick="return confirm('Are you sure?');" href="{{url('project/delete/'.$project->id)}}"><i class="tm-icon zmdi zmdi-delete"></i></a></td>
                                                        
                                                    </tr>

 <!--<td>  <img height="100" width="100" class="" src="{{url('project_images') . "/thumbnail/" . $project->project_thumb}}">

</td>
<td>{{$project->title}}</td>
<td><?php
                                                    if ($project->premium_service == 1) {
                                                        echo "Premium";
                                                    } else {
                                                        echo "Free";
                                                    }
                                                    ?></td>


<td><button class="btn bgm-red waves-effect">Download</button></td>-->
                                                    <?php }?>

                                                </tbody>
                                            </table>
                                        </div>
                                        @else
                                        <div class="row">
                                            <div class="col-md-12 col-sm-12 col-xs-12 text-center">
                                                <h2>You don't have any project.</h2>
                                                <p><a data-toggle="modal" href="#modalDefault"  class='btn btn-success' >Create New Project</a></p>
                                               
                                            </div>
                                        </div>
                                        @endif
                                       
                                    </div>

                                </div>
                                <hr />
                            </div>

                        </div>

                    </div>


                </div>
            </div>
                                        </div>
                <div role="tabpanel" class="tab-pane" id="profile11">

                                        <div class="row">
                                            <div class="col-md-12">
                                                <div class="card">

                                                    <div class="card-body card-padding">
                                                        <p>Morbi mattis ullamcorper velit. Etiam rhoncus. Phasellus leo dolor, tempus non, auctor et, hendrerit quis, nisi. Cras id dui. Curabitur turpis.
            Etiam ut purus mattis mauris sodales aliquam. Aenean viverra rhoncus pede. Nulla sit amet est. Donec mi odio, faucibus at, scelerisque quis, convallis in, nisi. Praesent ac sem eget est egestas volutpat.
            Cras varius. Morbi mollis tellus ac sapien. In enim justo, rhoncus ut, imperdiet a, venenatis vitae, justo. Nam ipsum risus, rutrum vitae, vestibulum eu, molestie vel, lacus. Fusce vel dui.</p>

                                                    </div>
                                                </div>

                                            </div>

                                        </div>

                                        
                                    </div>
<!--                                    <div role="tabpanel" class="tab-pane" id="messages11">
                                        <div class="row">
                                            <div class="col-md-12">
                                                <div class="card">

                                                    <div class="card-body card-padding">
                                                        <p>Morbi mattis ullamcorper velit. Etiam rhoncus. Phasellus leo dolor, tempus non, auctor et, hendrerit quis, nisi. Cras id dui. Curabitur turpis.
            Etiam ut purus mattis mauris sodales aliquam. Aenean viverra rhoncus pede. Nulla sit amet est. Donec mi odio, faucibus at, scelerisque quis, convallis in, nisi. Praesent ac sem eget est egestas volutpat.
            Cras varius. Morbi mollis tellus ac sapien. In enim justo, rhoncus ut, imperdiet a, venenatis vitae, justo. Nam ipsum risus, rutrum vitae, vestibulum eu, molestie vel, lacus. Fusce vel dui.</p>

                                                    </div>
                                                </div>

                                            </div>

                                        </div>
                                    </div>
                                    <div role="tabpanel" class="tab-pane" id="settings11">
                                       <div class="row">
                                            <div class="col-md-12">
                                                <div class="card">

                                                    <div class="card-body card-padding">
                                                        <p>Morbi mattis ullamcorper velit. Etiam rhoncus. Phasellus leo dolor, tempus non, auctor et, hendrerit quis, nisi. Cras id dui. Curabitur turpis.
            Etiam ut purus mattis mauris sodales aliquam. Aenean viverra rhoncus pede. Nulla sit amet est. Donec mi odio, faucibus at, scelerisque quis, convallis in, nisi. Praesent ac sem eget est egestas volutpat.
            Cras varius. Morbi mollis tellus ac sapien. In enim justo, rhoncus ut, imperdiet a, venenatis vitae, justo. Nam ipsum risus, rutrum vitae, vestibulum eu, molestie vel, lacus. Fusce vel dui.</p>

                                                    </div>
                                                </div>

                                            </div>

                                        </div>
                                    </div>-->

       </div>
        </div>
<div class="modal fade" id="modalDefault" tabindex="-1" role="dialog" aria-hidden="true">
   <div class="modal-dialog">
      <form role="form" action="{{url('project/create')}}" method="post" id="service">
          {{csrf_field()}}
         <div class="modal-content">
            <div class="modal-header">
               <h4 class="modal-title text-center">Create Project</h4>
            </div>
            <div class="modal-body model-min-height text-center">
                
                    <div class="row col-md-10 col-md-offset-1">
                    <div class="input-group">
                                        <span class="input-group-addon"><i class="zmdi zmdi-star-outline"></i></span>
                                        <div class="fg-line">
                                            <input name="project_title" class="form-control" placeholder="Project Title" type="text">
                                        </div>
                                        
                                    </div>
                    </div>
                <div class="row col-md-12">&nbsp;</div>
                    <div class="row">
                
                <label class="radio radio-inline m-r-20">
                    <input type="radio" name="service" value="0">
                    <i class="input-helper"></i>  
                    Free Service
                </label>
               <label class="radio radio-inline m-r-20">
                    <input type="radio" name="service" value="1">
                    <i class="input-helper"></i>  
                    Premium Service
               </label>
                    </div>
               <div class="">
                  <span id="errorplace" class="text-center"></span>
               </div>
            
            <hr />
            <div class="modal-footer">
               <center>
                  <button type="submit" class="btn btn-primary">Continue</button>
               </center>
            </div>
         </div>
      
   </div></form>
</div>
</div>
    </section>
</section>

@stop
