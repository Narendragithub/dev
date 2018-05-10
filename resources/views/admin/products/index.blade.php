@extends('layouts/admin')
@section('content')
<div class="allcontent">
    <div class="maintitle">Products</div>
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
        <div class="tebaltop">
           
            <span class="diplytext">Display {{$products->count()}} Records Through {{$products->total()}} Records</span>
            <div class="bluebtn"><a href="{{url('/admin/products/create')}}">+Add New Product</a></div>
            <!--<span class="diplytextblack">Result Per Page :</span>
            <div class="pagewtopbtn">
            <div class="select-main">
                          <label>
                            <select>
                                  <option>20</option>
                                  <option>40</option>
                            </select>
                          </label>
            </div>
            </div>
             <div class="pagewtopbtn" style="margin-right: 12px;">
            <div class="dropdown">
              <button class="btn btn-default dropdown-toggle" type="button" id="dropdownMenu1" data-toggle="dropdown" aria-haspopup="true" aria-expanded="true">
                Action
                <span class="caret"></span>
              </button>
              <ul class="dropdown-menu" aria-labelledby="dropdownMenu1">
                <li><a href="#"><i class="fa fa-times-circle" aria-hidden="true"></i> Close</a></li>
                <li><a href="#"><i class="fa fa-trash" aria-hidden="true"></i> Delete</a></li>
              </ul>
            </div>
          </div>-->
        </div>

        <div id="gride-bg">
            <div class="tablegrid">
                <div class="tablegridheader">
                    <!--<div><input type="checkbox" id="checkbox" name="checkbox"><label for="checkbox"></label></div>-->
                    <div>Name</div>                    
                    <div>Price</div>                    
                    <div>Date Added</div>                    
                    <div>Modules</div>                    
                    <div>Services</div>                    
                            
                    <div>Category</div>
                    <!--<div>Attributes</div>-->
                    <div>Action</div>


                </div>
                @foreach($products as $product)

                <div class="tablegridrow">
                    <!--div><input type="checkbox" id="2" name="checkbox"> <label for="2"></label></div>-->
                    <div>
                        <a href="{{adminurl('products/edit/'.$product->id)}}">
                            {{ $product->name}}
                        </a>
                    </div>
                    <div>${{ number_format($product->price,2)}} </div>
                    <div>{{ $product->created_at}} </div>
                    <div>{{ count($product->modules)}}  <a href="{{adminurl('products/addmodule/'.$product->id)}}">Add</a></div>
                    <div>{{ count($product->services)}} <a href="{{adminurl('products/addservices/'.$product->id)}}">Add</a></div>
                    
                    <div>@if($product->category->category) {{ $product->category->category }} @endif</div>   
                    <!--<div><a class="btn btn-primary">Modules</a> <a class="btn btn-primary">Services</a></div>-->
                    <div><a href="{{adminurl('products/edit/'.$product->id)}}" class="btn btn-primary">Edit</a>  <a href="{{adminurl('products/delete/'.$product->id)}}" class="btn btn-danger" onclick="return confirm('are you sure you want to delete this product?')">Delete</a> </div>    

                </div>
                @endforeach   


            </div>
            <?php echo $products->render(); ?>
            <!--<ul class="nice_paging">
                               <li><a href="#">< Previous</a></li>
                               <li><a href="#">1</a></li>
                               <li class="current">2</li>
                               <li><a href="#">3</a></li>
                               <li><a href="#">4</a></li>
                               <li><a href="#">5</a></li>
                               <li><a href="#">Next ></a></li>
             </ul>-->
            <div class="clearboth"></div>
        </div>

    </div>
</div>
@stop