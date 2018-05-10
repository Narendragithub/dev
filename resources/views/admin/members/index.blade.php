@extends('layouts/admin')
@section('content')
<div class="allcontent">
    <div class="maintitle">Members</div>
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
           
            <span class="diplytext">Display {{$members->count()}} Records Through {{$members->total()}} Records</span>
            
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
                    <div>Id</div>                    
                    <div>Name</div> 
                    <div>Email</div>     
                                     
                    <div>Registration Date</div>
                    <div>Action</div>


                </div>
                @foreach($members as $member)

                <div class="tablegridrow">
                    <!--div><input type="checkbox" id="2" name="checkbox"> <label for="2"></label></div>-->
                    <div>{{$member->id}}</div>
                    <div><a href="{{adminurl('members/overview/'.$member->id)}}">{{$member->firstname}} {{$member->lastname}}</a></div>
                    <div>{{$member->email}} </div>
                    <div>{{$member->created_at}}</div>
                    <div>
<!--                    <a href="{{adminurl('members/edit/'.$member->id)}}" class="btn btn-primary">Edit</a>  -->
                        <a href="{{adminurl('members/delete/'.$member->id)}}" class="btn btn-danger" onclick="return confirm('are you sure you want to delete this member?')">Delete</a>
                    </div>    

                </div>
                @endforeach   


            </div>
            <?php echo $members->render(); ?>
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