@extends('layouts/admin')
@section('content')
<div class="allcontent">
    <div class="maintitle">@if($paymentmethod)  Edit Processor  {{ucfirst($paymentmethod->name)}} @else Add New Payment Processor @endif</div>
    
        <div class="whiteboxsearch">
            @if($paymentmethod)
                <form name="addpayment_form" id="addpayment_form" method="post" action="{{adminurl('settings/updatepayment')}}">
                <input type='hidden' name='payment_id' value='{{$paymentmethod->id}}'/>
            @else
                <form name="addpayment_form" id="addpayment_form" method="post" action="{{adminurl('settings/addpayment')}}">
            @endif
            
                <input type='hidden' name='active_tabid' value='payment'/>
                {{ csrf_field() }}
                <div class="serchlefts">
                    
                    <div class="serchmainin">
                        <div class="staus">Name</div>
                        <div class="stausrightfrom">
                            <input type="text" placeholder="Processor name" value="@if($paymentmethod) {{$paymentmethod->name}} @endif" name="name" class="formbox" id="name">
                        </div>

                    </div>
                    <div class="serchmainin">
                        <div class="staus">Client ID</div>
                        <div class="stausrightfrom">
                            <input type="text" placeholder="Client ID" value="@if($paymentmethod) {{$paymentmethod->client_id}} @endif" name="pclient_id" class="formbox" id="pclient_id">
                        </div>

                    </div>
                    <div class="serchmainin">
                        <div class="staus">Client Secret</div>
                        <div class="stausrightfrom">
                            <input type="text" placeholder="Client Secret" value="@if($paymentmethod) {{$paymentmethod->client_secret}} @endif" name="pclient_secret" class="formbox" id="pclient_secret">
                        </div>

                    </div>
                    <div class="serchmainin">
                        <div class="staus">Percentage Fee</div>
                        <div class="stausrightfrom">
                            <input type="text" placeholder="Percentage Fee" value="@if($paymentmethod) {{$paymentmethod->percentage_fee}} @endif" name="percentage_fee" class="formbox" id="percentage_fee">
                        </div>

                    </div>
                    <div class="serchmainin">
                        <div class="staus">Fixed Fee</div>
                        <div class="stausrightfrom">
                            <input type="text" placeholder="Fixed Fee" value="@if($paymentmethod) {{$paymentmethod->fixed_fee}} @endif" name="fixed_fee" class="formbox" id="fixed_fee">
                        </div>

                    </div>
                    
                    
                   
                    <div class="serchmainin">


                        <div style="text-align: right; padding-top: 14px; margin-right: 60px;">
                            @if($paymentmethod)
                            <button type="submit" class="btn btn-primary">Update</button>
                            @else
                            <button type="submit" class="btn btn-primary">Add</button>
                            @endif
                            <a type="button" href="{{adminurl('settings#payment')}}" class="btn btn-default">Cancel</a>
                            
                        </div>

                    </div>

                </div>
            </form>
        </div>

</div>
@stop
