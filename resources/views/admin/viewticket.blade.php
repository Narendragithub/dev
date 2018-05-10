@extends('layouts/admin')
@section('content')
<div class="allcontent">
    <div class="maintitle">Support Ticket</div>
    <div class="subcbg">
        <div class="subcleft"><b>Subject :</b> Ticket ID {{$ticket->ticket_id}} [{{$ticket->subject}}]</div>
        <div class="subcright"><b>Department :</b> {{$ticket->department}}</div>
        <div class="clearboth"></div>
    </div>

    <!-- Nav tabs -->
    <div class="tabsbg">
        <div id="tab2">
            <div role="tabpanel">
                <ul class="nav nav-tabs" role="tablist">
                    <li role="presentation" class="active"><a href="#home" aria-controls="home" role="tab" data-toggle="tab">Add Reply</a></li>
                    <!--<li role="presentation"><a href="#profile" aria-controls="profile" role="tab" data-toggle="tab">Add Note</a></li>
                    <li role="presentation"><a href="#fancyanywear" aria-controls="profile" role="tab" data-toggle="tab">Remarks About This User</a></li>
                     <li role="presentation"><a href="#four" aria-controls="profile" role="tab" data-toggle="tab">Secure Details</a></li>-->
                    <li role="presentation"><a href="#five" aria-controls="profile" role="tab" data-toggle="tab">Other Tickets</a></li>
                    <!--<li role="presentation"><a href="#six" aria-controls="profile" role="tab" data-toggle="tab">Options</a></li>-->
                </ul>
            </div>
        </div>
    </div>
    <!-- Nav tabs -->
    <!-- Tab panes -->
    <form action="{{adminurl('support/ticketresponse')}}" method="post" enctype="multipart/form-data">
        {{csrf_field()}}
        <input type="hidden" name="ticket_id" value="{{$ticket->ticket_id}}">
        <input type="hidden" name="ticket_main_id" value="{{$ticket->id}}">
        <div class="tab-content">
            <div role="tabpanel" class="tab-pane active" id="home">
                <textarea class="textareabox" placeholder="write your resposne...." name="response"></textarea>
                <!--<div class="tab1greybox">
                    <div class="tablegreyboxleft">
                        <div class="brosemain">
                            <div class="toolstext">Tools</div>
                            <div class="setboxin">
                                <div class="select-main">
                                    <label>
                                      <select>
                                            <option>Set to Answered & Return to Ticket List</option>
                                            <option>Set to Answered & Return to Ticket List</option>
                                      </select>
                                    </label>
                                </div>
                            </div>
                            <div class="bluebtn"><a href="#">Add Response</a></div>
                        </div>
                        <div>
                            <div class="toolstext">Attachments</div>
                            <div class="fileselectbtn">
                             <input id="SitesettingLogo" class="browserbuttonlink" type="file" onchange="$(".logoimgname").html(this.value);" name="data[Sitesetting][logo]">Choose File
                            </div>
                            <div class="nofilechosetext">No file chosen</div>
                            <div class="addmore">
                                <a href="#"><b style="font-size: 18px;">+</b> Add More</a>
                            </div>
                        </div>
                    </div>
                    <div class="tablegreyright">
                        <div class="insertbtn"><a href="#">Insert Predefined Reply</a></div>
                        <div class="insertbtn2"><a href="#">Insert Knowledgebase Link</a></div>
                    </div>
                    <div class="clearboth"></div>
                </div>-->
                <button type="submit" class="btn btn-primary">Submit</button>
            </div>
            <div role="tabpanel" class="tab-pane" id="profile">
                <textarea class="textareabox" placeholder="note...." name="note"></textarea>
                <div style="text-align: right; padding-top: 14px;">
                    <!--<div class="bluebtn"><a href="#">Add Note</a></div>-->
                </div>	
            </div>
            <div role="tabpanel" class="tab-pane" id="fancyanywear">
                <textarea class="textareabox" placeholder="remarks about this user...." name="remarks"></textarea>
                <div style="text-align: right; padding-top: 14px;">
                    <!--<div class="bluebtn"><a href="#">Submit</a></div>-->
                </div>	
            </div>
            <div role="tabpanel" class="tab-pane" id="four" style="text-align: center;">
                <div class="secureleftmain">
                    <div class="securetitle">cPanel URL</div>
                    <input type="text" readonly value="{{$ticket->cpanel_url}}" name="last_name" class="formbox" id="last_name"/>
                    <div class="securetitle">Dirctory Proctection URL</div>
                    <input type="text" readonly value="" name="last_name" class="formbox" id="last_name"/>
                    <div class="securetitle">Admin URL</div>
                    <input type="text" readonly value="{{$ticket->admin_url}}" name="last_name" class="formbox" id="last_name">
                    <div class="securetitle">FTP Hostname</div>
                    <input type="text" readonly value="{{$ticket->ftp_host}}" name="last_name" class="formbox" id="last_name"/>
                </div>
                <div class="secureleftmain marginleftright">
                    <div class="securetitle">cPanel Username</div>
                    <input type="text" readonly value="{{$ticket->cpanel_username}}" name="last_name" class="formbox" id="last_name"/>
                    <div class="securetitle">Dirctory Proctection Username</div>
                    <input type="text" readonly value="" name="last_name" class="formbox" id="last_name"/>
                    <div class="securetitle">Admin Username</div>
                    <input type="text" readonly value="{{$ticket->admin_url}}" name="last_name" class="formbox" id="last_name"/>
                    <div class="securetitle">FTP Username</div>
                    <input type="text" readonly value="{{$ticket->ftp_username}}" name="last_name" class="formbox" id="last_name"/>
                </div>
                <div class="secureleftmain">
                    <div class="securetitle">cPanel Password</div>
                    <input type="text" readonly value="{{$ticket->cpanel_password}}" name="last_name" class="formbox" id="last_name"/>
                    <div class="securetitle">Dirctory Proctection Password</div>
                    <input type="text" readonly value="" name="last_name" class="formbox" id="last_name"/>
                    <div class="securetitle">Admin Password</div>
                    <input type="text" readonly value="{{$ticket->admin_password}}" name="last_name" class="formbox" id="last_name"/>
                    <div class="securetitle">FTP Password</div>
                    <input type="text" readonly value="{{$ticket->ftp_password}}" name="last_name" class="formbox" id="last_name"/>
                </div>
                <div class="tab1greybox" style="text-align: left;">
                    <div class="fileselectbtngreen">
                        <input id="SitesettingLogo" class="browserbuttonlink" type="file" onchange="$(".logoimgname").html(this.value);" name="image1">
                        Browse
                    </div>
                    <div class="nofilechosetext">No file Selected</div>
                    <div class="fileselectbtngreen">
                        <input id="SitesettingLogo" class="browserbuttonlink" type="file" onchange="$(".logoimgname").html(this.value);" name="image2">
                        Browse
                    </div>
                    <div class="nofilechosetext">No file Selected</div>
                    <div class="fileselectbtngreen">
                        <input id="SitesettingLogo" class="browserbuttonlink" type="file" onchange="$(".logoimgname").html(this.value);" name="image3">
                        Browse
                    </div>
                    <div class="nofilechosetext">No file Selected</div>
                    <div class="fileselectbtngreen">
                        <input id="SitesettingLogo" class="browserbuttonlink" type="file" onchange="$(".logoimgname").html(this.value);" name="image4">
                        Browse
                    </div>
                    <div class="nofilechosetext">No file Selected</div>
                </div>
                <div style="text-align: right; padding-top: 14px;">
                    <div class="bluebtn"><a href="#">Submit</a></div>
                </div>	
            </div>
            <div role="tabpanel" class="tab-pane" id="five">
                <div class="maintablewhite">
                    <div class="tebaltop">
                        <span class="diplytext">Display {{$tickets->count()}} Records Through {{$tickets->total()}} Records</span>
                    </div>

                    <div id="gride-bg">
                        <div class="tablegrid">
                            <div class="tablegridheader">
                                <div>Ticket Id</div>
                                <div>Department</div>
                                <div>Subject</div>
                                <div>Submitter</div>
                                <div>Status</div>
                                <div>Last Reply</div>
                                <div>Action</div>

                            </div>
                            @foreach($tickets as $ticket_info)
                            <?php
                            $department = $ticket_info->department($ticket_info->department)->first();
                            if ($ticket->ticket_id != $ticket_info->ticket_id) {
                                ?>
                                <div class="tablegridrow">
                                    <div>{{$ticket_info->ticket_id}}</div>
                                    <div>{{$department->department_name}}</div>
                                    <div>{{$ticket_info->subject}}</div>
                                    <div><b>{{$user->firstname.' '.$user->lastname}}</b></div>
                                    <div>@if($ticket_info->status==0)In Progress @else Closed @endif</div>
                                    <div>{{$ticket_info->lastresponsetime($ticket_info->ticket_id)}}</div>
                                    <div><a href="{{adminurl('support/view/'.$ticket_info->id)}}" class="btn btn-primary btn-small">View</a></div>

                                </div>
<?php } ?>
                            @endforeach


                        </div>
<?php echo $tickets->render(); ?>
                        <div class="clearboth"></div>
                    </div>

                </div>
            </div>
            <div role="tabpanel" class="tab-pane" id="six">

                <div class="serchlefts">
                    <div class="serchmainin">
                        <div class="staus">Department</div>
                        <div class="stausrightfrom">
                            <div class="select-main">
                                <label>
                                    <select>
                                        <option>Tech Support Team</option>
                                        <option>Tech Support Team</option>
                                    </select>
                                </label>
                            </div>
                        </div>
                    </div>
                    <div class="serchmainin">
                        <div class="staus">Subject</div>
                        <div class="stausrightfrom">
                            <input id="last_name" class="formbox" type="text" name="last_name" value="" placeholder="All Ticket"/>
                        </div>
                    </div>
                    <div class="serchmainin">
                        <div class="staus">Status</div>
                        <div class="stausrightfrom">
                            <div class="select-main">
                                <label>
                                    <select>
                                        <option>Answered</option>
                                        <option>Answered</option>
                                    </select>
                                </label>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="serchlefts">
                    <div class="serchmainin">
                        <div class="staus">CC Recipients</div>
                        <div class="stausrightfrom">
                            <input id="last_name" class="formbox" type="text" name="last_name" value="" />
                        </div>
                    </div>
                    <div class="serchmainin">
                        <div class="staus">Client ID</div>
                        <div class="stausrightfrom">
                            <input id="last_name" class="formbox" type="text" name="last_name" value="" />
                        </div>
                    </div>
                    <div class="serchmainin">
                        <div class="staus">Flag</div>
                        <div class="stausrightfrom">
                            <div class="stausrightfrom">
                                <div class="select-main">
                                    <label>
                                        <select>
                                            <option>None</option>
                                            <option>None</option>
                                        </select>
                                    </label>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div style="text-align: right; padding-top: 14px; margin-right: 60px;">
                    <div class="bluebtn"><button>Save Changes</button></div>
                </div>
            </div>
    </form>
    <!-- Tab panes -->
</div>
<!--<div class="whiterepet">
    <div class="supporttielerepet">Private Staff Notes</div>
   
    <div class="darkyellowbox">
        <div class="darkyellowtitlesin">
         Notes 
          
          <div class="clearboth"></div>
        </div>
         @foreach($responses as $response)
         @if($response->note!='')
        <div class="darkyellowcontent">{!!$response->note!!}<div class="darkyellowright">{{$response->created_at}} <span class="rong"><a href="#"><i style="color: #c48102;" class="fa fa-times" aria-hidden="true"></i>
</a></div></div>
         <div class="darkyellowtitlesin">
         
        </div>
         @endif
    @endforeach
    </div>
    
</div>
<div class="whiterepet">
    <div class="supporttielerepet">Remarks About This User</div>
    <div class="darkredwbox">
        @if($ticket->remarks!=''){!!$ticket->remarks!!}
        @else No remarks
        @endif
    </div>
</div>-->

<div class="whiterepet">
    <div class="massegemainboxin">
        <div class="messagebluetitle">
            Message From : {{$user->firstname.' '.$user->lastname}}
            <div class="flotright">
                <div style="display: inline-block; vertical-align: middle; margin-right: 4px;">{{$ticket->created_at}}</div>

            </div>
            <div class="clearboth"></div>
        </div>
        <!--		   <div class="massagecontenttext">
                              <p>{{$ticket->message}}</p>
                                
                                ---------
                                @if($ticket->file1 || $ticket->file2 || $ticket->file3 || $ticket->file4)
                                <div class="attachment"><a href="#">Attachment</a></div>
                                   <div class="col-md-12">
                                       @if($ticket->file1)
                                       <div class="col-md-2"><img height="180" width="300" src="{{asset('product_images/'.$ticket->file1)}}"/></div>
                                       @endif
                                       @if($ticket->file2)
                                       <div class="col-md-2"><img height="180" width="300" src="{{asset('product_images/'.$ticket->file2)}}"/></div>
                                       @endif
                                       @if($ticket->file3)
                                       <div class="col-md-2"><img height="180" width="300" src="{{asset('product_images/'.$ticket->file3)}}"/></div>
                                       @endif
                                       @if($ticket->file4)
                                       <div class="col-md-2"><img height="180" width="300" src="{{asset('product_images/'.$ticket->file4)}}"/></div>
                                       @endif
                                   </div>
                                <br>
                                <br>
                                <br>
                                <br>
                                <br>
                                <br>
                                <br>
                                <br>
                                <br>
                                <br>
                                <br>
                                   @endif
                                <b></b>
                            </div>-->
    </div>
    @foreach($responses as $response)
    @if($response->response!='')
    <div class="massegemainboxin">
        <div class="messagebluetitle">
            Message From : {{$response->response_from}}
            <div class="flotright">
                <div style="display: inline-block; vertical-align: middle; margin-right: 4px;">{{$response->created_at}}</div>
<?php if ($response->response_from != 'client') { ?>
                    <div class="editbtn"><a style="cursor:pointer" data-toggle="modal" data-target="#myModal{{$response->id}}"><i style="font-size: 16px;" class="fa fa-pencil-square-o" aria-hidden="true"></i> Edit</a> </div>
                    <div class="deletbtn"><a href="{{adminurl('member/deleteresponse/'.$response->id.'/'.$ticket->id)}}" onclick="return confirm('Are you sure you want to delete this response?')"><i style="font-size: 16px;" class="fa fa-trash" aria-hidden="true"></i> Delete</a> </div>
<?php } ?>
            </div>
            <div class="clearboth"></div>
        </div>
        <div class="massagecontenttext">
            <p>{!!$response->response!!}</p>

            <!------edit ticket model-------->
            <div id="myModal{{$response->id}}" class="modal fade" role="dialog">
                <div class="modal-dialog">

                    <!-- Modal content-->
                    <form action="{{adminurl('member/editresponse')}}" method="post">
                        {{csrf_field()}}
                        <div class="modal-content">
                            <div class="modal-header">
                                <button type="button" class="close" data-dismiss="modal">&times;</button>
                                <h4 class="modal-title">Edit response - #{{$response->ticket_id}}</h4>
                            </div>
                            <div class="modal-body">
                                <p><textarea placeholder="Edit response" name="editedresponse" required>{!!$response->response!!}</textarea></p>
                                <input type="hidden" name="responseid" value="{{$response->id}}">
                                <input type="hidden" name="mainticketid" value="{{$ticket->id}}">
                            </div>
                            <div class="modal-footer">
                                <button type="submit" class="btn btn-primary">Save</button>
                                <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
            <!------edit ticket model-------->
            @if($response->file1)
            ---------
            <b></b>
            <div class="attachment"> @if($response->file1)
                <a target="_blank" href="{{asset('project_images/tickets/'.$response->file1)}}"><i class="fa fa-file"></i> {{$response->file1}}</a>
                @endif</div>
            
            <div class="clearfix"></div>
            @endif
        </div>
    </div>
    @endif
    @endforeach
</div>
</div>
@stop