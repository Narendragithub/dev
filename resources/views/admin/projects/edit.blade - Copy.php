@extends('layouts/admin')
@section('content')
<div class="allcontent">
    <div class="maintitle">Edit - {{$product->name}}</div>

    <div class="maintablewhite">
        <div class="whiteboxsearch">
            <form name="productform" method="post" action="{{adminurl('products/update/'.$product->id)}}" enctype="multipart/form-data">
                {{ csrf_field() }}
                <div class="serchlefts">
                    <div class="serchmainin">
                        <div class="staus">Category</div>
                        <div class="stausrightfrom">
                            <div class="select-main">
                                <label>
                                    <select name="categories_id">
                                        <option value="0">Select Category</option>
                                        @foreach($categories as $category)
							@if((isset($product->categories_id)) && $product->categories_id==$category->id)
                                        <option value="{{$category->id}}" selected="selected">{{$category->category}}</option>
									@else
										<option value="{{$category->id}}">{{$category->category}}</option>
										@endif
                                        @endforeach
										
                                    </select>
                                </label>
                            </div>
                        </div>
                    </div>
                    <div class="serchmainin">
                        <div class="staus">Product Name</div>
                        <div class="stausrightfrom">
                            <input type="text" placeholder="Product Name" value="{{$product->name}}" name="name" class="formbox" id="name">
                        </div>

                    </div>
                    <div class="serchmainin">
                        <div class="staus">Product Description</div>
                        <div class="stausrightfrom">
                            <textarea  placeholder="Product Description" name="description" class="formbox">{{$product->description}}</textarea>
                        </div>

                    </div>
                    <div class="serchmainin">
                        <div class="staus">Product Price</div>
                        <div class="stausrightfrom">
                            <input type="text" placeholder="Product Price" value="{{$product->price}}" name="price" class="formbox">
                        </div>

                    </div>
                    <div class="serchmainin">
                        <div class="staus">Product Expiry</div>
                        <div class="stausrightfrom">
                            <input type="text" placeholder="Product Expiry (in months)" value="{{$product->expiry}}" name="expiry" class="formbox" id="name">
                        </div>

                    </div>
                    <div class="serchmainin">
                        <div class="staus">Product Version</div>
                        <div class="stausrightfrom">
                            <input type="text" placeholder="Product Version" value="{{$product->version_id}}" name="version" class="formbox" id="name">
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

    </div>
	
</div>
<!--------akhil---------->

<!--------akhil---------->
@stop
