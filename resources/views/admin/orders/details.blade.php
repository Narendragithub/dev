@extends('layouts/admin')
@section('content')
<div class="allcontent">
    <div class="maintitle">Orders</div>
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

    <div class="container">
        <div class="col-md-12">
            <div class="panel panel-default">
                <div class="panel-heading">Billing information</div>
                <div class="panel-body">
                    <table class="table ">

                        <tbody>

                            <tr>
                                <td colspan="2"><strong>Order # : {{$order->order_no}} | Order Date : {{$order->created_at}}</strong>
                                </td>

                                <td>
                                    <b>Order Status</b> : @if($order->status==0) <b>Pending</b> @else <b>Approved</b> @endif
                                </td>
                                <td>&nbsp;<!--<a href="#">Reorder</a>--></td>
                            </tr>

                            <tr>
                                <td><strong>User Information</strong></td>
                                <td><strong>Shipping Address</strong></td>
                                <td><strong>Fees</strong></td>
                            </tr>

                            <tr>
                                <td>{{$user->firstname.'&nbsp;'.$user->lastname}}<br><br>{{$userprofile->phone}}<br><br>{{$user->email}}</td>
                                <td>{{$userprofile->address}}</td>
                                <td>Fixed charges - ${{$order->fixed_charges > 0?$order->fixed_charges:'0'}}
                                    <br>
                                    <br>Percentage charges - ${{$order->percentage_charges > 0?$order->percentage_charges:'0'}}


                                </td>
                            </tr>

                        </tbody>
                    </table>	
                </div>
            </div>
        </div>
    </div>	<!--/.main-->

    <div class="container">
        <div class="col-md-12">
            <div class="panel panel-default">
                <div class="panel-heading">Items Ordered</div>
                <div class="panel-body">
                    <table class="table ">

                        <thead>
                            <tr>
                                <th>Item Name</th>
                                <th>Item Type</th>
                                <th>Price</th>
                                <th>Amount</th>
                                <th>License Key</th>
                                <th>Action</th>
                                <!--<th>Subtotal</th>-->

                            </tr>
                            <?php $user = App\User::find($order->user_id); ?>
                            <?php $order_amount = 0; ?>
                            @foreach($orderitems as $items)
                            <?php 
                            $order_amount+=$items->price;
                            if($items->product_id > 0){
                            $downloads = $user->downloads()->where('user_id',$user->id)->where('product_id',$items->product_id)->where('product_id','!=',0)->groupBy('product_id')->first();
                            }
                            if($items->module_id > 0){
                            $moduledownloads = $user->downloads()->where('user_id',$user->id)->where('module_id',$items->module_id)->where('module_id','!=',0)->first();
                            }//dd($downloads);
                            ?>
                            @if($items->product_id > 0)
                            <tr>
                                <td>{{$items->product->name}}</td>
                                <td>Product</td>
                                <td>${{number_format($items->price)}}</td>
                                <td>${{number_format($items->price)}}</td>
                                <form action="{{adminurl('approve')}}" method="post">
                                    {{csrf_field()}}
                                <input type="hidden" name="order_id" value="{{$order->id}}">
                                <input type="hidden" name="product_id" value="{{$items->product_id}}">
                                @if($downloads)
                                <td>{{$downloads->license_key}}</td>
                                <td>Approved</td>
                                @else
                                <td><input style="width:40%" placeholder="Enter license key" class="form-control" name="license_key" value="" required></td>
                                <td><button class="btn btn-success">Approve now</button></td>
                                @endif
                                </form>
                            </tr>
                        </thead>
                    </table>
                            @endif
                            @if($items->module_id > 0)
                        <table class="table ">

                        <thead>
                            <tr>
                                <th>Item Name</th>
                                <th>Item Type</th>
                                <th>Price</th>
                                <th>Amount</th>
                                <th>License Key</th>
                                <th>Action</th>
                            </tr>
                            <tr>
                                <td>{{$items->modules->module_title}}</td>
                                <td>Module</td>
                                <td>${{number_format($items->price)}}</td>
                                <td>${{number_format($items->price)}}</td>
                                <form action="{{adminurl('approvemodule')}}" method="post">
                                    {{csrf_field()}}
                                <input type="hidden" name="order_id" value="{{$order->id}}">
                                <input type="hidden" name="product_id" value="{{$items->modules->product_id}}">
                                <input type="hidden" name="module_id" value="{{$items->modules->id}}">
                                @if($moduledownloads)
                                <td>{{$moduledownloads->license_key}}</td>
                                <td>Approved</td>
                                @else
                                <td><input style="width:40%" placeholder="Enter license key" class="form-control" name="license_key1" value="" required></td>
                                <td><button class="btn btn-success">Approve now</button></td>
                                @endif
                                
                                </form>
                            </tr>
                        </thead>
                        </table>
                            @endif
                            @if($items->service_id > 0)
                            <table class="table ">

                        <thead>
                            <tr>
                                <th>Item Name</th>
                                <th>Item Type</th>
                                <th>Price</th>
                                <th>Amount</th>
                                
                            </tr>
                            <tr>
                                <td>{{$items->services->service_title}}</td>
                                <td>Service</td>
                                <td>${{number_format($items->price)}}</td>
                                <td>${{number_format($items->price)}}</td>
                            </tr>
                            @endif

                            @endforeach
                        </tr></table>
                            <table class="table">
                            <tr>
                                <th></th>
                                <th></th>
                                <th>Order total</th>
                                <th>${{$order_amount}}</th>
                            </tr>
                            <tr>
                                <th></th>
                                <th></th>
                                <th>Fixed charges</th>
                                <th>${{$order->fixed_charges > 0?:'0'}}</th>
                            </tr>
                            <tr>
                                <th></th>
                                <th></th>
                                <th>Percentage charges</th>
                                <th>${{$order->percentage_charges > 0?:'0'}}</th>
                            </tr>
                            <tr>
                                <th></th>
                                <th></th>
                                <th></th>
                                <th>${{$order->percentage_charges > 0?:'0' + $order->fixed_charges > 0?:'0' + $order_amount}}</th>
                            </tr>
                        </thead>

                    </table>
                   
                </div>
            </div>
        </div>
    </div>

</div>
@stop