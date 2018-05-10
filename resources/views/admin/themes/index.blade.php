@extends('layouts/admin')
@section('content')
<div class="allcontent">
    
    <div class="maintitle">Themes</div>
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
            
            <span class="diplytext">
    
    
Display {{$themes->count()}} Records Through {{$themes->total()}} Records</span>
            <div class="bluebtn"><a href="{{adminurl('themes/create')}}">+Add New Theme</a></div>
           
        </div>

        <div id="gride-bg">
            <div class="tablegrid">
                <div class="tablegridheader">
                    <!--<div><input type="checkbox" id="checkbox" name="checkbox"><label for="checkbox"></label></div>-->
                    <div>Name</div>
                    <div>Image</div>
                    <div>Attribute</div>
                    <div>Action</div>


                </div>
                @foreach($themes as $theme)

                <div class="tablegridrow">
                    <!--<div><input type="checkbox" id="2" name="checkbox"> <label for="2"></label></div>-->
                    <div>{{ $theme->name}} </div>
                    <div>@if($theme->image)<img src="{{asset('theme_images/'.$theme->image)}}" width="100">@endif</div>
                    <div>@if($theme->attribute) {{ $theme->attribute->name }} @else &nbsp; @endif</div>   
                    <div>
                        <a href="{{adminurl('themes/edit/'.$theme->id)}}">Edit</a> | 
                        <a class="delete" prop="theme" href="{{  adminurl('themes/delete/'.$theme->id) }} ">Delete</a></div>        

                </div>
                @endforeach   


            </div>
            <?php echo $themes->render(); ?>
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