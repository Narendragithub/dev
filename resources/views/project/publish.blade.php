<div role="tabpanel" class="tab-pane  animated fadeInRight" id="publish">
<!--    <div class="tab-header">
        <h2>Publishing Settings</h2>
    </div>

    <div class="clearfix"></div>
    <form class="form-horizontal store" name="contact" id="contact" method="POST" action="{{url('project/savepublish')}}" enctype="multipart/form-data">
        {!! csrf_field() !!}
        <input class="form-control input-sm" id="pidmenu1" type="hidden" value="{{$project->id}}" name="pid">
        <div class="card-body card-padding">

            <div class="form-group">
                <label for="" class="col-sm-2 control-label">Store Visibility</label>
                <div class="col-sm-10">
                    <div class="fg-line">
                        <label class="radio radio-inline m-r-20">
                            <input type="radio" name="is_public" value="1" @if($project->is_public == 1) checked @endif>
                            <i class="input-helper"></i>  
                            Public
                        </label>
                        @if($project->premium_service > 0)
                        <label class="radio radio-inline m-r-20">
                            <input type="radio" name="is_public" value="0" @if($project->is_public == 0) checked @endif>
                            <i class="input-helper"></i>  
                            Private
                        </label>
                        @endif
                    </div>
                </div>
            </div>


        </div>
        @if($project->premium_service > 0)
        <button type="submit" class="btn btn-info pull-right">Save<i class="fa fa-chevron-right"></i></button>
        @endif
        <br />
    </form>-->
    
    <div class="tab-header">
        <h2>Sharing Options</h2>
    </div>
    <div>
     </br>   
     <b> QR Code :</b>
    </br>
    {!!QrCode::size(200)->generate(url().'/pid/'.$project->alias)!!}
	  </br>  
    <b> Url :  {{url()}}/pid/{{$project->alias}}</b>
    </div>
   
     </br>
    <b> Embed Link : &lt;embed src="{!!url().'/pid/'.$project->alias!!}" width="500px;"&gt </b><br>
	<i>Paste this code in your website</i>
</div>