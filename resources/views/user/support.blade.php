@extends('layouts/main')
@section('content')
<section id="main" data-layout="layout-1">
 @include('layouts/aside')
      <section id="content">
         <div class="col-md-12">
             <div class="tab-content">
                                    <div role="tabpanel" class="tab-pane active" id="sidetab1">
            <div class="row">
                <div class="">

                    <div class="col-md-12">
                        <div class="card">
                            <div class="card-header">
                                <h2>Support <small>Please Make Sure That You Have Whitelisted The Email Address 'info@admin.com' In Your Email Account So That None Of Our Mails Are Treated As Spams.<br /> Also Check Your Spam Folder And Verify That You Haven't Missed Any Mails From Us. </small></h2>

                            </div>

                            <div class="card-body table-responsive">
                                  @if(count($tickets) > 0)<div class="right-btn">
                                    <a href="/support/create"> <button class="btn bgm-cyan waves-effect pull-right">Open New Ticket</button></a>
                                    <br />
                                    <br />
                                </div>
                                  @endif

                                  <div class="col-md-12">
                                  @if(count($tickets) > 0)
                                  <table class="table table-striped bootgrid-table colr-thead">

                                        <thead>
                                            <tr>
                                                <th>Date</th>
                                                <th>Category</th>
                                                <th>Subject</th>
                                                <th>Status</th>
                                                <th>Last update</th>
                                                <th>Action</th>
                                            </tr>
                                        </thead>
                                        <tbody class="text-center">

                                            @foreach($tickets as $ticket)
<?php $ticket_category=$ticket->department($ticket->department)->first();
                                    ?>
                                            <tr>
                                                <td>{{$ticket->created_at}}</td>
                                                <td>{{$ticket_category->ticket_category_name}}</td>
                                                <td>{{$ticket->subject}}</td>
                                                <td>@if($ticket->status==0)
                                                    Open @else Closed  @endif</td>
                                                <td>{{$ticket->updated_at}}</td>
                                                <td>@if($ticket->status==0)
                                                    <a class="btn bgm-cyan waves-effect" href="{{url('/viewticket/'.$ticket->ticket_id)}}">Reply</a>
                                                    <a class="btn bgm-cyan waves-effect" href="{{url('/closeticket/'.$ticket->id)}}">Close</a>
                                                    @else
                                                    <a class="btn bgm-cyan waves-effect" href="{{url('/viewticket/'.$ticket->ticket_id)}}">View</a>
                                                    <a class="btn bgm-cyan waves-effect" href="{{url('/openticket/'.$ticket->id)}}">Reopen</a>
                                                    @endif</td>
                                            </tr>


                                            @endforeach  

                                        </tbody>
                                    </table>
                                @else
                                <div class="row">
                                        <div class="col-md-12 col-sm-12 col-xs-12 text-center">
                                            <h2>You don't have any ticket.</h2>
                                            <p><a href="/support/create"> <button class="btn bgm-cyan waves-effect">Open New Ticket</button></a>
                                    </p>
                                        </div>
                                    </div>
                                @endif
                                  </div>
                            </div>
                        </div>

                    </div>

                </div>

            </div>

            <div class="card">

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
    </section>


    <!--#allcontent over-->
    @stop
