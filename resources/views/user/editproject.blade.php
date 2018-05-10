@extends('layouts/main')
@section('content')
<section id="main" data-layout="layout-1">
    @include('layouts/aside')
    <section id="content">
        <?php echo \Session::get('active_li'); ?>
        <div class="col-md-12">
            <div class="tab-content">
                <div role="tabpanel" class="tab-pane active" id="sidetab1">
                    <div class="row">
                        <div class="col-md-12">
                            <div class="card my-project">
                                <div class="card-body card-padding">
                                    <div class="dash-widgets landing-widget">
                                        <div class="row">
                                            <div class="col-md-2">
                                                <img class="img-responsive" src="@if($thumbimage){{url('project_images/'.$thumbimage)}} @else {{url('html/img/blank.png')}} @endif " />
                                            </div>
                                            <div class="col-md-4">
                                                <div class="myblock-header">
                                                    <h3><span style="color: #009688;">{{$project->title}}</span></h3>
                                                    <small>Graphic Representation of number of download of the peoject </small>

                                                    <div><?php echo date("F d, Y", strtotime($project->created_at)); ?></div>


                                                </div>
                                            </div>
                                            <div class="col-md-6">
                                                <?php if ($project->premium_service == 1 && $project->payment_status == 0) { ?><!-- <span class="pull-right"><a href="#" class="btn btn-info pull-right waves-effect">Pay Now</a></span>--><?php } ?>
                                                <?php  if($project->is_submitted == 0) { ?> <span class="pull-right"><a href="javascript:void(0);" onclick="project_publish(<?php echo $project->id; ?>, 1);" class="btn btn-info pull-right waves-effect">Submit</a></span><?php } else { ?><span class="pull-right"><h3><?php if ($project->is_completed == 1) { echo "Completed";                                                                
                                                           } else{ echo "Pending"; } ?></h3></span><?php }  ?>
                                                
                                        </div>
                                        <hr />
                                    </div>

                                    <!-- side menu start-->

                                    <!-- begin side tab section -->
                                    <div class="container">
                                        <div class="row">
                                            <div class="col-md-12 mb mt">

                                                <div class="nav-tabs-three">


                                                    <div class="row">

                                                        <div role="tabpanel" class="tab">

                                                            <div class="col-md-3">
                                                                <div class="">
                                                                    <ul class="tab-nav main-menu mainmenu" role="tablist">
                                                                        <li class="active"><a href="#home9" aria-controls="home9" role="tab" data-toggle="tab">Dashboard</a></li>
                                                                        <li role="presentation"><a href="#profile9" aria-controls="profile9" role="tab" data-toggle="tab">Statistic</a></li>
                                                                        <li role="presentation"><a href="#render" aria-controls="render" role="tab" data-toggle="tab">Renders</a></li>
                                                                        <!-- <li role="presentation"><a href="#messages9" aria-controls="messages9" role="tab" data-toggle="tab">Store Listing</a></li>-->
                                                                        <li class="sub-menu">
                                                                            <a href="#" > Store Listing</a>
                                                                            <ul class="level2">
                                                                                <li> <a href="#prdetails" aria-controls="prdetails" role="tab" data-toggle="tab">Project Details</a></li>
                                                                                <li> <a href="#prlinks" aria-controls="prlinks" role="tab" data-toggle="tab">Web Links</a> </li>
                                                                                <li> <a href="#prcontact" aria-controls="prcontact" role="tab" data-toggle="tab">Contact Details</a> </li>
                                                                                <li> <a href="#graphic" aria-controls="graphic" role="tab" data-toggle="tab">Graphic Assets</a> </li>             
                                                                            </ul>
                                                                        </li>

                                                                        <li role="presentation"><a href="#design9" aria-controls="design9" role="tab" data-toggle="tab">Design</a></li>
                                                                        <li role="presentation"><a href="#publish" aria-controls="publish" role="tab" data-toggle="tab">publishing Setting</a></li>
                                                                        <li role="presentation"><a href="#transfer" aria-controls="transfer" role="tab" data-toggle="tab">Transfer Project</a></li>
                                                                    </ul>

                                                                </div>

                                                            </div>
                                                            <div class="col-md-9">

                                                                @if(Session::has('message'))
                                                                <div class="alert alert-success alert-dismissible" role="alert">
                                                                    {{ Session::get('message') }}
                                                                </div>
                                                                @endif
                                                                <div class="">
                                                                    <div class="tab-content">
                                                                        <!-- Dashboard View -->
                                                                        @include('project/dashboard')
                                                                        <!-- Statistics View -->
                                                                        @include('project/statistics')
                                                                        <!-- Renders -->
                                                                        @include('project/renders')
                                                                        <!-- Details -->
                                                                        @include('project/details')
                                                                        <!-- Weblinks -->
                                                                        @include('project/weblinks')
                                                                        <!-- Contact -->
                                                                        @include('project/contact')
                                                                        <!-- Assets -->
                                                                        @include('project/assets')
                                                                        <!-- Design -->
                                                                        @include('project/design')
                                                                        <!-- Publish -->
                                                                        @include('project/publish')
                                                                        <!-- Transfer -->
                                                                        @include('project/transfer')


                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                </div>
                            </div>
                        </div>

                    </div>
                </div>
            </div>
        </div>

    </section>
</section>
@stop
