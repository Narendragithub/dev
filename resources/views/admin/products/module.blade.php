@extends('layouts/admin')
@section('content')
<div class="allcontent">
    <div class="maintitle">Module - {{$product->name}}</div>
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
            <form name="serviceform" method="post" action="{{adminurl('products/newmodule')}}" enctype="multipart/form-data">
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
                        <div class="staus">Module Title</div>
                        <div class="stausrightfrom">
                            <input type="text" placeholder="Module title" value="" name="module_title" class="formbox" id="module_title">
                        </div>

                    </div>
                    <div class="serchmainin">
                        <div class="staus">Module Description</div>
                        <div class="stausrightfrom">
                            <textarea  placeholder="Module Description" name="description" class="formbox"></textarea>
                        </div>

                    </div>
                    <div class="serchmainin">
                        <div class="staus">Module Price</div>
                        <div class="stausrightfrom">
                            <input type="text" placeholder="Module Price" value="" name="price" class="formbox">
                        </div>

                    </div>
                    
                    <div class="serchmainin">
                        <div class="staus">Attachment File</div>
                        <div class="stausrightfrom">
                            <input type="file" name="image"  id="file" >
                        </div>

                    </div>
                    <br>
                    <div class="maintitle">Module Version</div>
                    
                    <br>
                    <div class="serchmainin">
                        <div class="staus">Version Title</div>
                        <div class="stausrightfrom">
                            <input class="form-control" name="version_name" id="" type="text" placeholder="version name" style="width:80%">
                        </div>

                    </div>
                    <div class="serchmainin">
                        <div class="staus">Attachment File</div>
                        <div class="stausrightfrom">
                            <input name="versionfile" id="" type="file">
                        </div>

                    </div>
                    <div class="serchmainin">


                        <div style="text-align: right; padding-top: 14px; margin-right: 60px;">
                            <div class="bluebtn">
                                <a  href="#" onclick="document.serviceform.submit();">Update</a>
                            </div>
                        </div>

                    </div>

                </div>
            </form>
        </div>

    </div><br>
   
    
</div>

@stop
