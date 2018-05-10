@extends('layouts/admin')
@section('content')
<div class="allcontent">
    <div class="maintitle">Add Product</div>

    <div class="maintablewhite">
        <div class="whiteboxsearch">
            <form name="productform" method="post" action="{{adminurl('products/store')}}" enctype="multipart/form-data">
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
                                        <option value="{{$category->id}}">{{$category->category}}</option>
                                        @endforeach   
                                    </select>
                                </label>
                            </div>
                        </div>
                    </div>
                    <div class="serchmainin">
                        <div class="staus">Product Name</div>
                        <div class="stausrightfrom">
                            <input type="text" placeholder="Product Name" value="" name="name" class="formbox" id="name">
                        </div>

                    </div>
                    <div class="serchmainin">
                        <div class="staus">Product Description</div>
                        <div class="stausrightfrom">
                            <textarea  placeholder="Product Description" value="" name="description" class="formbox"></textarea>
                        </div>

                    </div>
                    <div class="serchmainin">
                        <div class="staus">Product Features</div>
                        <div class="stausrightfrom">
                            <textarea  placeholder="Product features" value="" name="features" class="formbox"></textarea>
                        </div>

                    </div>
                    <div class="serchmainin">
                        <div class="staus">Affiliate commission</div>
                        <div class="stausrightfrom">
                            <input type="text" placeholder="Affiliate Commission" value="" name="commission" class="formbox" id="commission">
                        </div>

                    </div>
                    <div class="serchmainin">
                        <div class="staus">Product Price</div>
                        <div class="stausrightfrom">
                            <input type="text" placeholder="Product Price" value="" name="price" class="formbox" id="price">
                        </div>

                    </div>
                    <div class="serchmainin">
                        <div class="staus">Product Expiry</div>
                        <div class="stausrightfrom">
                            <input type="text" placeholder="Product Expiry (in months)" value="" name="expiry" class="formbox" id="name">
                        </div>

                    </div>
                    <div class="serchmainin">
                        <div class="staus">Product Version</div>
                        <div class="stausrightfrom">
                            <input type="text" placeholder="Product Version" value="" name="version" class="formbox" id="name">
                        </div>

                    </div>
                    <div class="serchmainin">
                        <div class="staus">Product Image</div>
                        <div class="stausrightfrom">
                            <input type="file" name="image"  id="file" >
                        </div>

                    </div>
                    <div class="serchmainin">


                        <div style="text-align: right; padding-top: 14px; margin-right: 60px;">
                            <div class="bluebtn">
                                <a  href="#" onclick="document.productform.submit();">Create</a>
                            </div>
                            <div class="bluebtn">
                                <a  href="#" onclick="history.go(-1);">Cancel</a>
                            </div>
                        </div>

                    </div>

                </div>
            </form>
        </div>

    </div>
</div>
@stop
