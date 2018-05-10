@extends('layouts/main')
@section('content')
<section id="main" data-layout="layout-1">
 @include('layouts/aside')
      <section id="content">
        <div class="container">
                    <div class="block-header">
                        <h2>Messages</h2>
                    </div>
                
                    <div class="card m-b-0" id="messages-main">
                        
                        <div class="ms-menu">
                            <div class="ms-block">
                                <div class="ms-user">
                                   
                                    <div><b>Ticket ID :  {{$ticketdetails->ticket_id}}</b></div>
                                </div>
                            </div>
                        
                            <div class="listview lv-user m-t-20">
                                <div class="lv-item media active"> 
                                    <div class="media-body">
                                        <div class="lv-title">Subject : {{$ticketdetails->subject}}</div>
                                        <div class="lv-small"><hr></div>
                                        <div class="lv-title">Department : <?php $department=$ticketdetails->department($ticketdetails->department)->first();?> {{$department->ticket_category_name}}</div>
                                        <div class="lv-small"><hr></div>
                                        <div class="lv-title">Created Date : <br>{{$ticketdetails->created_at}}</div>
                                         <div class="lv-small"><hr></div>
                                        <div class="lv-title">Last Update Date : <br>{{$ticketdetails->updated_at}}</div>
                                         <div class="lv-small"><hr></div>
                                        <div class="lv-title">Ticket Status : <span style="color:green">
                                        @if($ticketdetails->status==0)Open @else Closed @endif </span></div>
                                           
                                    </div>
                                </div>
                             </div>
                        </div>
                        
                        <div class="ms-body">
                            <div class="listview lv-message">
                                <div class="lv-header-alt clearfix">
                                    <div id="ms-menu-trigger">
                                        <div class="line-wrap">
                                            <div class="line top"></div>
                                            <div class="line center"></div>
                                            <div class="line bottom"></div>
                                        </div>
                                    </div>

                                    <div class="lvh-label hidden-xs">
                                       
                                    </div>
                                    
                                    @if($ticketdetails->status !=4)
                                    <a href="{{url('/closeticket/'.$ticketdetails->id)}}" class="btn bgm-purple waves-effect pull-right">Close Ticket</a>
                                    @endif    
                                </div>
                                
                                <div class="lv-body">
                                    <div class="lv-item media">
                                       
                                        <div class="media-body" style="padding-left: 50px;">
                                            <div class="ms-item" style="min-width: 80%;">
                                               {{$ticketdetails->message}}
                                            </div>
                                            <small class="ms-date">Created on <i class="zmdi zmdi-time"></i> {{$ticketdetails->created_at}} by You</small>
                                        </div>
                                    </div>
                                    @foreach($ticketresponses as $response)
                                    @if($response->response_from == 'client')
                                    <div class="lv-item media">
                                       
                                        <div class="media-body" style="padding-left: 50px;">
                                            <div class="ms-item" style="min-width:80%;">
                                               {{strip_tags($response->response)}}
                                            </div>
                                            <small class="ms-date">Created on <i class="zmdi zmdi-time"></i> {{$ticketdetails->created_at}} by You 
                                            | <?php if($response->file1){?>  <a target="_blank" href="{{url('project_images/tickets/'.$response->file1)}}"><i class="zmdi zmdi-hc-2x zmdi-attachment"></i>{{$response->file1}} </a><?php }?></small>
                                        </div>
                                    </div>
                                    @else
                                     <div class="lv-item media right">
                                        <div class="media-body" style="padding-right: 50px;">
                                            <div class="ms-item" style="min-width: 80%;">
                                                {{strip_tags($response->response)}}
                                            </div>
                                            <small class="ms-date"><?php if($response->file1){?>  <a target="_blank" href="{{url('project_images/tickets/'.$response->file1)}}"><i class="zmdi zmdi-hc-2x zmdi-attachment"></i>{{$response->file1}} </a><?php }?> | Created on <i class="zmdi zmdi-time"></i> {{$ticketdetails->created_at}} by Admin</small>
                                        </div>
                                    </div>
                                    @endif                                    
                                    @endforeach
                                </div>
                                 @if($ticketdetails->status==0)
                                 <form action="{{url('/ticketresponse')}}" method="post" enctype="multipart/form-data" id="ticketresponse" name="ticketresponse">
                                     {{csrf_field()}}
                                    <input type="hidden" name="ticket_id" value="{{$ticketdetails->ticket_id}}">
                                    <input type="hidden" name="response_from" value="client">
                                      <div class="lv-footer ms-reply">
                                        <textarea placeholder="Post reply" name="message"></textarea>
                                        <button ><i class="zmdi zmdi-mail-send"></i></button>
                                    </div>
                                    <div class="col-xs-12">
                                        <p class="f-500 c-black m-b-20">File For Upload</p>  
                                        <div class="fileinput fileinput-new" data-provides="fileinput">
                                            <span class="btn btn-primary btn-file m-r-10">
                                                <span class="fileinput-new">Select file</span>
                                                <span class="fileinput-exists">Change</span>
                                                <input type="file" name="image1">
                                            </span>
                                            <span class="fileinput-filename"></span>
                                            <a href="#" class="close fileinput-exists" data-dismiss="fileinput">&times;</a>
                                        </div> 
                                    </div>
                                 </form>
                                 @endif
                            </div>
                        </div>
                    </div>
                </div>
      </section>
</section>
@stop