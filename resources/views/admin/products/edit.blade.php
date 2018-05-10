@extends('layouts/admin')
@section('content')
<div class="allcontent">
    <div class="maintitle">Edit - {{$product->name}}</div>
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
                        <div class="staus">Product Features</div>
                        <div class="stausrightfrom">
                            <textarea  placeholder="Product features" name="features" class="formbox">{{$product->features}}</textarea>
                        </div>

                    </div>
                    <div class="serchmainin">
                        <div class="staus">Affiliate commission</div>
                        <div class="stausrightfrom">
                            <input type="text" placeholder="Affiliate commission" value="{{$product->commission}}" name="commission" class="formbox">
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
                            <div class="bluebtn">
                                <a  href="#" onclick="history.go(-1);">Cancel</a>
                            </div>
                        </div>

                    </div>

                </div>
            </form>
        </div>

    </div><br>
    
    <div class="maintitle"> Versions <span class="pull-right"><a class="btn btn-primary" style="cursor:pointer" data-toggle="modal" data-target="#Version">Add New Version    </a></span></div>
@if($versions && count($versions) > 0)
    <div class="maintablewhite">
        <div class="whiteboxsearch">
            <div id="gride-bg">
                <div class="tablegrid">
                    <div class="tablegridheader">
                        <!--<div><input type="checkbox" id="checkbox" name="checkbox"><label for="checkbox"></label></div>-->
                        <div>Description</div>
                        <div>Date</div>
                        <div>Action</div>

                    </div>
                    @foreach($versions as $version)
                    <div class="tablegridrow">
                        <!--<div><input type="checkbox" id="2" name="checkbox"> <label for="2"></label></div>-->
                        <div>{{$version->version}}</div>
                        <div>{{$version->publish_date}}</div>
                        <div><a class="btn btn-primary" style="cursor:pointer" data-toggle="modal" data-target="#Version{{$version->id}}">Edit</a> 
                            <a class="btn btn-danger" href="{{adminurl('products/deleteversion/'.$version->id)}}" onclick="return confirm('are you sure you want to delete this version?')">Delete</a></div>

                    </div>
                    <div id="Version{{$version->id}}" class="modal fade" role="dialog">
                        <div class="modal-dialog">

                            <!-- Modal content-->
                            <form action="{{adminurl('products/updateversion/'.$version->id)}}" method="post" enctype="multipart/form-data">
                                {{ csrf_field() }}
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <button type="button" class="close" data-dismiss="modal">&times;</button>
                                        <h4 class="modal-title">New Version</h4>
                                    </div>
                                    <div class="modal-body">
                                        <p><input class="form-control" name="updated_version_name" id="" type="text" value="{{$version->version}}" style="width:80%"></p>
                                        <!--<p><input name="versionfile" id="" type="file"></p>-->
                                        <input type="hidden" name="productid" value="{{$product->id}}">
                                        
                                    </div>
                                    <div class="modal-footer">
                                        <button type="submit" class="btn btn-default">Save</button>
                                        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                    @endforeach


                </div>

                <div class="clearboth"></div>
            </div>
        </div>

    </div><br>
@endif
<div class="maintitle"> Modules </div>

    <div class="maintablewhite">
        <div class="whiteboxsearch">
            <div id="gride-bg">
                <div class="tablegrid">
				@foreach($modules as $mod)
                    <div class="tablegridheader">
                        <!--<div><input type="checkbox" id="checkbox" name="checkbox"><label for="checkbox"></label></div>-->
                        <div>Description</div>
                        <div>Module versions</div>
                        
                        <div>Date</div>
                        <div>Action</div>

                    </div>
                    
                    <div class="tablegridrow">
                        <!--<div><input type="checkbox" id="2" name="checkbox"> <label for="2"></label></div>-->
                        <div>{{$mod->module_title}}</div>
                        <div><b>{{count($mod->versions)}}</b> <a style="cursor:pointer" data-toggle="modal" data-target="#Module{{$mod->id}}">add</a></div>
						
                        <div>{{$mod->created_at}}</div>
                        <div><a class="btn btn-primary" style="cursor:pointer" data-toggle="modal" data-target="#Updatemodule{{$mod->id}}">Edit</a> 
                            <a class="btn btn-danger" href="" onclick="return confirm('are you sure you want to delete this version?')">Delete</a></div>

                    </div>
					<!---------edit module----------->
					<div id="Updatemodule{{$mod->id}}" class="modal fade" role="dialog">
						<div class="modal-dialog">

							<!-- Modal content-->
							<form action="{{adminurl('products/updatemodule/'.$mod->id)}}" method="post" enctype="multipart/form-data">
								{{ csrf_field() }}
								<div class="modal-content">
									<div class="modal-header">
										<button type="button" class="close" data-dismiss="modal">&times;</button>
										<h4 class="modal-title">Update {{$mod->module_title}}</h4>
									</div>
									<div class="modal-body">
									<input type="hidden" name="old_module_image" value="{{$mod->image}}">
									<input type="hidden" name="productid" value="{{$product->id}}">
										<p><input class="form-control" name="update_module_title" value="{{$mod->module_title}}" type="text" placeholder="version name" style="width:80%"></p>
										<p><textarea name="moduledescription" class="form-control" style="width:60%">{{$mod->description}}</textarea></p>
										<p><input name="updatedmodulefile" id="" type="file"></p>
										<input type="hidden" name="product_id" value="{{$product->id}}">
										

									</div>
									<div class="modal-footer">
										<button type="submit" class="btn btn-default">Save</button>
										<button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
									</div>
								</div>
							</form>
						</div>
					</div>
					<!---------edit module----------->
                    <?php 
                    $moduleversions = $mod->versions()->where('module_id',$mod->id)->get(); 
                    if($moduleversions && count($moduleversions) > 0){
                    ?>
                    <div class="tablegridrow">
					
                        <div><b>Version</b></div>
                        <div><b>Filename</b></div>
                        <div><b>Created Date</b></div>
                        <div><b>Action</b></div>
                    </div>
                    @foreach($moduleversions as $mod_ver)
                    <div class="tablegridrow" style="color:#3ab2cc;">
                        <div>{{$mod_ver->version}}</div>
                        <div><img src="{{asset('product_images/'.$mod_ver->filename)}}" width="100"></div>
                        <div>{{$mod_ver->created_at}}</div>
                        <div><a class="btn btn-primary" style="cursor:pointer" data-toggle="modal" data-target="#updateVersion{{$mod_ver->id}}">Edit</a> 
                            <a class="btn btn-danger" href="" onclick="return confirm('are you sure you want to delete this version?')">Delete</a></div>
                    </div>
                    <!-----edit version------>
                    <div id="updateVersion{{$mod_ver->id}}" class="modal fade" role="dialog">
                        <div class="modal-dialog">

                            <!-- Modal content-->
                            <form action="{{adminurl('products/updatemoduleversion/'.$mod_ver->id)}}" method="post" enctype="multipart/form-data">
                                {{ csrf_field() }}
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <button type="button" class="close" data-dismiss="modal">&times;</button>
                                        <h4 class="modal-title">Update {{$mod_ver->version}}</h4>
                                    </div>
                                    <div class="modal-body">
									<input type="hidden" name="oldversionimage" value="{{$mod_ver->filename}}">
                                        <p><input class="form-control" name="updated_version_name" id="" type="text" value="{{$mod_ver->version}}" style="width:80%"></p>
                                        <p><input name="updateversionfile" id="" type="file"></p>
                                        <input type="hidden" name="productid" value="{{$product->id}}">
                                        
                                    </div>
                                    <div class="modal-footer">
                                        <button type="submit" class="btn btn-default">Save</button>
                                        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                    <!-----edit version------>
                    @endforeach
                    <?php } ?>
                    <div id="Module{{$mod->id}}" class="modal fade" role="dialog">
                        <div class="modal-dialog">

                            <!-- Modal content-->
                            <form action="{{adminurl('products/addmoduleversion')}}" method="post" enctype="multipart/form-data">
                                {{ csrf_field() }}
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <button type="button" class="close" data-dismiss="modal">&times;</button>
                                        <h4 class="modal-title">New Version</h4>
                                    </div>
                                    <div class="modal-body">
                                        <p><input class="form-control" name="version_name" id="" type="text" style="width:80%"></p>
                                        <p><input name="versionfile" id="" type="file"></p>
                                        <input type="hidden" name="productid" value="{{$mod->product_id}}">
                                        <input type="hidden" name="moduleid" value="{{$mod->id}}">
                                        
                                    </div>
                                    <div class="modal-footer">
                                        <button type="submit" class="btn btn-default">Save</button>
                                        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                    @endforeach


                </div>

                <div class="clearboth"></div>
            </div>
        </div>

    </div><br>
	
	<div class="maintitle"> Services </div>
	
</div>

<div id="Version" class="modal fade" role="dialog">
    <div class="modal-dialog">

        <!-- Modal content-->
        <form action="{{adminurl('products/addversion')}}" method="post" enctype="multipart/form-data">
            {{ csrf_field() }}
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                    <h4 class="modal-title">New Version</h4>
                </div>
                <div class="modal-body">
                    <p><input class="form-control" name="version_name" id="" type="text" placeholder="version name" style="width:80%"></p>
                    <p><input name="versionfile" id="" type="file"></p>
                    <input type="hidden" name="product_id" value="{{$product->id}}">

                </div>
                <div class="modal-footer">
                    <button type="submit" class="btn btn-default">Save</button>
                    <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                </div>
            </div>
        </form>
    </div>
</div>




@stop
