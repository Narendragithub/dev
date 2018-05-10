@extends('layouts/admin')
@section('content')
<div class="allcontent">
    <div class="maintitle">Services - {{$product->name}}</div>
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
        <div class="whiteboxsearch">
            <form name="productform" method="post" action="{{adminurl('products/newservices')}}" enctype="multipart/form-data">
                {{ csrf_field() }}
                <input type="hidden" name="product_id" value="{{$product->id}}">
                <div class="serchlefts">
                    
                    <div class="serchmainin">
                        <div class="staus">Product Name</div>
                        <div class="stausrightfrom">
                            <input type="text" placeholder="Product Name" readonly value="{{$product->name}}" name="name" class="formbox" id="name">
                        </div>

                    </div>
                    <div class="serchmainin">
                        <div class="staus">Service Title</div>
                        <div class="stausrightfrom">
                            <input type="text" placeholder="Service title" value="" name="service_title" class="formbox" id="module_title">
                        </div>

                    </div>
                    <div class="serchmainin">
                        <div class="staus">Service Description</div>
                        <div class="stausrightfrom">
                            <textarea  placeholder="Service Description" name="description" class="formbox"></textarea>
                        </div>

                    </div>
                    <div class="serchmainin">
                        <div class="staus">Service Price</div>
                        <div class="stausrightfrom">
                            <input type="text" placeholder="Service Price" value="" name="price" class="formbox">
                        </div>

                    </div>
                    
                    <div class="serchmainin">
                        <div class="staus">Attachment File</div>
                        <div class="stausrightfrom">
                            <input type="file" name="image"  id="file" >
                        </div>

                    </div>
                    <div class="serchmainin">


                        <div style="text-align: right; padding-top: 14px; margin-right: 60px;">
                            <div class="bluebtn">
                                <a  href="#" onclick="document.productform.submit();">Update</a>
                            </div>
                        </div>

                    </div>

                </div>
            </form>
        </div>

    </div><br>
    
    
</div>

@stop
